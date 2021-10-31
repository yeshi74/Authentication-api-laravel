<?php // Code within app\Helpers\Helper.php
namespace App\Helpers;
use Config;
use App\Model\DbModels\Attachments;
use Illuminate\Http\Request;
use App\Model\DbModels\Locations;
use App\Model\DbModels\Roles;
use App\Model\DbModels\LocationPermissions;
use App\Model\DbModels\RolePerms;
use App\Model\DbModels\Users;
use App\Model\DbModels\UserLocations;
use DateTime;
class ApolloHelpers
{
	public static function formatDate($d)
    {
        $d1 = str_replace('/', '-', $d);
        $d2 = date("Y-m-d H:i",strtotime($d1));
        return $d2;
    }
    public static function formatDateOnly($d)
    {
        $ar2 = explode("/",$d);
        $mm = intval($ar2[1]);
        if($mm <= 10) $ar2[1] = "0".$ar2[1];
        $dd = intval($ar2[0]);
        if($dd <= 10) $ar2[0] = "0".$ar2[0];
        return $ar2[2]."-".$ar2[1]."-".$ar2[0];
    }
	public static function getCardColor($color)
	{
		$a = "text-black bg-secondary";
		if($color != "") {
			$a = "text-white bg-".$color; 
		}
		return $a;
	}
	public static function getColor($ctr)
	{
		$colors = array("","red-5","purple-6","indigo-9","blue-4",
						"teal-6","red-13","green-6","orange","light-green-10",
						"deep-orange","red-14","cyan-14","orange-14","light-blue-5",
						"amber-14","red-5","blue-grey","pink-12","green",
						"yellow-13","red-5","orange-12","cyan-5","teal-13",
						"brown","red-5","teal-14","grey-5","brown-3"
			);
		$max = count($colors);
		if($ctr > $max) $ctr = rand(1,$max);
		return $colors[$ctr];
	}
	public static function locationTree($params)
	{
		$lstLocations = Locations::orderBy('name')->get();
		$lstRoles = Roles::orderBy('name')->get();
		//$selLocations = array();
		$selRoles=array();
		if(!isset($params['mode'])) $params['mode'] =  "VIEW";
		if(!isset($params['selRoles']))   $params['selRoles'] = $selRoles;

		$view = view('widgets.locations_tree',compact('lstLocations','params','lstRoles'))->render();
		return $view;
	}
	public static function addPermissions($module,$parent_id,$request)
 	{
 		$locations = $request->input('locations');
		if($locations)
		{
	 		$loc = implode(',', $locations);
	 		$loc = explode(",",$loc);
	 		foreach($loc as $r)
	 		{
	 			$l = new LocationPermissions;
	 			$l->module = $module;
	 			$l->parent_id = $parent_id;
	 			$l->location_id = $r;
	 			$l->save();
			}
		}
		$roles = $request->input('roles');
		if($roles)
		{
			$role = implode(',', $roles);
	 		$role = explode(",",$role);
			foreach($role as $r)
			{
				$l = new RolePerms;
				$l->module = $module;
				$l->parent_id = $parent_id;
				$l->role_id = $r;
				$l->save();
			}
		}
 	}
 	public static function updatePermissions($module,$parent_id,$request)
 	{
		LocationPermissions::where('module',$module)->where('parent_id',$parent_id)->delete();
		$locations = $request->input('locations'); 
		if($locations)
		{
 			$loc = implode(',', $locations);
            $loc = explode(",",$loc);
	 		foreach($loc as $r)
	 		{
	 			$l = new LocationPermissions;
	 			$l->module = $module;
	 			$l->parent_id = $parent_id;
	 			$l->location_id = $r;
	 			$l->save();
			}
		}

		RolePerms::where('module',$module)->where('parent_id',$parent_id)->delete();
		$role = $request->input('roles');
		if($role)
		{
			$loc = implode(',', $role);
			$loc = explode(",",$loc);
			foreach($loc as $r)
			{
				$l = new RolePerms;
				$l->module = $module;
				$l->parent_id = $parent_id;
				$l->role_id = $r;
				$l->save();
			}
		}
 	}
 	public static function deletePermissions($module,$parent_id)
	{
		LocationPermissions::where('module',$module)->where('parent_id',$parent_id)->delete();
		RolePerms::where('module',$module)->where('parent_id',$parent_id)->delete();
	}
	public static function getLocations($module,$parent_id)
 	{
 		$locations = LocationPermissions::where('module',$module)->where('parent_id',$parent_id)->select('location_id')->get();
        $lstLocations = array();
        foreach($locations as $loc)
        {
            $lstLocations[] = $loc->location_id;
        }
        return $lstLocations;
 	}
 	public static function getRoles($module,$parent_id)
	{
		$locations = RolePerms::where('module',$module)->where('parent_id',$parent_id)->select('role_id')->get();
		$lstRoles = array();
		foreach($locations as $loc)
		{
			$lstRoles[] = $loc->role_id;
		}
		return $lstRoles;
	}
	public static function getUsersForLocation($id,$module)
	{
		$locations = LocationPermissions::where('module',$module)->where('parent_id',$id)->select('location_id')->get();
		$lstUsers=array();
		foreach($locations as $loc){
			$users = UserLocations::where('location',$loc->location_id)->get();
			foreach($users as $u){
				$b=0;
				foreach($lstUsers as $us){
					if($us == $u->id) $b=1;
				}
				if($b==0) $lstUsers[] = $u->id;
			}
		}
		return $lstUsers;
	}
	public static function getUsersForRole($id,$module)
	{
		$locations = RolePerms::where('module',$module)->where('parent_id',$id)->select('role_id')->get();
		$lstUsers=array();
		foreach($locations as $loc){
			$users = Users::where('role',$loc->role_id)->get();
			foreach($users as $u){
				$b=0;
				foreach($lstUsers as $us){
					if($us == $u->id) $b=1;
				}
				if($b==0) $lstUsers[] = $u->id;
			}
		}
		return $lstUsers;
	}

	public static function getUsersForTrans($id,$module)
	{
		$lstLoc = ApolloHelpers::getUsersForLocation($id,$module);
		$lstRole = ApolloHelpers::getUsersForRole($id,$module);
		$lstUsers = array();
		foreach($lstLoc as $loc)
		{
			$b=0;
			foreach($lstUsers as $u){
				if($u == $loc) $b=1;
			}
			if($b==0) $lstUsers[] = $loc;
		}
		foreach($lstRole as $loc)
		{
			$b=0;
			foreach($lstUsers as $u){
				if($u == $loc) $b=1;
			}
			if($b==0) $lstUsers[] = $loc;
		}
		return $lstUsers;
	}
	
	public static function __getUsersForQ4EAssignment($id)
	{
		$lstLocUsers = LocationPermissions::join('location_perms as b','b.location_id','location_perms.location_id')
					->where('location_perms.module','Q4E')
					->where('location_perms.parent_id',$id)
					->where('b.module','USERS')
					->select('b.parent_id')
					->groupBy('b.parent_id')
					->get();
		$lstRoleUsers = RolePerms::join('roles_perms as b','b.role_id','roles_perms.role_id')
					->where('roles_perms.module','Q4E')
					->where('roles_perms.parent_id',$id)
					->where('b.module','USERS')
					->select('b.parent_id')
					->groupBy('b.parent_id')
					->get();
		$lstUsers = array();
		foreach($lstLocUsers as $row)
		{
			$b=0;
			foreach($lstUsers as $u){
				if($u == $row->parent_id) $b=1;
			}
			if($b==0) $lstUsers[] = $row->parent_id;
		}
		foreach($lstRoleUsers as $row)
		{
			$b=0;
			foreach($lstUsers as $u){
				if($u == $row->parent_id) $b=1;
			}
			if($b==0) $lstUsers[] = $row->parent_id;
		}
		return $lstUsers;
	}
	public static function canExecute($id,$module,$userid)
	{
		$lstUsers = ApolloHelpers::getUsersForTrans($id,$module);
		$b=0;
		foreach($lstUsers as $r)
		{
			if($r == $userid) $b=1;
		}
		return $b;
	}
}
?>