<?php // Code within app\Helpers\Helper.php
namespace App\Helpers;
use Config;
use App\Model\DbModels\Attachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Model\DbModels\Locations;
use App\Model\DbModels\Tasks;
use App\Model\DbModels\Users;
use App\Model\DbModels\Q4eAssign;
use App\Model\DbModels\Q4eItems;
use App\Model\DbModels\Q4eSections;
use App\Model\DbModels\Q4eAnswerType;
use App\Model\DbModels\Category;
use App\Model\DbModels\Q4eForms;
use App\Model\DbModels\Q4eAttachments;
use App\Model\DbModels\Q4eAnswers;
use App\Model\DbModels\Q4eType;
use App\Model\DbModels\Assignments;
use App\Model\DbModels\Q4eResults;
use App\Model\DbModels\Q4eOutcome;
use App\Model\DbModels\Q4eOAnswers;
use App\Model\DbModels\Q4eResultsCalc;
use App\Model\DbModels\Q4eOutcomeScore;
use App\Model\DbModels\OutcomeForms;
use App\Model\DbModels\Q4EUsers;
use App\Helpers\ApolloHelpers;
use App\Helpers\FileAttachments;
use App\Helpers\LibFiles;
use App\Helpers\LibAPI;
use App\Model\DbModels\Q4eItemsChoice;
use App\Model\DbModels\Q4EPerms;
use App\Model\DbModels\Q4EApiRes;
use App\Model\DbModels\Clinics;
use App\Model\DbModels\Q4ePeriods;
use App\Model\DbModels\ViewCenter;
use App\Model\DbModels\Q4eFormsProps;
use App\Model\DbModels\AuditForms;
use App\Helpers\LibNotifications;
use DateInterval;
use DatePeriod;
use DateTime;
use DB;
use App\Helpers\LibScores;
use App\Model\DbModels\ToClose;
use App\Model\DbModels\ClosedOutcomeForms;
use App\Model\DbModels\ClosedAuditForms;

class LibOutcomeForms
{
    public static function getTrendScore($formid,$location="",$yy=0,$mm=0,$per)
    {
        $query = ClosedOutcomeForms::where('form_id',$formid);
        if($location != ""){
            $query->where('location_id',$location);
        }
        // if($yy != 0){
        //     $query->whereYear('assign_date',$yy);
        // }
        // if($mm != 0){
        //     $query->whereMonth('assign_date',$mm);
        // }
        if($per != ""){
            $query->where('per',$per);
        }
        $cnt = $query->count();
        $score = 0;
        if($cnt > 0)
        {
            $score = $query->select('total_score')->first()->total_score;
        }
        $score = LibScores::outcomeScore($formid,$score);
        return $score;
    }
    public static function outcomeTrendReport($userid,$location,$period,$pg="")
    {
        $code = "OUTCOME";
        $arScore = array();
        $arAvg = array();
        $arSeries = array();
        $lstOutcome = array();
        $arPeriods = array();
        $locName = Locations::getName($location);
        $data['status'] = 0;
        $tmp = array();
        $tmp['locName'] = $locName;
        $lstForms = array();
        $lForms =array();
        
        if($location == ""){
            $lstForms = ClosedOutcomeForms::join('v_user_locations','v_user_locations.location','v_closed_outcome_forms.location_id')
                    ->where('v_user_locations.id',$userid)
                    ->select('v_closed_outcome_forms.form_id')
                    ->distinct('v_closed_outcome_forms.form_id')
                    ->get();
        }
        else {
            $lstForms = ClosedOutcomeForms::where('location_id',$location)->select('form_id')->distinct('form_id')->get();
        }
        foreach($lstForms as $rsForms){
            $lForms[] = $rsForms->form_id;
        }
        $tmp['lForms'] = $lForms;
        $minYY = Q4ePeriods::whereIn('form_id',$lForms)->where('status',20)->min('per');
        $maxYY = Q4ePeriods::whereIn('form_id',$lForms)->where('status',20)->max('per');
        $start = (new DateTime($minYY."-01"))->modify('first day of this month');
        $end = (new DateTime($maxYY.'-01'))->modify('first day of next month');
        $interval = DateInterval::createFromDateString('1 month');
        $period   = new DatePeriod($start, $interval, $end);
           
        $arValues=array();
        foreach ($period as $dt) 
        {
            $arPeriods[] = $dt->format('F Y'); 
        }
        $tmp['arPeriods'] = $arPeriods;
        $tmp['minYY'] = $minYY;
        $tmp['maxYY'] = $maxYY;
        if($minYY > 0 && $maxYY > 0)
        {
            $data['status'] = 1;
            foreach($lstForms as $rsForms)
            {
                $formid = $rsForms->form_id;
                $formName = Q4eForms::where('id',$formid)->select('name')->first()->name;
                $arScore=array();
                $arAvg=array();
                foreach ($period as $dt) 
                {
                    $yy = $dt->format('Y');
                    $mm = intval($dt->format('m'));
                    $mon = $mm;
                    if($mm < 10) $mon = "0".$mm;
                    $per = $yy."-".$mon;
                    $score = LibOutcomeForms::getTrendScore($formid,$location,$yy,$mm,$per);
                    $arScore[] = $score;
                    $tmp[$formName][] = $score;
                    $avg = ClosedOutcomeForms::where('form_id',$formid)
                            // ->whereYear('assign_date',$yy)
                            // ->whereMonth('assign_date',$mm)
                            ->where('per',$per)
                            ->avg('total_score');
                    $avg = LibScores::outcomeScore($formid,$avg);
                    $arAvg[] = $avg;
                }
                $arSeries[] = array("type"=>"line","name"=>$formName." - ".$locName,"data"=>$arScore);
                $arSeries[] = array("type"=>"line","name"=>$formName." - National Average","data"=>$arAvg);
            }
            
        }
         
        $legend=array();
        foreach($arSeries as $r)
        {
            $legend[] = $r['name'];
        }
        $data['tmp'] = $tmp;
        $data['periods'] = $arPeriods;
        $data['series'] = $arSeries;
        $data['legend'] = $legend;
        return $data;
    }
    public static function outcomeGuageCount($params)
    {
        $query = ClosedOutcomeForms::where('status',20);
        if($params['location'] != "")
        {
            $query->where('location_id',$params['location']);
        }
        // if($params['yy'] != 0)
        // {
        //     $query->whereYear('assign_date',$params['yy']);
        // }
        // if($params['mm'] != 0)
        // {
        //     $query->whereMonth('assign_date',$params['mm']);
        // }
        if($params['per'] != "")
        {
            $query->where('per',$params['per']);
        }
        if($params['typ'] == "OUTCOME"){
            $query->whereNotIn('form_id',$params['lstQPlus']);
        }
        #print_r($params);
        $rs = $query->count();
        return $rs;
    }
    public static function outcomeGuageResults($params)
    {
        $query = ClosedOutcomeForms::where('status',20);
        if($params['location'] != "")
        {
            $query->where('location_id',$params['location']);
        }
        // if($params['yy'] != 0)
        // {
        //     $query->whereYear('assign_date',$params['yy']);
        // }
        // if($params['mm'] != 0)
        // {
        //     $query->whereMonth('assign_date',$params['mm']);
        // }
        if($params['per'] != "")
        {
            $query->where('per',$params['per']);
        }
        if($params['typ'] == "OUTCOME"){
            $query->whereNotIn('form_id',$params['lstQPlus']);
        }
        else {
            $query->whereIn('form_id',$params['lstQPlus']);
        }
        $rs = $query->select('formname','locname','form_id','total_score','assign_date','location_id','per')
                ->orderBy('completed_date','desc')
                ->limit(1)
                ->get();
        return $rs;
    }
    public static function getOutcomeDefaultLocation($userid,$typ,$lstForms)
    {
        $loc="";
        $query = ClosedOutcomeForms::join('v_user_locations','v_user_locations.location','v_closed_outcome_forms.location_id')
                    ->where('v_user_locations.id',$userid);
        if($typ=="OUTCOME"){
            $query->whereNotIn('v_closed_outcome_forms.form_id',$lstForms);
        } else {
            $query->whereIn('v_closed_outcome_forms.form_id',$lstForms);
        }
        $query->orderBy('v_closed_outcome_forms.assign_date','asc');
        $cnt = $query->count();
        if($cnt > 0){
            $rs = $query->select('v_user_locations.location')->first();
            $loc = $rs->location;
        }
        return $loc;
    }
    public static function isValidQ4E($location,$lstQPlus)
    {
        $lstQBU = Q4eFormsProps::whereIn('form_id',$lstQPlus)->where('prop','BU')->select('val')->get();
        $cnt = ViewCenter::where('center_id',$location)->select('bu_id')->count();
        $b=0;
        if($cnt > 0){
            $bu = ViewCenter::where('center_id',$location)->select('bu_id')->first()->bu_id;
            
            foreach($lstQBU as $r){
                if($r->val == $bu) $b=1;
            }
        }
        return $b;
    }
    public static function guageDBOM($userid,$location,$period,$pg="",$typ,$lstQPlus)
    {
        $mHeader = $typ == "OUTCOME" ? "Outcome Measures" : "Q4E Plus";
      
        $notFound = array("showHeader"=>"YES","header"=>"No Data Found","mHeader"=>$mHeader,"message"=>"We couldn't fetch data for your selection");
        if($pg=="HOME") $notFound['showHeader'] = "NO";
        $rsForms = array();
        $params['userid'] = $userid;
        $params['location'] = $location;
        $params['yy'] = 0;
        $params['mm'] = 0;
        $params['lstQPlus'] = $lstQPlus;
        $params['typ'] = $typ;
        $params['per'] = $period;
        $canContinue=1;
        if($typ=="Q4EPLUS"){
            $canContinue = LibOutcomeForms::isValidQ4E($location,$lstQPlus);
            if($canContinue == 0){
                $notFound['showHeader'] = "NO";
            }
        }
        $lstOutcome = array("tagLine"=>"","location"=>"","value"=>"","message"=>"","status"=>"fail","notFound"=>$notFound);
        if($pg == "HOME") 
        {
        } 
        else 
        {
            $yy = intval(date('Y',strtotime($period)));
            $mm = date('m',strtotime($period));
            $params['yy'] = $yy;
            $params['mm'] = $mm;
        }
         #echo "can continue ....".$canContinue;
        if($canContinue == 1) {
            $scnt = LibOutcomeForms::outcomeGuageCount($params);
            # echo "Count ".$scnt;
            if($scnt > 0) {
                $rsForms = LibOutcomeForms::outcomeGuageResults($params); 
                foreach($rsForms as $r){
                    $periodName = date('F Y',strtotime($r->per."-01"));
                    $lstOutcome['tagLine'] = $r->formname." - ".$periodName;
                    $lstOutcome['location'] = $r->locname;
                    $lstOutcome['value'] = LibScores::outcomeScore($r->form_id,$r->total_score);
                    $lstOutcome['message'] = LibScores::getMaxOutcomeCenter($r->form_id,$r->assign_date,$r->location);
                    $lstOutcome['status'] = "success";
                    $lstOutcome['notFound'] = array();
                }
            }
        }
        return $lstOutcome;
    }
    public static function guageDBOutcome($userid,$location,$period,$pg="")
    {
        $lstOutcome = array();
        if($location=="0") $location="";
        // echo $location;
        // echo $period;
        // echo $pg;
        $lstQPlus = Q4eFormsProps::where('prop','Q4E_PLUS')->where('val','Yes')->select('form_id')->get();
        $locOutcome=$location;
        if($locOutcome == "")
        {
            $locOutcome = LibOutcomeForms::getOutcomeDefaultLocation($userid,"OUTCOME",$lstQPlus);
        }
        $locPlus = $location;
        if($locPlus == "")
        {
            $locPlus = LibOutcomeForms::getOutcomeDefaultLocation($userid,"Q4EPLUS",$lstQPlus);
        }
        $outcome1 = LibOutcomeForms::guageDBOM($userid,$locOutcome,$period,$pg,"OUTCOME",$lstQPlus);
        $outcome2 = LibOutcomeForms::guageDBOM($userid,$locPlus,$period,$pg,"Q4EPLUS",$lstQPlus);
        $lstOutcome = array("outcome1"=> $outcome1,"outcome2"=>$outcome2);
        return $lstOutcome;
    }

    public static function getOutcomeForms($params)
    {
        $results = ClosedOutcomeForms::where('status',20)->select('form_id','formname')->distinct('form_id')->get();
        $lstForms = array();
        foreach($results as $row){
          $lstForms[] = array("id"=>$row->form_id,"name"=>$row->formname);
        }
        
        $results = ClosedOutcomeForms::where('status',20)->select('region','regionname')->distinct('region')->get();
        $lstLocations = array();
        foreach($results as $row){
          $lstLocations[] = array("id"=>$row->region,"name"=>$row->regionname);
        }
        $data['locations'] = $lstLocations;
        $minYY = ClosedOutcomeForms::where('status',20)->min('yymm');
        $maxYY = ClosedOutcomeForms::where('status',20)->max('yymm');
        $start = (new DateTime($minYY."-01"))->modify('first day of this month');
        $end = (new DateTime($maxYY.'-01'))->modify('first day of next month');
        $interval = DateInterval::createFromDateString('1 month');
        $period   = new DatePeriod($start, $interval, $end);
        $lstPeriod=array();
        $pCtr=1;
        foreach ($period as $dt) {
          if($pCtr < 12){
            $lstPeriod[] = array("id"=>$dt->format("Y-m"),"name"=>$dt->format("F Y"));
          }
          $pCtr++;
        }
        $lstData=array();
        $colCtr=1;
        
        if($params['search'] == "N"){ //direct from dashboard
          foreach($lstForms as $row){
            $tmpAr = array();
            foreach ($period as $dt) {
              $yy = $dt->format('Y');
              $mm = $dt->format('m');
              $score = ClosedOutcomeForms::where('form_id',$row['id'])
                      ->where('status',20)
                      ->whereYear('completed_date',$yy)
                      ->whereMonth('completed_date',$mm)
                      ->select('total_score')
                      ->avg('total_score');
              if($score=="") $score=0;
              $tmpAr[] = LibScores::outcomeScore($row['id'],$score);
            }
            $color = LibIncidents::getColorName($colCtr);
            $colCtr++;
            $a = array("label"=>$row['name'],"fill"=>"false","backgroundColor"=>$color,"borderColor"=>$color,
                      "data"=>$tmpAr);
            array_push($lstData,$a);
          }
        }
        else {
          $results = ClosedOutcomeForms::where('status',20)->where('region',$params['oRegion'])->select('location_id','locname')->distinct('location_id')->get();
          $lstLocations = array();
          foreach($results as $row){
            $lstLocations[] = array("id"=>$row->location_id,"name"=>$row->locname);
          }

          $minDate = $minYY."-01";
          if($params['oFrom'] != "") $minDate = $params['oFrom'];
          $maxDate = $maxYY."-01";
          if($params['oTo'] != "") $maxDate = $params['oTo'];

          $start = (new DateTime($minDate))->modify('first day of this month');
          $end = (new DateTime($maxDate))->modify('first day of next month');
          $interval = DateInterval::createFromDateString('1 month');
          $period   = new DatePeriod($start, $interval, $end);

          $lstPeriod=array();
          $pCtr=1;
          foreach ($period as $dt) {
            if($pCtr < 12) {
                $lstPeriod[] = array("id"=>$dt->format("Y-m"),"name"=>$dt->format("F Y"));
            }
            $pCtr++;
          }

          foreach($lstLocations as $row){
            $tmpAr = array();
            foreach ($period as $dt) {
              $yy = $dt->format('Y');
              $mm = $dt->format('m');
              $score = ClosedOutcomeForms::where('form_id',$params['oForm'])
                      ->whereYear('completed_date',$yy)
                      ->whereMonth('completed_date',$mm)
                      ->where('location_id',$row['id'])
                      ->where('status',20)
                      ->select('total_score')
                      ->avg('total_score');
              if($score=="") $score=0;
              $tmpAr[] = LibScores::outcomeScore($params['oForm'],$score);
            }
            $color = LibIncidents::getColorName($colCtr);
            $colCtr++;
            $a = array("label"=>$row['name'],"fill"=>"false","backgroundColor"=>$color,"borderColor"=>$color,
                      "data"=>$tmpAr);
            array_push($lstData,$a);
          }
        }
        $data['forms'] = $lstForms;
        $data['periods'] = $lstPeriod;
        $data['data'] = $lstData;
        return $data;
      }
}
?>
