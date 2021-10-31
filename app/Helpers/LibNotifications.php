<?php  
namespace App\Helpers;
use Config;
use DateTime;
use App\Model\DbModels\Attachments;
use Illuminate\Http\Request;
use App\Model\DbModels\NotificationTemplate;
use App\Model\DbModels\UserNotifications;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Model\DbModels\Tasks;
use App\Model\DbModels\Q4eAssign;
use App\Model\DbModels\Messages;
use App\Model\DbModels\TrainingUsers;
use App\Model\DbModels\Training;
use App\Model\DbModels\TrainingList;
use App\Model\DbModels\IncHOD;
use App\Model\DbModels\PendingAssign;
use App\Model\DbModels\Users;
use App\Model\DbModels\Blogs;
use App\Model\DbModels\Incidents;
use DB;
class LibNotifications
{
	public static function generateNotification()
	{
		LibNotifications::upcomingTrainings();
        LibNotifications::incidentsHOD();
        LibNotifications::upcomingSurvey();
	}
	public static function upcomingSurvey()
	{
		LibNotifications::generateSurveyNotifications(1,"SURVEY_1_BEF");
		LibNotifications::generateSurveyNotifications(-1,"SURVEY_1_AFTER");
		LibNotifications::generateSurveyNotifications(-3,"SURVEY_3_AFTER");
		LibNotifications::generateSurveyNotifications(-7,"SURVEY_7_AFTER");
	}
	public static function generateSurveyNotifications($d,$template)
	{
		$results = PendingAssign::where('pending','=',$d)->get();
		$rsMsg = Messages::where('code',$template)->first();
		foreach($results as $row){
			$route="";
			if($row->code=="BIANNUAL") $route = "/biannual/form/".$row->id;
			if($row->code=="OUTCOME") $route = "/outcome/form/".$row->id;
			if($row->code=="INTERNAL-AUDIT") $route = "/internal-audit/form/".$row->id;
			if($row->code=="GC") $route = "/governance/form/".$row->id;
			if($row->code=="EMERGENCY") $route = "/emergency/form/".$row->id;
			$cnt = Messages::where('code',$template)->count();
			if($cnt > 0){
				$message = $rsMsg->message;
				$period = date('F Y',strtotime($row->assign_date));
				$message = str_replace("[SUBJECT]",$row->name,$message);
				$message = str_replace("[PERIOD]",$period,$message);
				$l = new UserNotifications;
				$l->userid = $row->userid;
				$l->priority = "High";
				$l->typ = "NOTIFICATION";
				$l->message = $message;
				$l->status = 0;
				$l->parent_id = $row->id;
				$l->parent_typ = "NOTIFICATION";  
				$l->action = $route;
				$l->icon = "";
				$l->subject = $rsMsg->caption;
				$l->template = $template;
				$l->save();
			}
		}
	}
	public static function incidentsHOD()
	{
		LibNotifications::generateIncHOD(-3,"HOD_3_BEF");
		LibNotifications::generateIncHOD(1,"HOD_1_BEF");
		LibNotifications::generateIncHOD(1,"HOD_1_AFTER");
		LibNotifications::generateIncHOD(3,"HOD_3_AFTER");
		LibNotifications::generateIncHOD(7,"HOD_7_AFTER");
	}
	public static function generateIncHOD($d,$template)
	{
		$results = IncHOD::where('d',$d)->get();
		foreach($results as $row){
			$userid = $row->assign_to;
			$id = $row->parent_id;
			$cnt = UserNotifications::where('template',$template)->where('userid',$userid)->where('parent_id',$id)->count();
			if($cnt == 0){
        		$options = array("id"=>$id);
        		LibNotifications::create(array("userid"=>$userid,"typ"=>"NOTIFICATION","template"=>$template,"id"=>$id,"options"=>$options));
			}
		}
	}
	public static function upcomingTrainings()
	{
		LibNotifications::generateTrainingNotifications(3,"TRAINING_3DAYS");
		LibNotifications::generateTrainingNotifications(1,"TRAINING_1DAY");
	}
	public static function generateTrainingNotifications($d,$template)
	{
		$results = TrainingList::where('daysfor','>=',$d)->get();
		foreach($results as $row){
			$userid = $row->user_id;
			$id = $row->id;
			$cnt = UserNotifications::where('template',$template)->where('userid',$userid)->where('parent_id',$id)->count();
			if($cnt == 0){
        		$options = array("id"=>$id,"subject"=>$row->subject,"tdate"=>date('d/m/Y',strtotime($row->training_date)));
        		LibNotifications::create(array("userid"=>$userid,"typ"=>"NOTIFICATION","template"=>$template,"id"=>$id,"options"=>$options));
			}
		}
	}
	public static function trainingNotifications($id)
	{
		$rsTraining = Training::where('id',$id)->first();
		$lstUsers = TrainingUsers::where('training_id',$id)->get();
		foreach($lstUsers as $row){
			$cnt = LibNotifications::getCount($id,$row->user_id,"TRAINING_NOTIFICATION");
			if($cnt == 0){
				$params = array();
				$params['template'] = "TRAINING_NOTIFICATION";
				$params['id'] = $id;
				$params['options'] = array("NAME"=>$rsTraining->subject,"ID"=>$id);
				$params['typ'] = "TRAINING";
				$params['userid'] = $row->user_id;
				LibNotifications::create($params);	
			}
		}
	}
	public static function getCount($id,$userid,$template)
	{
		$cnt = UserNotifications::where('parent_id',$id)->where('userid',$userid)->where('template',$template)->count();
		return $cnt;
	}
	public static function createFormNotification($params)
	{
		if(isset($params['senddate'])) {
			$sendDate = $params['senddate'];
		} else {
			$sendDate =  $d = date('Y-m-d');
		}
		$n = new UserNotifications;
		$n->userid = $params['userid'];
		$n->priority = "High";
		$n->typ = "NOTIFICATION";
		$n->action = $params['action'];
		$n->message = $params['message'];
		$n->status = 0;
		$n->parent_id = $params['id'];
		$n->parent_typ = $params['typ'];
		$n->icon = $params['icon'];
		$n->subject = $params['subject'];
		$n->priority = "High";
		$n->senddate = $sendDate;
		$n->mflag=0;
		$n->isvalid=1;
		$n->save();
		LibNotifications::pushNotifications($params['userid'],$params['subject'],$params['message']);
	}
	public static function createForAllUsers($params)
	{
		$rsUsers = Users::where('status','=',0)->get();
		if(isset($params['senddate'])) {
			$sendDate = $params['senddate'];
		} else {
			$sendDate =  $d = date('Y-m-d');
		}
		foreach($rsUsers as $row){
			$msg = Messages::getMessageForNotification($params['template'],$params['id'], $params['options']);
			$n = new UserNotifications;
			$n->userid = $row->id;
			$n->priority = $msg['priority'];
			$n->typ = $msg['typ'];
			$n->action = $msg['route'];
			$n->message = $msg['message'];
			$n->status = 0;
			$n->parent_id = $params['id'];
			$n->parent_typ = $params['typ'];
			$n->subject=$msg['subject'];
			$n->priority = "High";
			$n->template = $params['template'];
			$n->senddate = $sendDate;
			$n->mflag=0;
			$n->isvalid=1;
			$n->save();
			LibNotifications::pushNotifications($row->id,$msg['subject'],$msg['message']);
		}

	}
	//$params['template'] $Params['options'], $params['userid'],$params['id']=PARENTID,$params['typ']
	public static function create($params)
	{
		$cnt = UserNotifications::where('userid',$params['userid'])->where('template',$params['template'])->where('parent_id',$params['id'])->count();
		if(isset($params['senddate'])) {
			$sendDate = $params['senddate'];
		} else {
			$sendDate =  $d = Carbon::now();
		}
		if($cnt == 0){
			$msg = Messages::getMessageForNotification($params['template'],$params['id'], $params['options']);
			$n = new UserNotifications;
			$n->userid = $params['userid'];
			$n->priority = $msg['priority'];
			$n->typ = $msg['typ'];
			$n->action = $msg['route'];
			$n->message = $msg['message'];
			$n->status = 0;
			$n->parent_id = $params['id'];
			$n->parent_typ = $params['typ'];
			$n->subject=$msg['subject'];
			$n->priority = "High";
			$n->template = $params['template'];
			$n->senddate = $sendDate;
			$n->mflag=0;
			$n->isvalid=1;
			$n->save();
			LibNotifications::pushNotifications($params['userid'],$msg['subject'],$msg['message']);
		}
	}
	public static function delete($id,$typ)
	{
		UserNotifications::where('parent_id',$id)->where('parent_typ',$typ)->delete();
	}
	public static function getTotalNotifications($userid)
	{
		$cnt = UserNotifications::where('userid',$userid)->where('status','=',0)->count();
		return $cnt;
	}
	public static function getNotifications($userid,$typ)
	{
		$date = today()->format('Y-m-d');
		if($typ=="TOP"){
			$results = UserNotifications::where('userid',$userid)
				->where('isvalid','=',1)
				->where('senddate','<=',Carbon::now())
				->orderBy('senddate','desc')
				->limit(5)->get();
		}
		else{
			$results = UserNotifications::where('userid',$userid)
				->where('isvalid','=',1)
				->where('senddate','<=',Carbon::now())
				->orderBy('senddate','desc')
				->get();
		}
		//return $results;
		$output=array();
		foreach($results as $row)
		{
			$a = $row;
			$a['fCreateDate'] = date('d/m/Y H:i',strtotime($row->senddate));
			$a['d'] = LibNotifications::notificationTime($row->senddate);
			
			if($row->icon == ""){
				$a['icon'] = LibNotifications::getIcon($row->parent_typ);
			}
			else {
				$a['icon'] = $row->icon.".png";
			}
			$a['url'] = $row->action;//LibNotifications::getURL($row);
			$a['subject'] = $row->subject;
			$isValid = LibNotifications::isNotificationValid($row);
			$isValid=1;
			if($isValid == 1) {
				array_push($output,$a);
			}
			else {
				$data = array();
				$data['isvalid'] = 0;
				UserNotifications::where('id',$row->id)->update($data);

			}
		}
		return $output;
	}
	public static function isNotificationValid($row)
	{
		$typ = $row->parent_typ;
		$valid=0;
		switch(strtoupper($typ)):
			case 'INTERNAL-AUDIT':
				$valid = LibNotifications::checkSurvey($row);
				break;
			case 'OUTCOME':
				$valid = LibNotifications::checkSurvey($row);
				break;
			case 'GC':
				$valid = LibNotifications::checkSurvey($row);
				break;
			case 'EMERGENCY':
				$valid = LibNotifications::checkSurvey($row);
				break;
			case 'BIANNUAL':
				$valid = LibNotifications::checkSurvey($row);
				break;
			case 'CHECKLIST':
				$valid = LibNotifications::checkSurvey($row);
				break;
			case "TRAINING":
				$valid = LibNotifications::checkTraining($row);
				break;
			case "INCIDENT":
				$valid = LibNotifications::checkIncident($row);
				break;
			case "LEARNING":
				$valid = LibNotifications::checkLearning($row);
				break;
			default:
				$valid = 1;
			break;
		endswitch;
		return $valid;
	}
	public static function checkSurvey($row)
	{
		$isValid=0;
		$cnt = Q4eAssign::where('id',$row->parent_id)->where('userid',$row->userid)->count();
		if($cnt > 0) $isValid=1;
		return $isValid;
	}
	public static function checkTraining($row)
	{
		$isValid=0;
		$cnt = Training::where('id',$row->parent_id)->where('publish','=',1)->count();
		if($cnt > 0) $isValid=1;
	}
	public static function checkIncident($row)
	{
		$isValid=0;
		$cnt = Incidents::where('id',$row->parent_id)->count();
		if($cnt > 0) $isValid=1;
	}
	public static function checkLearning($row)
	{
		$isValid=0;
		$cnt = Blogs::where('id',$row->parent_id)->where('publish','=',1)->count();
		if($cnt > 0) $isValid=1;
	}
	public static function getURL($row)
	{
		$url="";
		if($row->parent_typ=="INCIDENT"){
			$url = "/incident/view/".$row->parent_id;
		}
		return $url;
	}
	public static function getIcon($typ){
		$out="";
		$icons = array("INCIDENT"=>"incident.png","Q4E"=>"o_ballot","FAQ"=>"o_question_answer",
						"DOCUMENT"=>"o_folder_shared","EVENTS"=>"o_event","GALLERY"=>"o_collections",
						"NEWSLETTER"=>"o_description","KNOWLEDGE_BASE"=>"o_speaker_notes","TASKS"=>"o_assignment_turned_in",
						"TRAINING"=>"o_menu_book","CONTACTS"=>"o_contacts","FEEDBACK"=>"o_feedback");
		foreach($icons as $ky=>$val){
			if($ky == $typ) $out=$val;
		}
		return $out;
	}
	public static function notificationTime($created_at)
	{
		$start_date = new DateTime($created_at);
		$since_start = $start_date->diff(Carbon::now());

		// $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', Carbon::now());
		// $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', strtotime($created_at));
		// $diff_in_days = $to->diffInDays($from);
		// print_r($diff_in_days); // Output: 1
		$data['start_days_total'] = $since_start->days;
		$data['start_years'] = $since_start->y;
		$data['start_months'] = $since_start->m;
		$data['start_days'] = $since_start->d;
		$data['start_hours'] = $since_start->h;
		$data['start_min'] = $since_start->i;
		$out="";
		if($since_start->y == 0 && $since_start->m == 0 && $since_start->d == 0 && $since_start->h == 0){
			$out = $since_start->i." Minutes";
		}
		else if($since_start->y == 0 && $since_start->m == 0 && $since_start->d == 0){
			$out = $since_start->h." Hours";
		}
		else if($since_start->y == 0 && $since_start->m == 0){
			$out = $since_start->d." Days";
		}
		else{
			$out = $since_start->days. " days";
		}
		$out .= " ago";
		//$out = $since_start->y." ".$since_start->m." ".$since_start->d." ".$since_start->h;
		return $out;
	}
	public static function generateNotificationsForQ4E()
	{
		$results = Q4eAssign::join('q4e_forms','q4e_forms.id','q4e_assign.form_id')
					->where('q4e_assign.assign_date','<=',Carbon::now())
					->select('q4e_forms.name','q4e_forms.days_submit','q4e_forms.assign_msg','q4e_forms.owner','q4e_assign.*')
					->get();
		foreach($results as $row){
			$cnt = Tasks::where('parent_id',$row->id)->where('typ','Q4E')->count();
			if($cnt == 0){
				$endDate = date('Y-m-d',strtotime($row->assign_date. ' + '.$row->days_submit.' days'));
				$l = new Tasks;
				$l->assign_to = $row->userid;
				$l->parent_id = $row->id;
				$l->typ = "Q4E";
				$l->track_id=0;
				$l->assign_date = $row->assign_date;
				$l->exp_closing_date = $endDate;
				$l->status=0;
				$l->assigned_by = $row->owner;
				$l->save(); 
			}
			$cnt = UserNotifications::where('parent_id',$row->id)->where('parent_typ','Q4E')->where('userid',$row->userid)->count();
			if($cnt==0)
			{
				$l = new UserNotifications;
				$l->userid = $row->userid;
				$l->priority = 'High';
				$l->typ = 'TASK';
				$l->message = $row->assign_msg;
				$l->status = 0;
				$l->parent_id = $row->id;
				$l->parent_typ = 'Q4E';
				$l->save();
				$title=$row->form_name;
				LibNotifications::pushNotifications($row->userid,$title,$row->assign_msg);
			}
		}
	}
	public static function pushNotifications($userid,$title,$message)
	{
		$cnt = Users::where('id',$userid)->count();
		$serverKey = env("FCM_KEY");
		$fcmURL = env("FCM_URL");
		if($cnt > 0){
			$rs = Users::where('id',$userid)->first();
			$ntoken = $rs->ntoken;
			if($ntoken != ""){
				$fcmToken = $ntoken;
				$id = null;
				$header = [
					'authorization: key=' . $serverKey,
						'content-type: application/json'
					]; 
				$postdata = '{
						"to" : "' . $fcmToken . '",
							"notification" : {
								"title":"' . $title . '",
								"text" : "' . $message . '"
							},
						"data" : {
							"id" : "'.$id.'",
							"title":"' . $title . '",
							"description" : "' . $message . '",
							"text" : "' . $message . '",
							"is_read": 0
							}
					}';
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL,$fcmURL);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 180);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
				curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
				$result = curl_exec($ch);    
				curl_close($ch);
			}
		}
        
	}
}
?>
