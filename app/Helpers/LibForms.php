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
use App\Helpers\LibOutcomeForms;
use App\Model\DbModels\FormPeriods;
class LibForms
{
    public static function perScore($formID,$formCode,$score)
    {
        $per=0;
        if($formCode == "OUTCOME"){
            $max=125;
        } else {
            $rs = Q4eItems::join('q4e_sections','q4e_sections.id','q4e_items.section_id')
                ->where('q4e_sections.form_id',$formID)
                ->sum('q4e_items.max_val');
            $max = intval($rs);
            
        }
        if($score != 0 && $max != 0){
                $per = intval((100 * $score)/$max);
                }
         
        return $per;

    }
    public static function getLastPeriod($formID)
    {
        $results = Q4ePeriods::where('form_id',$formID)->where('status',20)->select('per')->max('per');
        return $results;
    }
    public static function getColors()
    {
        return array("red","pink","purple","deep-purple","indigo","blue","light-blue","cyan","teal","green","light-green","lime","yellow","amber","orange","deep-orange","brown","grey","blue-grey");
    }
    public static function getIcons()
    {
        return array("apollo_cradle","apollo_clinic","apollo_dental","apollo_diagnostics","apollo_dialysis",
                    "apollo_fertility","apollo_main","apollo_spectra","apollo_sugar","codered","codeblue","codepink","cssd",
                     "hr","hra","laundary","kitchen","mrd_audit","nursing","nursing_documentation","project-management","q4e",
                     "radiology","safety","self_assessment");
    }
    public static function getInputType()
    {
        return array("TEXT"=>"TEXT","LABEL"=>"LABEL","SELECT"=>"SELECT","NUMBER"=>"NUMBER","TEXTAREA"=>"TEXTAREA","RADIO"=>"RADIO","YESNO"=>"YESNO");
    }
	public static function getFrequency()
    {
    	return array(""=>"","Daily"=>"Daily","Weekly"=>"Weekly","Fortnightly"=>"Fortnightly","Monthly"=>"Monthly","Perpetual"=>"Perpetual","Quarterly"=>"Quarterly");
    }
    public static function getStyles()
    {
    	return array("Tabular"=>"Tabular","Single Textbox"=>"Single Textbox","1 Column"=>"1 Column");
    }
    public static function getSectionTypes()
    {
    	return array("User Input"=>"User Input","Calculation"=>"Calculation");
    }
    public static function dbOutComeForms()
    {
        $results = OutcomeForms::select('form_id','region','regionname')->distinct('form_id')->orderBy('regionname')->get();
        return $results;
    }
    
    public static function getSections($id)
    {
    	// $results = Q4eSections::join('q4e_answer_types','q4e_answer_types.id','q4e_sections.answer_type')
     //                ->join('q4e_type','q4e_type.id','q4e_sections.rating_typ')
     //                ->where('form_id',$id)
     //                ->select('q4e_answer_types.name as answername','q4e_type.name as ratingname','q4e_sections.*')
     //                ->orderBy('ord')->get();
        $results = Q4eSections::where('form_id',$id)->orderBy('ord')->get();
        $output=array();
        foreach($results as $row)
        {
        	$a = $row;
            $a['statusName'] = $row->status == 0 ? "Active" : "Suspended";
            $a['displayName'] = $row->display == 0 ? "Yes" : "No";
            $a['answerType'] = Q4eAnswerType::getName($row->answer_type);
        	$a['cnt'] = Q4eItems::where('section_id',$row->id)->count();
        	$a['lstItems'] = LibForms::getItemsForSection($row->id); 
        	array_push($output,$a);
        }
        return $output;
    }
    
    public static function getItemsForSection($section,$lstAnswers = array(),$params = array())
    {
        $options = array();
        $options['all'] = "";
        if(isset($params['all']) && $params['all'] =="YES") $options['all'] = "YES";
        if($options['all'] == "YES"){
    	   $results = Q4eItems::where('section_id',$section)->orderBy('ord')->limit(2)->get();
        }
        else {
            $results = Q4eItems::where('section_id',$section)->where('status','=',0)->orderBy('ord')->get();
        }
    	$output = array();
    	$ctr=1;
        $dCtr=1;
    	foreach($results as $row)
    	{
            $a = array();
    		$a['ctr']=$ctr;
    		$a['id'] = $row->id;
            $a['lbl_number']=$dCtr;
            $a['fld_name'] = "f".$row->id;
    		$a['name'] = $row->name;
            if($row->name_show=="N") $a['name'] = "";
    		$a['status'] = $row->status;
    		$a['statusName'] = $row->status == 0 ? "Active" : "Suspended";
    		$a['ord'] = $row->ord;
    		$a['typ'] = $row->typ;
            $a['header'] = $row->header;
            if(is_null($row->header)) $a['header'] = "";
            if($row->header_show=="N") $a['header'] = "";
            $a['max_val'] = $row->max_val;
            $a['no_results'] = $row->no_results;
            $a['remarks'] = $row->remarks;
            if(is_null($row->remarks)) $a['remarks'] = "";
            if($row->remarks_show=="N") $a['remarks'] = "";
            if($a['remarks'] == "") $a['remarks'] = "Remarks, if any";
            $a['caption2'] = $row->caption2;
            if(is_null($row->caption2)) $a['caption2'] = "";
            if($row->caption2_show=="N") $a['caption2'] = "";
            $a['results_caption'] = $row->results_caption;
            if(is_null($row->results_caption)) $a['results_caption'] = "";
            if($row->caption_show == "N") $a['results_caption'] = "";
    		//$a['answer_type'] = $row->answer_type;
            $a['answerOptions'] = array();
            if($row->typ=="SELECT" || $row->typ=="RADIO"){
                $a['answerOptions'] =  LibForms::getItemsChoice($row->id);
            }
            if($row->typ=="YESNO"){
                $a['answerOptions'] =  LibForms::getYesNo();
                $a['typ'] = "RADIO";
            }
            $val="";
            $remarks="";
            $answer1="";
            foreach($lstAnswers as $arow){
                if($arow['field_id'] == $row->id) {
                    $val = $arow['answer'];
                    $remarks = $arow['remarks'];
                    $answer1 = $arow['answer1'];
                }
            }
            $a['fld_answer'] = $val;
            $a['fld_remarks'] = $remarks;  
            $a['fld_remarks_name'] = "r".$row->id;  
            $a['fld_answer1'] = $answer1;
            $a['fld_name2'] = "a".$row->id;
            if($a['typ'] != "LABEL") $dCtr++;
            $ctr++;
            array_push($output,$a);
            //array_push($arAnswers,$a);
                //$a['lbl_caption'] = $row->name;
                //$a['lbl_tips'] = $row->header;
                
                //$a['fld_type'] = $row->typ;
                // $a['fld_options'] = array();
                // if($a['fld_type']=="SELECT"){
                //     $a['fld_options'] = LibForms::getItemsChoicde($row->id);
                // }
                // $cnt = Q4eAnswerType::where('id',$row->answer_type)->count();
                // if($cnt > 0)
                // {
                //     $r = Q4eAnswerType::where('id',$row->answer_type)->first();
                //     $a['fld_options'] = explode(";", $r->options);
                // }
                
                
                //$a['fld_remarks_name'] = "r".$row->id;
                //$a['fld_remarks_placeholder'] = $srow->remarks_header;
                //if($a['fld_type'] == "SELECT") $ctr++;
                //array_push($arAnswers,$a);
    		// $a['answerType'] = "";
    		// $a['answerOptions'] = "";
            
    		// $cnt = Q4eAnswerType::where('id',$row->answer_type)->count();
    		// if($cnt > 0)
    		// {
    		// 	$r = Q4eAnswerType::where('id',$row->answer_type)->first();
    		// 	$a['answerType'] = $r->name;
    		// 	$a['answerOptions'] = $r->options;
    		// }
    		// Q4eAnswerType::getName($row->answer_type);
    		//
    		
    	}
    	return $output;
    }
    public static function getYesNo(){
        $lstOutput[] = "Yes";
        $lstOutput[] = "No";
        return $lstOutput;
    }
    public static function getItemsChoice($item)
    {
        $results = Q4eItemsChoice::where('item_id',$item)->where('status','=',0)->get();
        $lstOutput=array();
        foreach($results as $row){
            // $a['label'] = $row->label;
            // $a['value'] = $row->val;
            // array_push($lstOutput,$a);
            $lstOutput[] = $row->label;
        }
        return $lstOutput;
    }
    public static function getUsersForQ4EAssignment($id)
    {
        $results = Q4EUsers::where('formid',$id)->select('userid')->groupBy('userid')->get();
        $lstUsers = array();
        foreach($results as $row)
        {
            $lstUsers[] = $row->userid;
        }
        return $lstUsers;
    }
    public static function getUserList($id)
    {
        $results = Q4EPerms::where('form_id',$id)->select('center','userid')->get();
        $lstUsers = array();
        foreach($results as $row){
            $lstUsers[] = array("userid"=>$row->userid,"center"=>$row->center);
        }
        return $lstUsers;
    }
    public static function generateAssignments()
    {
        $lstForms = Q4eForms::join('q4e_type','q4e_type.id','q4e_forms.typ')
                    ->where('q4e_forms.status',0)
                    ->select('q4e_type.code','q4e_forms.*')
                    ->get();
        foreach($lstForms as $row)
        {
            $id = $row->id;
            $code = $row->code;
            $freqType = $row->frequency;
            $nextMonth = date('Y-m-01',strtotime('first day of +1 month'));
            $lstUsers = LibForms::getUserList($id);
            foreach($lstUsers as $u)
            {
                $_userid = $u['userid'];
                $_center = $u['center'];
                switch(strtoupper($freqType)):
                    case "FORTNIGHTLY":
                        $nextDate = date('Y-m-01',strtotime('first day of +1 month'));
                        $period = date('F Y',strtotime($nextDate));
                        LibForms::addAssign($id,$_userid,$nextDate,$row->days_submit,$_center,$period);
                        $nextDate = date('Y-m-d',strtotime($nextDate. ' + 14 days'));
                        $aDate = $nextDate;
                        $period = date('F Y',strtotime($nextDate));
                        LibForms::addAssign($id,$_userid,$nextDate,$row->days_submit,$_center,$period,$aDate);
                        break;
                    case "MONTHLY":
                        if($code=="OUTCOME"){
                            $nextDate = date('Y-m-01');
                            $period = date('F Y',strtotime($nextDate));
                            $aDate = $nextDate;
                        }
                        else {
                            $nextDate = date('Y-m-01',strtotime('first day of +1 month'));
                            $aDate = $nextDate;
                        }
                        $nextDate = date('Y-m-01',strtotime('first day of +1 month'));
                        LibForms::addAssign($id,$_userid,$nextDate,$row->days_submit,$_center,$period,$aDate);
                        break;
                    case "PERPETUAL":
                        break;
                    case "QUARTERLY":
                        $nextDate = date('Y-m-01',strtotime('first day of +1 month'));
                        $nextMonth = intval(date('m',strtotime('first day of +1 month')));
                        $period = date('F Y',strtotime($nextDate));
                        $isValidMonth = LibForms::isValidMonth($id,$nextMonth);
                        if($isValidMonth == 1)
                       // if($nextMonth == 1 || $nextMonth == 4 || $nextMonth == 7 || $nextMonth == 10)
                        {
                            $nMM = intval(date('m',strtotime('first day of +1 month')));
                            $nYY = date('Y',strtotime('first day of +1 month'));
                            $nextDate = $nYY."-".$nMM."-01"; 
                            $period = date('F Y',strtotime($nextDate));
                            $aDate = $nextDate;
                            LibForms::addAssign($id,$_userid,$nextDate,$row->days_submit,$_center,$period,$aDate);
                        }
                        break;
                    default:
                        $nextDate = date('Y-m-01',strtotime('first day of +1 month'));
                        $period = date('F Y',strtotime($nextDate));
                        break;
                endswitch;
                //}
            }
        }
    }
    
    public static function addAssign($id,$userid,$nextDate,$days_submit,$locid,$period,$aDate)
    {   
        echo "iD = ".$id."<br>Userid :".$userid."<br>Next Date ".$nextDate."<br>Days Submit ".$days_submit;
        echo "<br>LOC ID ".$locid."<BR>Period ".$period."<br>ADate ".$aDate;
        
        $results = Q4EForms::join('q4e_type','q4e_type.id','q4e_forms.typ')
                    ->where('q4e_forms.id',$id)
                    ->select('q4e_forms.name','q4e_forms.icon','q4e_type.code','q4e_forms.name','q4e_forms.route','q4e_forms.assign_msg')->first();
        $endDate = date('Y-m-d',strtotime($nextDate. ' + '.$days_submit.' days'));
        $per = date('Y-m',strtotime($aDate));
        if($results->code == "CHECKLIST") {
            $cnt = Q4eAssign::where('form_id',$id)
                    ->where('userid',$userid)
                    ->where('location_id',$locid)
                    ->whereDate('start_date','=',$nextDate)
                    ->count();
        } else {
            $cnt = Q4eAssign::where('form_id',$id)
                    ->where('userid',$userid)
                    ->where('location_id',$locid)
                    ->where('per','=',$per)
                    ->count();
        }
        
        $formCode = $results->code;
        if($cnt == 0)
        {
            $l = new Q4eAssign;
            $l->form_id=$id;
            $l->userid=$userid;
            $l->assign_date=$nextDate;
            $l->status=0;
            $l->start_date = $nextDate;
            $l->end_date = $endDate;
            $l->location_id = $locid;
            $l->period = $period;
            $l->per = $per;
            $l->save();
            $assignID = $l->id;
            LibForms::addPeriod($id,$nextDate,$period,$per);
            if($formCode=="CHECKLIST"){
            //    LibForms::addOutcomePeriod($id,$nextDate);
                //LibForms::fillAPIResults($assignID,$id,$userid,$locid,$nextDate);
                $sendDate = $nextDate;
            }
            else {
               
            }
            $action = $results->route;
            $action = str_replace("[ID]",$assignID,$action);
            $message = $results->assign_msg;
            LibNotifications::createFormNotification(array("senddate"=>$nextDate,"userid"=>$userid,"subject"=>$results->name,"icon"=>$results->icon,"action"=>$action,"message"=>$message,"id"=>$assignID,"typ"=>$results->code));
        }
    }
    
    public static function addPeriod($id,$d,$period,$aper)
    {
        $yymm = date('Ym',strtotime($d));
        $per = date('Y-m',strtotime($d));
        $cnt = Q4ePeriods::where('form_id',$id)->where('per',$aper)->count();
        if($cnt == 0){
            $l = new Q4ePeriods;
            $l->form_id = $id;
            $l->period = $yymm;
            $l->status = 0;
            $l->per = $aper;
            $l->save();
        }
    }
    public static function fillAPIResults($assign,$form,$user,$loc,$nextDate)
    {
        $pYYMM = date('Y-m',strtotime($nextDate));
        $pFullDate = $pYYMM."-01";

        $yy = intval(date('Y', strtotime('-1 day', strtotime($pFullDate))));
        $mm = intval(date('m', strtotime('-1 day', strtotime($pFullDate))));
        $cnt = Q4EApiRes::where('mm',$mm)->where('yy',$yy)->count();
        if($cnt == 0)
        {
            $results = LibAPI::getResultsFromAPI($mm,$yy);
            foreach($results as $r) {
                foreach($r as $ky=>$val) {
                    $cnt = Clinics::join('locations','locations.clinic_id','clinics.id')
                                ->where('clinics.clinic_code',$ky)->count();
                    if($cnt > 0){
                        $location = Clinics::join('locations','locations.clinic_id','clinics.id')
                                ->where('clinics.clinic_code',$ky)
                                ->select('locations.id')->first()->id;
                        $cnt = Q4EApiRes::where('location',$location)
                                ->where('mm',$mm)
                                ->where('yy',$yy)
                                ->where('clinic',$ky)
                                ->count();
                        $data['params'] =  json_encode($val);   
                        if($cnt > 0){
                            Q4EApiRes::where('location',$location)
                                ->where('mm',$mm)
                                ->where('yy',$yy)
                                ->where('clinic',$ky)
                                ->update($data);
                        }
                        else{
                            $l = new Q4EApiRes;
                            $l->location = $location;
                            $l->clinic = $ky;
                            $l->mm = $mm;
                            $l->yy = $yy;
                            $l->params = $data['params'];
                            $l->save();
                        }
                    }
                }
            }
        }
        $cnt = Q4EApiRes::where('location',$loc)->where('mm',$mm)->where('yy',$yy)->count();
        $params="";
        $paramsArray = array();
        if($cnt > 0){
            $params = Q4EApiRes::where('location',$loc)->where('mm',$mm)->where('yy',$yy)->select('params')->first()->params;
            $paramsArray = json_decode($params);
        }
        $lstFields = Q4eOutcome::where('form_id',$form)->select('id','api_code')->get();
        foreach($lstFields as $row){
            $cnt = Q4eOAnswers::where('assign_id',$assign)->where('field_id',$row->id)->count();
            $apiCode = $row->api_code;
            if($cnt == 0){
                $val=0;
                if($params != ""){
                    if($apiCode != ""){
                        if(isset($paramsArray->$apiCode)){
                            $val = $paramsArray->$apiCode;
                        }
                    }
                }
                $l = new Q4eOAnswers;
                $l->assign_id = $assign;
                $l->field_id = $row->id;
                $l->numerator=0;
                $l->denominator = $val;
                $l->score=0;
                $l->score_val=0;
                $l->reason="";
                $l->action_plan="";
                $l->qa_remarks="";
                $l->valid=0;
                $l->save();
            }
        }

    }
    // public static function __generateAssignments()
    // {
    //     $lstForms = Q4eForms::where('status',0)->get();
    //     foreach($lstForms as $f)
    //     {
    //         $id = $f->id;
    //         $results = Q4eForms::where('id',$id)->first();
    //         $freqType = $results->frequency;
    //         $freqType = "QUARTERLY";
    //         $nextMonth = date('Y-m-01',strtotime('first day of +1 month'));
    //         $lstUsers = ApolloHelpers::getUsersForQ4EAssignment($id,"Q4E");
    //         foreach($lstUsers as $u)
    //         {
    //             switch(strtoupper($freqType)):
    //                 case "FORTNIGHTLY":
    //                     $nextDate = date('Y-m-01',strtotime('first day of +1 month'));
    //                     LibForms::addAssign($id,$u,$nextDate,$results->days_submit);
    //                     $nextDate = date('Y-m-d',strtotime($nextDate. ' + 14 days'));
    //                     LibForms::addAssign($id,$u,$nextDate,$results->days_submit);
    //                     break;
    //                 case "MONTHLY":
    //                     $nextDate = date('Y-m-01',strtotime('first day of +1 month'));
    //                     LibForms::addAssign($id,$u,$nextDate,$results->days_submit);
    //                     break;
    //                 case "PERPETUAL":
    //                     break;
    //                 case "QUARTERLY":
    //                     $nextMonth = intval(date('m',strtotime('first day of +1 month')));
    //                     $isValidMonth = LibForms::isValidMonth($id,$nextMonth);
    //                     //if($nextMonth == 1 || $nextMonth == 4 || $nextMonth == 7 || $nextMonth == 10)
    //                     if($isValidMonth == 1)
    //                     {
    //                         $nMM = intval(date('m',strtotime('first day of +1 month')));
    //                         $nYY = date('Y',strtotime('first day of +1 month'));
    //                         $nextDate = $nYY."-".$nMM."-01"; 
    //                         LibForms::addAssign($id,$u,$nextDate,$results->days_submit);
    //                     }
    //                     break;
    //             endswitch;
    //         }
    //     }
    // }
    public static function isValidMonth($id,$month)
    {
        $mm = intval($month);
        $cnt = FormPeriods::where('form_id',$id)->where('period','=',$mm)->count();
        $b=0;
        if($cnt > 0) $b=1;
        return $b;
    }
    public static function getAssign($id,$status="")
    {
        $results = Q4eAssign::where('form_id',$id)->orderBy('start_date')->get();
        $output=array();
        foreach($results as $row)
        {
            $a['id'] = $row->id;
            $a['form_id'] = $row->form_id;
            $a['userid'] = $row->userid;
            $a['userName'] = Users::getName($row->userid);
            $a['assign_date'] = $row->assign_date;
            $a['completed_date'] = $row->completed_date;
            $a['status'] = $row->status;
            $a['start_date'] = $row->start_date;
            $a['end_date'] = $row->end_date;
            $a['statusName'] = LibForms::getAssignStatusName($row->status);
            $a['fAssignDate'] = date('d/m/Y H:i',strtotime($row->assign_date));
            $a['fCompleteDate'] = "";
            if($a['status'] == 20){
                $a['fCompleteDate'] = date('d/m/Y H:i',strtotime($row->completed_date));
            }
            $a['fStartDate'] = date('d/m/Y H:i',strtotime($row->start_date));
            $a['fEndDate'] = date('d/m/Y H:i',strtotime($row->end_date));
            $a['totalScore'] = $row->total_score;
            $a['location_id'] = $row->location_id;
            $a['locname']  = Locations::getName($row->location_id);
            array_push($output,$a);
        }
        return $output;
    }
    public static function getAssignStatusName($status)
    {
        $out="";
        if($status == 0) $out="New";
        if($status==10) $out="In Progress";
        if($status == 20) $out="Completed";
        return $out;
    }
    public static function saveAnswers($id,$formID,$request,$status,$sid=0)
    {
        $lstSections = LibForms::getSections($formID);
        if($sid==0){
            Q4eAnswers::where('assign_id',$id)->delete();
        }
        else{
            Q4eAnswers::where('assign_id',$id)->where('sess_id',$sid)->delete();
        }
        $lstChoices = Q4eItemsChoice::join('q4e_items','q4e_items.id','q4e_items_choice.item_id')
                    ->join('q4e_sections','q4e_sections.id','q4e_items.section_id')
                    ->where('q4e_sections.form_id',$formID)
                    ->select('label','val','item_id')->get();
        foreach($lstSections as $row)
        {
            foreach($row['lstItems'] as $srow)
            {
                if($srow['status'] == 0)
                {
                    $varName = "f".$srow['id'];
                    $fieldValue="";
                    $remarks="";
                    $answer1="";
                    if(isset($request->$varName) && $request->$varName != "")
                    {
                        $fieldValue=$request->$varName;
                    }
                    $varName = "r".$srow['id'];
                    if(isset($request->$varName) && $request->$varName != "")
                    {
                        $remarks=$request->$varName;
                    }
                    $varName = "a".$srow['id'];
                    if(isset($request->$varName) && $request->$varName != "")
                    {
                        $answer1=$request->$varName;
                    }
                    $val=0;
                    if($srow['typ'] == "SELECT" || $srow['typ'] == "RADIO"){
                        foreach($lstChoices as $crow){
                            if($crow->item_id == $srow['id'] && $crow->label == $fieldValue){
                                $val = $crow->val;
                            }
                        }
                    }
                    $l = new Q4eAnswers;
                    $l->assign_id = $id;
                    $l->field_id = $srow['id'];
                    $l->answer = $fieldValue;
                    $l->answer1 = $answer1;
                    $l->remarks = $remarks;
                    $l->val=$val;
                    $l->sess_id = $sid;
                    $l->save();
                }
            }
        }
        $p['status'] =  $status;
        if(isset($request->observations)) $p['remarks'] = $request->observations;
        if(isset($request->sur_name)) $p['sur_name'] = $request->sur_name;
        if(isset($request->sur_date)) $p['sur_date'] = ApolloHelpers::formatDate($request->sur_date);
        if($status==20) $p['completed_date'] = Carbon::now();
        Q4eAssign::where('id',$id)->update($p);

    }
    public static function recalcOutcomeScore($formid,$id)
    {

        $lstSections = Q4eOutcome::where('form_id',$formid)->where('status',0)->get();
        foreach($lstSections as $row)
        {
            $results = Q4eOAnswers::where('assign_id',$id)->where('field_id',$row->id)->get();
            foreach($results as $srow) {
                $nValue = $srow->numerator;
                $dValue = $srow->denominator;
                $t = LibForms::calcOutcomeScore($row,$nValue,$dValue);
                $data=array();
                $data['score'] = $t['score'];
                $data['score_val'] = $t['score_val'];
                Q4eOAnswers::where('id',$srow->id)->update($data);
            }
        }
        
        $totalScore = Q4eOAnswers::where('assign_id',$id)->where('valid',1)->sum('score');
        $p['total_score'] = $totalScore;
        Q4eAssign::where('id',$id)->update($p);
    }
    public static function saveOutcomeAnswers($id,$formID,$request,$status)
    {
        $lstSections = Q4eOutcome::where('form_id',$formID)->where('status',0)->get();
        Q4eOAnswers::where('assign_id',$id)->delete();
        foreach($lstSections as $row)
        {
            $nField = "n".$row['id'];
            $nValue=0;
            $dField = "d".$row['id'];
            $dValue=0;
            $valid = 0;
            if(isset($request->$nField))
            {
                $nValue=$request->$nField;
                $valid=1;
            }
            if(isset($request->$dField))
            {
                $dValue=$request->$dField;
                $valid=1;
            }
            $l = new Q4eOAnswers;
            $l->assign_id = $id;
            $l->field_id = $row['id'];
            $l->numerator = $nValue;
            $l->denominator = $dValue;
            $t =LibForms::calcOutcomeScore($row,$nValue,$dValue); 
            $l->score = $t['score'];
            $l->score_val = $t['score_val'];
            $l->valid=$valid;
            $l->save();
        }
        $totalScore = Q4eOAnswers::where('assign_id',$id)->where('valid',1)->sum('score');
        $p['total_score'] = $totalScore;
        $p['status'] =  $status;
        if(isset($request->observations)) $p['remarks'] = $request->observations;
        if($status==20) $p['completed_date'] = Carbon::now();
        Q4eAssign::where('id',$id)->update($p);

    }
    public static function testOutcome()
    {
        $results = Q4eOAnswers::get();
        foreach($results as $r)
        {
            $row = Q4eOutcome::where('id',$r->field_id)->first();
            $score = LibForms::calcOutcomeScore($row,$r->numerator,$r->denominator);
            Q4eOAnswers::where('id',$r->id)->update(array("score"=>$score));
        }

    }
    public static function calcOutcomeScore($row,$nValue,$dValue)
    {
        $score=0;
        $den = 0;
        $cnt = Q4eResultsCalc::where('id',$row->formula)->count();
        if($cnt > 0)
        {
            $c = Q4eResultsCalc::where('id',$row->formula)->first();
            switch($c->code):
                case "NUM_DEN_X_100":
                    if($nValue > 0 && $dValue > 0) {
                        $den = round((($nValue/$dValue)*100),2);
                        //if($den > 100) $den=100;
                    }
                    break;
                 case "NUM_DEN_X_1000":
                    if($nValue > 0 && $dValue > 0) {
                        $den = round((($nValue/$dValue)*1000),2);
                        //if($den > 100) $den=100;
                    }
                    break;
                case "NONE":
                    $den = $nValue;
                    break;
                case "NUM_DEN":
                    if($nValue > 0 && $dValue > 0) $den = round(($nValue/$dValue),2);
                    break;
            endswitch;
            $s = array("1"=>array("min"=>$row['score_1_min'],"max"=>$row['score_1_max']),
                        "2"=>array("min"=>$row['score_2_min'],"max"=>$row['score_2_max']),
                        "3"=>array("min"=>$row['score_3_min'],"max"=>$row['score_3_max']),
                        "4"=>array("min"=>$row['score_4_min'],"max"=>$row['score_4_max']),
                        "5"=>array("min"=>$row['score_5_min'],"max"=>$row['score_5_max'])
                    );
            foreach($s as $ky=>$val){
                if($den >= floatval($val['min']) && $den <= floatval($val['max'])) $score=$ky;
            }
        }
        $out['score_val'] = $den;
        $out['score'] = $score;
        return $out;
    }
    public static function getAssignDetails($id)
    {
        $results = Q4eAssign::join('users','users.id','q4e_assign.userid')
                    ->where('q4e_assign.id',$id)
                    ->select('users.name as username','q4e_assign.*')
                    ->first();
        $results['validated_user_name'] = "";
        if($results['validated_user'] != 0)
        {
            $results['validated_user_name'] = Users::getName($results['validated_user']);
        }
        $output['form_id'] = $results->form_id;
        $output['formDetails'] = Q4EForms::getOneForm($output['form_id']);
        $output['assignDetails'] = $results;
        $formID = $results->form_id;
        $output['typCode'] = $output['formDetails']['typcode'];
        if($output['typCode'] == "OUTCOME"){
            $output['lstSections'] = LibForms::resultsForOutcome($id,$formID);

        }
        else{
            $output['lstSections'] = LibForms::getResultsForQ4E($id,$formID);
        }
        return $output;
    }
    
    public static function getResultsForQ4E($id,$formID)
    {
        $lstSections = LibForms::getSections($formID);
        $lstAnswers = Q4eAnswers::where('assign_id',$id)->get();
        $sectionResults = array();
        foreach($lstSections as $srow)
        {
            $out = array();
            $out['section'] = $srow;
            $section = $srow->id;
            $lstItems = Q4eItems::where('section_id',$section)->where('status',0)->orderBy('ord')->get();
            $arAnswers = array();
            $ctr=1;
            foreach($lstItems as $row)
            {
                $a = array();
                $a['ctr']=$ctr;
                $a['id'] = $row->id;
                $a['ddd']="DDD";
                $a['name'] = $row->name;
                $a['status'] = $row->status;
                $a['statusName'] = $row->status == 0 ? "Active" : "Suspended";
                $a['ord'] = $row->ord;
                $a['typ'] = $row->typ;
                $a['answer_type'] = $row->answer_type;
                $a['answerType'] = "";
                $a['answerOptions'] = "";
                $cnt = Q4eAnswerType::where('id',$row->answer_type)->count();
                if($cnt > 0)
                {
                    $r = Q4eAnswerType::where('id',$row->answer_type)->first();
                    $a['answerType'] = $r->name;
                    $a['answerOptions'] = $r->options;
                }
                // Q4eAnswerType::getName($row->answer_type);
                $a['header'] = $row->header;
                $val="";
                $remarks="";
                $answerID=0;
                foreach($lstAnswers as $arow){
                    if($arow['field_id'] == $row->id) {
                        $val = $arow['answer'];
                        $remarks = $arow['remarks'];
                        $answerID = $arow['id'];
                    }
                }
                $a['answerID'] = $answerID;
                $a['answer'] = $val;
                $a['remarks'] = $remarks;

                $ctr++;
                array_push($arAnswers,$a);
            }
            $out['lstItems'] = $arAnswers;
            array_push($sectionResults,$out);
        }
        // $output['lstSections'] = $sectionResults;
        // return $output;
        return $sectionResults;
    }

    public static function getTypesForUsers($userid)
    {
        $results = Q4eAssign::join('q4e_forms','q4e_forms.id','q4e_assign.form_id')
                    ->where('q4e_forms.status',0)
                    ->where('q4e_assign.userid',$userid)
                    ->whereDate('q4e_assign.assign_date','<=',Carbon::now())
                    ->select('q4e_forms.typ as t')
                    ->groupBy('q4e_forms.typ')
                    ->get();
        $output=array();
        foreach($results as $row)
        {
            $a = array();
            $r = Q4eType::where('id',$row->t)->first();
            $a['typname'] = $r->name;
            $a['code'] = $r->code;
            $cnt = Q4eAssign::join('q4e_forms','q4e_forms.id','q4e_assign.form_id')
                    ->where('q4e_forms.status',0)
                    ->where('q4e_assign.userid',$userid)
                    ->where('q4e_forms.typ',$row->t)
                    ->whereDate('q4e_assign.assign_date','<=',Carbon::now())
                    ->count();
            $a['new'] = $cnt;
            $cnt = Q4eAssign::join('q4e_forms','q4e_forms.id','q4e_assign.form_id')
                    ->where('q4e_forms.status',10)
                    ->where('q4e_assign.userid',$userid)
                    ->where('q4e_forms.typ',$row->t)
                    ->whereDate('q4e_assign.assign_date','<=',Carbon::now())
                    ->count();
            $a['inprogress'] = $cnt;
            $cnt = Q4eAssign::join('q4e_forms','q4e_forms.id','q4e_assign.form_id')
                    ->where('q4e_forms.status',20)
                    ->where('q4e_assign.userid',$userid)
                    ->where('q4e_forms.typ',$row->t)
                    ->whereDate('q4e_assign.assign_date','<=',Carbon::now())
                    ->count();
            $a['completed'] = $cnt;
            array_push($output,$a);
        }
        // $results = Assignments::join('q4e_type','q4e_type.id','v_assignments.typ')
        //             ->where('v_assignments.userid',$userid)
        //             ->select('q4e_type.name as typname','v_assignments.*')
        //             ->get();
        // $output=array();

        return $output;
    }
    public static function getListForUsers($userid,$code)
    {
        $results = Q4eAssign::join('q4e_forms','q4e_forms.id','q4e_assign.form_id')
                    ->join('q4e_type','q4e_type.id','q4e_forms.typ')
                    ->where('q4e_forms.status',0)
                    ->where('q4e_assign.userid',$userid)
                    ->where('q4e_type.code',$code)
                    ->whereDate('q4e_assign.assign_date','<=',Carbon::now())
                    ->select('q4e_forms.name as formName','q4e_forms.header as header','q4e_forms.footer as footer','q4e_type.name as typName','q4e_assign.*')
                    ->get();
        $output=array();
        foreach($results as $row)
        {
            $a = array();
            $locName = Locations::getLocationName($row->location_id);
            $a['id'] = $row->id;
            $a['form_id'] = $row->form_id;
            $a['typname'] = $row->typName;
            $a['code'] = $code;
            $a['status'] = $row->status;
            $a['name'] = $row->formName;
            $a['assign_date'] = $row->assign_date;
            $a['assign_month'] = date('F Y',strtotime($row->assign_date));
            $a['completed_date'] = "";
            $a['fCompletedDate'] = "";
            $a['status'] = $row->status;
            $a['statusName'] = LibForms::getAssignStatusName($row->status);
            if($row->status == 20)
            {
                $a['completed_date'] = $row->completed_date;
                $a['fCompletedDate'] = date('d/m/Y H:i',strtotime($row->completed_date));
            }
            $a['remarks'] = $row->remarks;
            $a['start_date'] = $row->start_date;
            $a['fStartDate'] = date('d/m/Y H:i',strtotime($row->start_date));
            $a['end_date'] = $row->end_date;
            $a['fEndDate'] = date('d/m/Y H:i',strtotime($row->end_date));
            $a['header'] = $row->header;
            $a['footer'] = $row->footer;
            $a['assign_msg'] = str_replace("{FORM_NAME}",$a['name'],$row->assign_msg);
            $a['reminder_msg'] = str_replace("{FORM_NAME}",$a['name'],$row->reminder_msg);
            $a['complete_msg'] = str_replace("{FORM_NAME}",$a['name'],$row->complete_msg);
            $a['lastUpdated'] = date('d/m/Y H:i',strtotime($row->updated_at));
            $a['locname'] = $locName; 
            array_push($output,$a);
        }
        return $output;
    }

    public static function getRecordForView($userid,$id,$sid=0)
    {
        $row = Q4eAssign::join('q4e_forms','q4e_forms.id','q4e_assign.form_id')
                    ->join('q4e_type','q4e_type.id','q4e_forms.typ')
                    ->where('q4e_forms.status',0)
                    //->where('q4e_assign.userid',$userid)
                    ->where('q4e_assign.id',$id)
                    ->whereDate('q4e_assign.assign_date','<=',Carbon::now())
                    ->select('q4e_forms.name as formName','q4e_forms.results_typ','q4e_type.name as typName','q4e_type.code as typCode','q4e_assign.*')
                    ->first();
        $details = array();
        $details['id'] = $row->id;
        $details['form_id'] = $row->form_id;
        $details['form_name'] = $row->formName;
        $details['typname'] = $row->typName;
        $details['monname'] = $row->period;
        
        //$details['code'] = $row->typCode;
        //$details['status'] = $row->status;
        //$details['name'] = $row->formName;
        //$details['assign_date'] = $row->assign_date;
        //$details['completed_date'] = "";
        $details['status'] = $row->status;
        $details['statusName'] = LibForms::getAssignStatusName($row->status);
        $details['actualCompleted'] = "";
        $details['resultsType'] = "";
        $results = array();
        if($row->status == 20)
        {
            //$details['completed_date'] = $row->completed_date;
            $details['actualCompleted'] = date('d/m/Y H:i',strtotime($row->completed_date));
            
            switch(strtoupper($row->results_typ)):
                case "SUM_COMPLIANCE":
                    $results = LibForms::sumCompliance($id);
                    $details['resultsType'] = "4-COL-TABLE";
                    break;
                case "SUM_SECTION":
                    $results = LibForms::sumSections($id,$row->form_id);
                    $details['resultsType'] = "4-COL-TABLE";
                    break;
            endswitch;
        }
        $details['lastUpdated'] = date('d/m/Y H:i',strtotime($row->updated_at));
        $details['remarks'] = $row->remarks;
        //$details['start_date'] = $row->start_date;
        //$details['fStartDate'] = date('d/m/Y',strtotime($row->start_date));
        //$details['end_date'] = $row->end_date;
        $details['tobeCompleted'] = date('d/m/Y',strtotime($row->end_date));
        $details['header'] = $row->header;
        $details['footer'] = $row->footer;
        $typ="";
        $lstSections = Q4eSections::where('form_id',$details['form_id'])->where('status',0)->orderBy('ord')->get();
        if($sid==0){
            $lstAnswers = Q4eAnswers::where('assign_id',$id)->get();
        }
        else {
             $lstAnswers = Q4eAnswers::where('assign_id',$id)->where('sess_id',$sid)->get();
        }
        $sectionResults = array();
        foreach($lstSections as $srow)
        {
            $section = $srow->id;
            $out['name']  = $srow->name;
            $out['style']  = $srow->style;
            $out['header1']  = $srow->header1;
            $out['header2']  = $srow->header2;
            $out['footer']  = $srow->footer;
            // $out['showremarks']=0;
            $out['showremarks']=$srow->showremarks;
            $lstItems = Q4eItems::where('section_id',$section)->where('status',0)->orderBy('ord')->get();
            $arAnswers = LibForms::getItemsForSection($srow->id,$lstAnswers,array("all"=>"NO"));
            // $ctr=1;
            // foreach($lstItems as $row)
            // {
            //     $a = array();
            //     $a['ctr']=$ctr;
            //     $a['id'] = $row->id;
            //     $a['lbl_number']=$ctr;
            //     $a['lbl_caption'] = $row->name;
            //     $a['lbl_tips'] = $row->header;
            //     $a['fld_name'] = "f".$row->id;
            //     $a['fld_type'] = $row->typ;
            //     $a['fld_options'] = array();
            //     if($a['fld_type']=="SELECT"){
            //         $a['fld_options'] = LibForms::getItemsChoicde($row->id);
            //     }
            //     // $cnt = Q4eAnswerType::where('id',$row->answer_type)->count();
            //     // if($cnt > 0)
            //     // {
            //     //     $r = Q4eAnswerType::where('id',$row->answer_type)->first();
            //     //     $a['fld_options'] = explode(";", $r->options);
            //     // }
            //     $val="";
            //     $remarks="";
            //     foreach($lstAnswers as $arow){
            //         if($arow['field_id'] == $row->id) {
            //             $val = $arow['answer'];
            //             $remarks = $arow['remarks'];
            //         }
            //     }
            //     $a['fld_answer'] = $val;
            //     $a['fld_remarks'] = $remarks;
            //     $a['fld_remarks_name'] = "r".$row->id;
            //     $a['fld_remarks_placeholder'] = $srow->remarks_header;
            //     if($a['fld_type'] == "SELECT") $ctr++;
            //     array_push($arAnswers,$a);
            // }
            $out['lstItems'] = $arAnswers;
            array_push($sectionResults,$out);
        }
        $lstAttachments = LibFiles::getListOfAttachments($id,"Q4E_RESULTS");
        $data  = array("details" => $details,"results"=>$results,"sections"=>$sectionResults,"attachments"=>$lstAttachments);
        return $data;
    }
    public static function getTotalScoreColor($score)
    {
        $out="";
        if($score >=91) $out = Config::get('custom.outcome-score.A');
        if($score >=81 && $score <= 90) $out = Config::get('custom.outcome-score.B');
        if($score >=71 && $score <= 80) $out = Config::get('custom.outcome-score.C');
        if($score >=61 && $score <= 70) $out = Config::get('custom.outcome-score.D');
        if($score <= 60) $out = Config::get('custom.outcome-score.E');
        return $out;
    }
    public static function getOutcomeRecordForView($userid,$id)
    {
        $row = Q4eAssign::join('q4e_forms','q4e_forms.id','q4e_assign.form_id')
                    ->join('q4e_type','q4e_type.id','q4e_forms.typ')
                    ->where('q4e_forms.status',0)
                    //->where('q4e_assign.userid',$userid)
                    ->where('q4e_assign.id',$id)
                    ->whereDate('q4e_assign.assign_date','<=',Carbon::now())
                    ->select('q4e_forms.name as formName','q4e_forms.results_typ','q4e_forms.header as header','q4e_forms.footer as footer','q4e_type.name as typName','q4e_type.code as typCode','q4e_assign.*')
                    ->first();
        $details = array();
        $details['id'] = $row->id;
        $details['form_id'] = $row->form_id;
        $details['form_name'] = $row->formName;
        $details['typname'] = $row->typName;
        $details['assign_month'] = $row->period;//date('F Y',strtotime($row->per."-01"));//date('F Y',strtotime($row->assign_date));
        $details['locname']  = Locations::getLocationName($row->location_id);
        $details['status'] = $row->status;
        $details['statusName'] = LibForms::getAssignStatusName($row->status);
        $details['actualCompleted'] = "";
       # $details['totalScore'] = $row->total_score;
        $details['totalScore'] = 0;
        $rsMaxScore = Q4eOAnswers::where('assign_id',$id)->count();
        $maxScore = $rsMaxScore * 5;
        if($row->total_score > 0 && $maxScore > 0){
            $details['totalScore'] = intval(($row->total_score/$maxScore) * 100);
        }
        //$details['totalScore'] = $row->total_score;
        $details['scoreColor'] = LibForms::getTotalScoreColor($details['totalScore']);
        $results = array();
        if($row->status == 20)
        {
            $details['actualCompleted'] = date('d/m/Y H:i',strtotime($row->completed_date));
            // $details['resultsType'] = "";
            // switch(strtoupper($row->results_typ)):
            //     case "SUM_COMPLIANCE":
            //         $results = LibForms::sumCompliance($id);
            //         break;
            //     case "SUM_SECTION":
            //         $results = LibForms::sumSections($id,$row->form_id);
            //         $details['resultsType'] = "4-COL-TABLE";
            //         break;
            // endswitch;
        }
        $details['lastUpdated'] = date('d/m/Y H:i',strtotime($row->updated_at));
        $details['remarks'] = empty($row->remarks) ? "" : $row->remarks;
        $details['tobeCompleted'] = date('d/m/Y',strtotime($row->end_date));
        $details['header'] = $row->header;
        $details['footer'] = $row->footer;
        $typ="";
        $sectionResults = LibForms::resultsForOutcome($id,$details['form_id']);
        $lstAttachments = LibFiles::getListOfAttachments($id,"Q4E_RESULTS");
        $data  = array("details" => $details,"sections"=>$sectionResults);
        return $data;
    }
    public static function outcomeScore($id,$score)
    {
        $rsMaxScore = Q4eOAnswers::where('assign_id',$id)->count();
        $maxScore = $rsMaxScore * 5;
        $totalScore=0;
        if($score > 0 && $maxScore > 0){
            $totalScore = intval(($score/$maxScore) * 100);
        }
        return $totalScore;
    }
    public static function resultsForOutcome($id,$formID)
    {
        LibForms::recalcOutcomeScore($formID,$id);
        $lstSections = Q4eOutcome::where('form_id',$formID)->where('status',0)->orderBy('ord')->get();
        $lstAnswers = Q4eOAnswers::where('assign_id',$id)->get();
        $inputItems = array();
        $qaItems = array();
        $ctr=1;
        $maxQA=0;
        $usedQA=0;
        $qaCtr=1;
        foreach($lstSections as $srow)
        {
            $out = array();
            $out['index']=$ctr;
            $out['ctr']=0;
            $out['id']  = $srow->id;
            $out['value'] = $srow->id;
            $out['label'] =  $srow->parameter;
            $out['parameter']  = $srow->parameter;
            $out['numerator']  = $srow->numerator;
            $out['denominator']  = $srow->denominator;
            if(strtoupper($srow->denominator) == "NONE") $out['denominator']="";
            $out['nval']=0;
            $out['dval']=0;
            $out['score']=0;
            $out['uomName']="";
            $out['disp'] = 0;
            $out['disable'] = false;
            $out['show'] = 0;
            $out['reason'] = "";
            $out['action_plan'] = "";
            $out['qa_remarks'] = "";
            if($srow->typ != "LABEL") {
                $c = Q4eOutcomeScore::getScoreDetails($srow->uom);
                if($c['status']=="success"){
                    $out['uomName'] = $c['name'];
                }
            }
            $out['typ']  = $srow->typ;
            $out['formula'] = $srow->formula;
            $out['score_val'] = 0;
            $out['score_color'] = "";
            foreach($lstAnswers as $arow)
            {
                if($arow['field_id'] == $srow->id) {
                    $out['nval'] = $arow['numerator'];
                    $out['dval'] = $arow['denominator'];
                    $out['score'] = $arow['score'];
                    if($out['score'] > 5) $out['score'] = 5;
                    if($out['score'] < 1) $out['score'] = 1;
                    $out['score_color'] = Config::get('custom.outcome-scoring-range.'.$out['score']);
                    $out['score_val'] = $arow['score_val'];
                    $out['disp']=1;
                    $out['show'] = $arow['valid'];

                    if($arow['valid'] == 1) {
                        $out['disable'] = true;
                        if($out['typ'] == "OP_INPUT") {
                            $out['ctr'] = $qaCtr;
                            $usedQA++;
                            $qaCtr++;
                        }
                    }
                    $out['reason'] = empty($arow['reason']) ? '' : $arow['reason'];
                    $out['action_plan'] = empty($arow['action_plan']) ? '' : $arow['action_plan'];
                    $out['qa_remarks'] = empty($arow['qa_remarks']) ? '' : $arow['qa_remarks'];
                }
            }
           
            if($out['typ'] == "INPUT"){
                array_push($inputItems,$out);
            }
            if($out['typ'] == "OP_INPUT"){
                $maxQA=4;
                array_push($qaItems,$out);
                
            }         
            if($out['typ'] != "LABEL") $ctr++;           
        }
        $section['inputItems'] = $inputItems;
        $section['qaItems'] = $qaItems;
        $section['maxQA'] = $maxQA;
        $section['usedQA'] = $usedQA;
        return $section;
    }
    public static function finishOutcomeForm(Request $request,$id)
    {
        $data['status'] = 20;
        $data['completed_date'] = Carbon::now();
        $lstAnswers = Q4eOAnswers::where('assign_id',$id)->where('score','<=',2)->get();
        foreach($lstAnswers as $row)
        {
            $tid = $row->field_id;
            $rField = "r".$tid;
            $reason="";
            $actionPlan = "";
            $b=0;
            if(isset($request->$rField) && $request->$rField != ""){
                $b=1;
                $reason = $request->$rField;
            }
            $rField = "a".$tid;
            if(isset($request->$rField) && $request->$rField != ""){
                $b=1;
                $actionPlan = $request->$rField;
            }
            if($b==1){
                Q4eOAnswers::where('id',$row->id)->update(array("reason"=>$reason,"action_plan"=>$actionPlan));
            }
        }
        Q4eAssign::where('id',$id)->update($data);
    }
    public static function deleteAPIAttachment($id,$attachmentID)
    {
        Attachments::where('id',$attachmentID)->where('parent_id',$id)->where('module','Q4E_RESULTS')->delete();
        $lstAttachments = LibFiles::getListOfAttachments($id,"Q4E_RESULTS");
        return $lstAttachments;
    }
    public static function sumCompliance($id)
    {
        $compliance = Q4eAnswers::where('assign_id',$id)->where('answer','Compliance')->count();
        $nonCompliance = Q4eAnswers::where('assign_id',$id)->whereIn('answer',['Non-Compliance','Non Compliance'])->count();
        $totalObservations = $compliance + $nonCompliance;
         $perCompliance = 0;
        if($compliance != 0 && $totalObservations != 0) {
            $perCompliance = round(($compliance/$totalObservations) * 100,2);
        }
        Q4eResults::where('assign_id',$id)->delete();
        LibForms::insertResult($id,1,"Total Compliances (A)",$compliance,"");
        LibForms::insertResult($id,2,"Total Non-Compliances (B)",$nonCompliance,"");
        LibForms::insertResult($id,3,"Total Observations (C=A+B)",$totalObservations,"");
        LibForms::insertResult($id,4,"Percentage Compliance (A/C)* 100",$perCompliance,"");
        $score['total_score'] = $perCompliance;
        Q4eAssign::where('id',$id)->update($score);
        $results = LibForms::getResults($id);
        $maxTotal=0;
        $achieved=0;
        $html = "<div class='text-h6 text-center'>% Compliance</div><table width='100%'><tbody>";
        foreach($results as $row){
            $html .= "<tr><td class='bg-grey-2 ellipsis' style='text-align:left'>".$row['label']."</td>";
            $html .= "<td style='text-align:right'>".$row['val']."</td>";
            $maxTotal = $maxTotal + intval($row['val']);
            $achieved = $achieved + intval($row['col2']);
        }
       
        
        $html .= "</tbody></table>";
        return $html;
    }
    public static function insertResult($id,$linenum,$label,$val,$col2){
        $l = new Q4eResults;
        $l->assign_id=$id;
        $l->linenum=$linenum;
        $l->label = $label;
        $l->val = $val;
        $l->col2 = $col2;
        $l->save();
    }
    public static function getResults($id)
    {
        $r = Q4eResults::where('assign_id',$id)->orderBy('linenum')->get();
        $results = array();
        foreach($r as $row){
            $a['linenum'] = $row->linenum;
            $a['label'] = $row->label;
            $a['val'] = $row->val;
            $a['col2'] = $row->col2;
            array_push($results,$a);
        }
        return $results;
    }
    public static function sumSections($id,$formid)
    {
        $lstSections = Q4eSections::where('form_id',$formid)->orderBy('ord')->get();
        Q4eResults::where('assign_id',$id)->delete();
        $linenum=1;
        foreach($lstSections as $row)
        {
            $results = Q4eAnswers::join('q4e_items','q4e_items.id','q4e_answers.field_id')
                           ->where('q4e_answers.assign_id',$id)
                           ->where('q4e_items.incalc','=',0)
                           ->where('q4e_items.section_id',$row->id)
                           ->sum('q4e_answers.answer');
            $col2 = Q4eItems::where('incalc','=',0)
                           ->where('section_id',$row->id)
                           ->sum('max_val');

            LibForms::insertResult($id,$linenum,$row->name,$col2,$results);
            $linenum++;
        }
        $results = LibForms::getResults($id);
        $maxTotal=0;
        $achieved=0;
        $html = "<table width='100%'>";
        $html .= "<thead><tr><th style='text-align:left'>Overall</th><th style='text-align:right'>Max</th><th style='text-align:right'>Achieved</th></tr></thead><tbody>";
        foreach($results as $row){
            $html .= "<tr><td style='text-align:left'>".$row['label']."</td>";
            $html .= "<td style='text-align:right'>".$row['val']."</td>";
            $html .= "<td style='text-align:right'>".$row['col2']."</td></tr>";
            $maxTotal = $maxTotal + intval($row['val']);
            $achieved = $achieved + intval($row['col2']);
        }
        $html .= "<tr><td style='text-align:left'><strong>Grand Total</strong></td>";
        $html .= "<td style='text-align:right'>".$maxTotal."</td>";
        $html .= "<td style='text-align:right'>".$achieved."</td>";
        $html .= "</tr>";
        $per = 0;
        if($achieved > 0){
            $per = ($achieved/$maxTotal) * 100;
        }
        $per = round($per,2);
        $html .= "<tr><td style='text-align:left'><strong>Percentage</strong></td>";
        $html .= "<td style='text-align:right'>100</td>";
        $html .= "<td style='text-align:right'>".$per."</td>";
        $html .= "</tr>";
        $html .= "</tbody></table>";
        return $html;
    }
    public static function getPeriodsList($formid,$limit=0,$ord="")
    {
        $query = "SELECT distinct(date_format(completed_date,'%Y-%m')) as v FROM q4e_assign where form_id=".$formid." order by date_format(completed_date,'%Y-%m') desc";
        if($limit != 0) $query .= "  limit 0,".$limit;
        $results = DB::select($query);
        $lstPeriods = array();
        foreach($results as $row){
          $lstPeriods[] = array("id"=>$row->v,"name"=>date('F Y',strtotime($row->v."-01")));
        }
        if($ord=="Y") $lstPeriods = array_reverse($lstPeriods);
        return $lstPeriods;
    }
    public static function getApplicableBU($formID)
    {
        $results = Q4eFormsProps::join('locations','locations.id','q4e_forms_props.val')
                    ->where('q4e_forms_props.form_id',$formID)
                    ->where('q4e_forms_props.prop','BU')
                    ->select('q4e_forms_props.val','locations.name')
                    ->orderBy('locations.name')
                    ->get();
        return $results;
    }
    public static function addProperties($id,Request $request)
    {
        Q4eFormsProps::where('form_id',$id)->where('prop','!=','BU')->delete();
        $fields = Q4eFormsProps::getListOfProps();
        foreach($fields as $row){
            $varname = "prop_".$row->prop;
            if(isset($request->$varname))
            {
                $val = $request->$varname;
                if($val != ""){
                    Q4eFormsProps::addProperty($id,$row->prop,$val);
                }
            }
        }
    }
    public static function getPeriodStatus($formID,$aDate)
    {
        $status=0;
        $mmYYYY = date('Y-m',strtotime($aDate));
        $cnt = Q4ePeriods::where('form_id',$formID)->where('per',$mmYYYY)->count();
        if($cnt > 0){
            $rs = Q4ePeriods::where('form_id',$formID)->where('per',$mmYYYY)->select('status')->first();
            $status = $rs->status;
        }
        return $status;
    }
    public static function autoClose()
    {
        $rs = ToClose::where('d','>',0)->get();
        foreach($rs as $row)
        {
            $data = array();
            $data['status'] = 20;
            $data['forced_closed'] = 1;
            $data['completed_date'] = Carbon::now();
            #echo "Closing form ".$row->form_id." and assign ".$row->id;
            Q4eAssign::where('id',$row->id)->where('form_id',$row->form_id)->update($data);
        }
        $rsPer = ToClose::where('d','>',0)->select('form_id','per')->distinct('per')->get();
        foreach($rsPer as $row){
            $data = array();
            $data['status'] = 20;
            $data['closed_date'] = Carbon::now();
            Q4ePeriods::where('per',$row->per)->where('form_id',$row->form_id)->update($data);
            #echo "Closign Perfor for ".$row->per."  form ".$row->form_id."<br>";
        }
        // $rsPeriods = Q4ePeriods::where('status','=',0)->get();
        // foreach($rsPeriods as $row){
        //     $cnt = Q4eAssign::where('status',[20])->where('form_id',$row->form_id)->where('per',$row->per)->count();
        //     echo $row->per."----".$row->form_id."------".$cnt."\n";
        // }
    }
}
?>

