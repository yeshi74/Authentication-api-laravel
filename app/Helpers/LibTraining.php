<?php // Code within app\Helpers\Helper.php
namespace App\Helpers;
use Config;
use App\Helpers\ApolloHelpers;
use Illuminate\Http\Request;
use App\Model\DbModels\TrainingUsers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Model\DbModels\Users;
use App\Model\DbModels\LocationPermissions;
use App\Model\DbModels\RolePerms;
use App\Model\DbModels\UserLocations;
use App\Model\DbModels\UserRoles;
use App\Helpers\LibNotifications;
use App\Model\DbModels\Training;
class LibTraining
{
	public static function addOneUser($trainingID,$userid)
	{
		$rs = Training::where('id',$trainingID)->first();
		$cnt = TrainingUsers::where('training_id',$trainingID)->where('user_id',$userid)->count();
		if($cnt==0){
			$l = new TrainingUsers;
			$l->training_id = $trainingID;
			$l->user_id = $userid;
			$l->status=0;
			$l->before_survey=0;
			$l->after_survey=0;
			$l->before_points=0;
			$l->after_points=0;
			$l->save();
			LibTraining::notify($trainingID,$userid,$rs);
		}
	}
	public static function removeOneUser($trainingID,$userid)
	{
		$cnt = TrainingUsers::where('training_id',$trainingID)->where('user_id',$userid)->count();
		if($cnt > 0){
			 TrainingUsers::where('training_id',$trainingID)->where('user_id',$userid)->delete();
		}
	}
	public static function addUsers($trainingID,$request)
	{
		ApolloHelpers::addPermissions("TRAINING",$trainingID,$request);
		$lstLocations = LocationPermissions::where('module','TRAINING')->where('parent_id',$trainingID)->get();
		$lstRoles = RolePerms::where('module','TRAINING')->where('parent_id',$trainingID)->get();
		$rs = Training::where('id',$trainingID)->first();
		foreach($lstLocations as $rsLoc){
			$lstUsersForLoc = UserLocations::where('location',$rsLoc->location_id)->select('id')->get();
		

			foreach($lstUsersForLoc as $rsUsers){
				$lstUserRoles = UserRoles::where('userid',$rsUsers->id)->select('role')->get();
				$b=0;
				if(count($lstRoles) == 0){
					$b=1;
				}
				else {
					foreach($lstUserRoles as $rsRoles){
						foreach($lstRoles as $rsRoles1){
							if($rsRoles1->role_id == $rsRoles->role) $b=1;
						}
					}
				}
				if($b==1){
					$cnt = TrainingUsers::where('training_id',$trainingID)->where('user_id',$rsUsers->id)->count();
					if($cnt==0){
						$l = new TrainingUsers;
						$l->training_id = $trainingID;
						$l->user_id = $rsUsers->id;
						$l->status=0;
						$l->before_survey=0;
						$l->after_survey=0;
						$l->before_points=0;
						$l->after_points=0;
						$l->save();
						LibTraining::notify($trainingID,$rsUsers->id,$rs);
					}	
				}
			}
		}
	}

	public static function getUsers($trainingID)
	{
		$results = TrainingUsers::join('users','users.id','training_users.user_id')
						->where('training_users.training_id',$trainingID)
						->select('users.name as username','training_users.*')
						->get();
		$lstUsers = array();
		foreach($results as $row){
			$a = array();
			$a['id'] = $row->id;
			$a['user_id'] = $row->user_id;
			$a['userName'] = $row->username;
			$a['start_date'] = "";
			$a['complete_date']="";
			$a['last_attend']="";
			$a['before_survey'] = $row->before_survey;
			$a['before_points'] = $row->before_points;
			$a['after_survey'] = $row->after_survey;
			$a['after_points'] = $row->after_points;
			$a['status'] = $row->status;
			$a['statusName']="";
			if($row->status == 0){
				$a['statusName'] = "New";
			}
			if($row->status == 10)
			{
				$a['statusName'] = "In Progress";
				$a['start_date'] = date('d/m/Y',strtotime($row->start_date));
				$a['last_attend'] = date('d/m/Y',strtotime($row->last_attend));
			}
			if($row->status == 10)
			{
				$a['statusName'] = "In Progress";
				$a['start_date'] = date('d/m/Y',strtotime($row->start_date));
				$a['complete_date'] = date('d/m/Y',strtotime($row->complete_date));
				$a['last_attend'] = date('d/m/Y',strtotime($row->last_attend));
			}
			array_push($lstUsers,$a);
		}
		return $lstUsers;
	}
	public static function notify($id,$userid,$rsEvents)
    {
        $template = "TRAINING_NOTIFICATION";
        $options = array("id"=>$id,"name"=>$rsEvents->subject);
        LibNotifications::create(array("userid"=>$userid,"typ"=>"NOTIFICATION","template"=>$template,"id"=>$id,"options"=>$options));

    }
}
