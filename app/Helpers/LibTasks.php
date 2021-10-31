<?php // Code within app\Helpers\Helper.php
namespace App\Helpers;
use Config;
use App\Model\DbModels\Attachments;
use Illuminate\Http\Request;
use App\Model\DbModels\Tasks;
use App\Model\DbModels\TasksComments;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Model\DbModels\Users;
class LibTasks
{
	public static function deleteTask($id,$typ)
	{
		Tasks::where('parent_id',$id)->where('typ',$typ)->delete();
	}
	public static function addTask($data)
	{
		$t = new Tasks;
		$t->assign_to = $data['assign_to'];
		$t->parent_id = $data['parent_id'];
		$t->typ = $data['typ'];
		$t->track_id = 0;//$data['track_id'];
		$t->assign_date = Carbon::now();
		$t->exp_closing_date = $data['exp_closing_date'];
		$t->assigned_by = Auth::guard('admin')->user()->id;
		$t->status = 0;
		$t->assigned_notes = $data['comments'];
		$t->header = $data['header'];
		$t->route = "";
		//LibTasks::getRoute($data['parent_id'],$data['typ']);
		$t->save();
		$id = $t->id;
		$p['route'] = LibTasks::getRoute($data['parent_id'],$data['typ'],$id);
		Tasks::where('id',$id)->update($p);
		if($data['comments'] != ""){
			LibTasks::addTaskComments($id,$data['comments']);
		}
		return $id;
	}
	public static function getRoute($id,$typ,$pid)
	{
		$route="";
		if($typ == "INCIDENT"){
			$route="incident/viewassign/".$id."/".$pid;
		}
		if($typ == "LEARNING") {
			$route="/knowledge-base/approve/".$id."/".$pid;
		}
		return $route;
	}
	public static function addTaskComments($id,$comments)
	{
		$c = new TasksComments;
		$c->task_id = $id;
		$c->userid = Auth::guard('admin')->user()->id;
		$c->comments = $comments;
		$c->save();
	}
	public static function getTasks($id,$typ)
	{
		$results = Tasks::join('users','users.id','tasks.assign_to')
					->where('parent_id',$id)->where('typ',$typ)
					->select('users.name as username','tasks.*')
					->orderBy('assign_date')->get();
		$output = array();
		foreach($results as $row)
		{
			$a['id'] = $row->id;
			$a['assign_to'] = $row->assign_to;
			$a['assigned_to_name'] = $row->username;
			$a['assigned_by'] = $row->assigned_by;
			$a['assigned_by_name'] = Users::getName($a['assigned_by']);
			$a['parent_id'] = $row->parent_id;
			$a['track_id'] = $row->track_id;
			$a['assign_date'] = $row->assign_date;
			$a['fAssignDate'] = date('d/m/Y H:i',strtotime($a['assign_date']));
			$a['closed_date'] = $row->closed_date;
			$a['fClosedDate'] = "";
			$a['status'] = $row->status;
			if($row->status == 0) $a['statusname'] = "New";
			if($row->status == 10) $a['statusname'] = "Waiting for Clarification";
			if($row->status == 10) $a['statusname'] = "Completed";
			if($row->status == 10)
			{
				$a['fClosedDate'] = date('d/m/Y H:i',strtotime($a['closed_date']));
			}
			$a['exp_closing_date'] = $row->assign_date;
			$a['fExpCloseDate'] = date('d/m/Y',strtotime($a['exp_closing_date']));
			$a['created_at'] = $row->created_at;
			$a['updated_at'] = $row->updated_at;

			$badge="";
        	$message="";
        	if($row->status == 0) 
        	{
            	$badge = "success";
            	$message = "Assigned to ".$a['assigned_to_name']." by ".$a['assigned_by_name']." on ".$a['fAssignDate'].". Expected Closing on ".$a['fExpCloseDate'];
        	}
	        if($row->status == 10) 
	        {
	            $badge = "warning";
	            $message = "Waiting for clarification. Assigned to ".$a['assigned_to_name']." by ".$a['assigned_by_name']." on ".$a['fAssignDate'].". Expected Closing on ".$a['fExpCloseDate'];
	        }
	        if($row->status == 10) 
	        {
	            $badge = "danger";
	            $message = "Assigned to ".$a['assigned_to_name']." by ".$a['assigned_by_name']." on ".$a['fAssignDate'].". Closed on ".$a['fClosedDate'];
	        }
	        $a['badge'] = $badge;
	        $a['message'] = $message;

			array_push($output,$a);
		}
		return $output;
	}
	public static function getIncidentAssignmentStatus($id)
	{
		$cnt = Tasks::join('users','users.id','tasks.assign_to')
					->where('parent_id',$id)->where('typ','INCIDENT')
					->count();
		if($cnt > 0) {
			$inProgress = Tasks::join('users','users.id','tasks.assign_to')
						->where('parent_id',$id)->where('typ','INCIDENT')
						->where('tasks.status','=',0)
						->count();
			$completed = Tasks::join('users','users.id','tasks.assign_to')
					->where('parent_id',$id)->where('typ','INCIDENT')
					->where('tasks.status','=',10)
					->count();
			$out = "In Progress";
			if($completed == $cnt) $out = "Completed";
		} else {
			$out = "No HOD Assignments";
		}
		return $out;
	}
	public static function getIncidentAssignmentStatusVal($id)
	{
		$cnt = Tasks::join('users','users.id','tasks.assign_to')
					->where('parent_id',$id)->where('typ','INCIDENT')
					->count();
		if($cnt > 0) {
			$inProgress = Tasks::join('users','users.id','tasks.assign_to')
						->where('parent_id',$id)->where('typ','INCIDENT')
						->where('tasks.status','=',0)
						->count();
			$completed = Tasks::join('users','users.id','tasks.assign_to')
					->where('parent_id',$id)->where('typ','INCIDENT')
					->where('tasks.status','=',10)
					->count();
			$out = "INPROGRESS";
			if($completed == $cnt) $out = "COMPLETED";
		} else {
			$out = "NONE";
		}
		return $out;
	}
	public static function getBlogsForApproval($id)
	{
		$results = Tasks::join('users','users.id','tasks.assign_to')
						->where('parent_id',$id)->where('typ','LEARNING')
						->select('users.name as username','tasks.*')
						->get();
		$lstTasks = array();
		foreach($results as $row){
			$a['id'] = $row->id;
  			$a['assign_to'] = $row->assign_to;
  			$a['assignName'] = $row->username;
  			$a['parent_id'] = $row->parent_id;
  			$a['assign_date'] = date('d/m/Y',strtotime($row->assign_date));
  			$a['closed_date'] = "";
  			$a['exp_closing_date'] = date('d/m/Y',strtotime($row->exp_closing_date));
  			$a['status'] = $row->status;
  			$a['statusName'] = LibTasks::getBlogStatusName($row->action);
  			$a['qa_comments'] = $row->assigned_notes;
  			$a['approved_date'] = "";
  			$a['approved_by'] = "";
  			$a['assigned_notes'] = $row->assigned_notes;
  			$a['header'] = $row->header;
  			$a['user_comments'] = "";
  			if($a['status'] == 20){
  				$a['closed_date'] = date('d/m/Y',strtotime($row->closed_date));
  				$a['user_comments'] = $row->user_comments;
  				$a['approved_date'] = date('d/m/Y',strtotime($row->approved_date));
  				$a['approved_by'] = Users::getName($row->approved_by);
  			}
  			$a['assigned_by'] = Users::getName($row->assigned_by);
  			array_push($lstTasks,$a);
		}
		return $lstTasks;
	}
	public static function getOneTask($id,$typ)
	{
		$cnt = Tasks::where('id',$id)->where('typ',$typ)->count();
		if($cnt > 0)
		{
			$output['status'] = "success";
			$results = Tasks::join('users','users.id','tasks.assign_to')
					->where('tasks.id',$id)
					->where('tasks.typ',$typ)
					->select('users.name as username','tasks.*')
					->first();
			$results['assigned_by_name'] = Users::getName($results->assigned_by);
			$results['fAssignDate'] = date('d/m/Y H:i',strtotime($results->assign_date));
			if($results->status == 0) $results['statusname'] = "New";
			if($results->status == 10) $results['statusname'] = "Waiting for Clarification";
			if($results->status == 10) $results['statusname'] = "Completed";
			$results['fClosedDate'] = "";
			if($results->status == 10)
			{
				$results['fClosedDate'] = date('d/m/Y H:i',strtotime($results->closed_date));
			}
			$results['fExpCloseDate'] = date('d/m/Y',strtotime($results->exp_closing_date));
			$results['comments'] = TasksComments::join('users','users.id','tasks_comments.userid')
										->select('users.name as username','tasks_comments.*')
										->where('task_id',$id)
										->orderBy('created_at','desc')
										->get();
			$results['user_comments'] = $results->user_comments;	
			$results['assigned_notes'] = $results->assigned_notes;						
			$output['results'] = $results;
		}
		else{
			$output['status']= "fail";
			$output['results'] = array();
		}
		return $output;
	}
	public static function getBlogStatusName($status)
	{
		$output="";
		if($status==0) $output="Pending";
		if($status==10) $output="Accepted";
		if($status==20) $output="Rejected";
		return $output;
	}
	public static function getStatusName($status)
	{
		$output="";
		if($status==0) $output="New";
		if($status==10) $output="In Progress";
		if($status==20) $output="Completed";
		return $output;
	}
	public static function updateTask($params)
	{
		$cnt = Tasks::where('track_id',$params['track_id'])
				->where('assign_to',$params['assign_to'])
				->where('typ',$params['typ'])
				->where('parent_id',$params['parent_id'])
				->count();
		if($cnt > 0)
		{
			$data['status'] = 20;
			$data['closed_date'] = Carbon::now();
			Tasks::where('track_id',$params['track_id'])
				->where('assign_to',$params['assign_to'])
				->where('typ',$params['typ'])
				->where('parent_id',$params['parent_id'])
				->update($data);
		}
	}
}
