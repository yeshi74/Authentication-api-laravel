<?php
	namespace App\Model\DbModels;
	use Illuminate\Database\Eloquent\Model;
	class RolePerms extends Model
	{
		public $table = "roles_perms";
		public $timestamps = true;
		protected $fillable = ['module','parent_id','role_id' ];
		 
		// public static function addRole($module,$parent_id,$role)
		// {
		// 	if($role){
		// 		$loc = implode(',', $role);
		// 		$loc = explode(",",$loc);
		// 		foreach($loc as $r)
		// 		{
		// 			$l = new RolePerms;
		// 			$l->module = $module;
		// 			$l->parent_id = $parent_id;
		// 			$l->role_id = $r;
		// 			$l->save();
		// 		}
		// 	}
		// }
		// public static function updateRoles($module,$parent_id,$role)
		// {
		// 	RolePerms::where('module',$module)->where('parent_id',$parent_id)->delete();
		// 	if($role){
		// 		$loc = implode(',', $role);
		// 		$loc = explode(",",$loc);
		// 		foreach($loc as $r)
		// 		{
		// 			$l = new RolePerms;
		// 			$l->module = $module;
		// 			$l->parent_id = $parent_id;
		// 			$l->role_id = $r;
		// 			$l->save();
		// 		}
		// 	}
		// }
		// public static function deleteRole($module,$parent_id)
		// {
		// 	RolePerms::where('module',$module)->where('parent_id',$parent_id)->delete();
		// }
		// public static function getRoles($module,$parent_id)
		// {
		// 	$locations = RolePerms::where('module',$module)->where('parent_id',$parent_id)->select('role_id')->get();
		// 	$lstRoles = array();
		// 	foreach($locations as $loc)
		// 	{
		// 		$lstRoles[] = $loc->role_id;
		// 	}
		// 	return $lstRoles;
		// }
	}
?>
