<?php 
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
use App\Model\DbModels\ClosedAuditForms;
class LibAuditForms
{
    public static function getMonthlyFIA($userid,$location,$period="",$pg)
    {
        $periodName="";
        $score=0;
        $status="fail";
        $message="We couldn't fetch data for your selection";
        $header="No Data Found";
        $locationName="";
        $tagLine="";
        $mHeader = "Focussed Internal Audit";
        $notFound = array("showHeader"=>"YES","header"=>"No Data Found","mHeader"=>$mHeader,"message"=>"We couldn't fetch data for your selection");
        $output = array();
        if($pg == "HOME")
        {
            $header="";
            $notFound['showHeader'] = "NO";
            if($location == "")
            {
                $location = LibAuditForms::getDefaultLocation($userid);
            }
            if($location != "") {
                $cnt = LibAuditForms::fiaResultsCount($userid,$location);
            
                if($cnt > 0)
                {
                    $notFound['showHeader'] = "YES";
                    $status = "success";
                    $rsForms = LibAuditForms::fiaResults($userid,$location);
                    $mm = intval(date('m',strtotime($rsForms->assign_date)));
                    $yy = date('Y',strtotime($rsForms->assign_date));
                    $periodName = date('F Y',strtotime($rsForms->assign_date));
                    $locationName = Locations::getName($location);
                    $score = $rsForms->total_score;
                    //LibAuditForms::getFiaScore($location,$yy,$mm);
                    $score = LibAuditForms::getFiaScore($location,$yy,$mm);
                    $message = LibAuditForms::fiaAvgScore($yy,$mm);
                    $tagLine="Focused Internal Audit - ".$periodName;
                    $notFound=array();
                }
            }
        }
        else
        {
            $sPeriod = $period."-01";
            $yy = date('Y',strtotime($sPeriod));
            $mm = date('m',strtotime($sPeriod));
            $periodName = date('F Y',strtotime($sPeriod));
            $cnt = LibAuditForms::fiaResultsCount($userid,$location,$yy,$mm);
            if($cnt > 0)
            {
                $status = "success";
                $rsForms = LibAuditForms::fiaResults($userid,$location,$yy,$mm);
                $locationName = Locations::getName($location);
                $score = LibAuditForms::getFiaScore($location,$yy,$mm);
                $message = LibAuditForms::fiaAvgScore($yy,$mm);
                $tagLine="Focused Internal Audit - ".$periodName;
                $notFound = array();
            }
            else{
               $rsCenter = ViewCenter::where('center_id',$location)->select('bu_name')->get();
               $b=0;
               foreach($rsCenter as $row){
                   if($row->bu_name == "CRADLE" || $row->bu_name=="SPECTRA") $b=1;
               } 
               if($b==0){
                   $notFound['showHeader'] = "NO";
               }
            }
        }

        $lstOutcome = array("status"=>$status,"notFound"=>$notFound,"center"=>$locationName,"tagLine"=>$tagLine,"value"=>$score,"message"=>$message);
        return $lstOutcome;
    }

    public static function fiaResults($userid,$location,$yy=0,$mm=0)
    {
        $query = ClosedAuditForms::where('status',20);
        if($location != ""){
            $query->where('location_id',$location);
        }
        if($yy != 0){
            $query->whereYear('assign_date',$yy);
        }
        if($mm != 0){
            $query->whereMonth('assign_date',$mm);
        }
        $query->orderBy('completed_date','desc');
        $rs = $query->first();
        return $rs;
    }
    public static function fiaResultsCount($userid,$location,$yy=0,$mm=0)
    {
        $query = ClosedAuditForms::where('status',20);
        if($location != ""){
            $query->where('location_id',$location);
        }
        if($yy != 0){
            $query->whereYear('assign_date',$yy);
        }
        if($mm != 0){
            $query->whereMonth('assign_date',$mm);
        }
        $cnt = $query->count();
        return $cnt;
    }
    
    public static function getDefaultLocation($userid)
    {
        $loc="";
        $query = ClosedAuditForms::join('v_user_locations','v_user_locations.location','v_closed_audit_forms.location_id')
                    ->where('v_user_locations.id',$userid);
        
        $query->orderBy('v_closed_audit_forms.assign_date','asc');
        $cnt = $query->count();
        if($cnt > 0){
            $rs = $query->select('v_user_locations.location')->first();
            $loc = $rs->location;
        }
        return $loc;
    }
    public static function fiaAvgScore($yy,$mm)
	{
		$message="";
		$query = "SELECT avg(total_score) as t,location_id FROM v_closed_audit_forms where year(assign_date) = '".$yy."' and month(assign_date) = '".$mm."'";
        $query .= " group by location_id ";
        $query .= " order by avg(total_score) desc limit 1";
		$cnt = ClosedAuditForms::whereYear('assign_date',$yy)->whereMonth('assign_date',$mm)->count();
		if($cnt > 0){
			$r = DB::select($query);
			foreach($r as $r1){
				$maxAvgLoc = $r1->location_id;
				$maxAvgScore = $r1->t;
			}
			$maxAvgScore = round($maxAvgScore,2);
			$maxAvgLocName = Locations::getName($maxAvgLoc);
			$message = "Highest score by ".$maxAvgLocName." with ".$maxAvgScore; 
		}
       
		return $message;
	}
	public static function getFiaScore($location,$yy,$mm)
	{
		$query = ClosedAuditForms::whereYear('assign_date',$yy)
				->whereMonth('assign_date',$mm);
		if($location != "") {
			$query->where('location_id',$location);
		}
		$score = $query->select('total_score')
				->avg('total_score');
		$score = round($score,2);
		return $score;
    }
    public static function calculateResult($id)
    {
        $compliance = Q4eAnswers::where('assign_id',$id)->where('answer','Yes')->count();
        $nonCompliance = Q4eAnswers::where('assign_id',$id)->where('answer','No')->count();
        $totalObservations = $compliance + $nonCompliance;
        $perCompliance=0;
        if($compliance > 0 && $totalObservations > 0){
        	$perCompliance = ($compliance/$totalObservations) * 100;
        }
        $out['compliance'] = $compliance;
        $out['nonCompliance'] = $nonCompliance;
        $out['totalObservations'] = $totalObservations;
		$out['perCompliance'] = round($perCompliance,2);
		$o['total_score'] = $out['perCompliance'];
        Q4eAssign::where('id',$id)->update($o);
        return $out;
    }
}
?>
