<?php
    namespace App\Model\DbModels;
    use Illuminate\Database\Eloquent\Model; 
    use App\Model\DbModels\Locations;
    class UsersAct extends Model
    {
        public $table = "users_act";
        public $timestamps = true;
        protected $fillable = [
           'module','parent_id','user_id'
        ];

        public static function getUsers($module,$parent)
        {
        	$results = UsersAct::join('users','users.id','users_act.user_id')
        			->where('module',$module)
        			->where('parent_id',$parent)
        			->select('users.id','users.name','users.location','users.emp_code')
        			->get();
        	$lstUsers = array();
        	foreach($results as $row){
        		$a['id'] = $row->id;
        		$a['name'] = $row->name;
        		$a['location'] = Locations::getName($row->location);
        		$a['empcode'] = $row->emp_code;
        		array_push($lstUsers,$a);
        	}
        	return $lstUsers;
        }
 		public static function addUser($module,$parent,$user)
 		{
 			$cnt = UsersAct::where('module',$module)->where('parent_id',$parent)->where('user_id',$user)->count();
 			if($cnt == 0){
 				$l = new UsersAct;
 				$l->module = $module;
 				$l->parent_id = $parent;
 				$l->user_id = $user;
 				$l->save();
 			}
 		}
 		public static function removeUser($module,$parent,$user)
 		{
 			$cnt = UsersAct::where('module',$module)->where('parent_id',$parent)->where('user_id',$user)->count();
 			if($cnt > 0){
 				UsersAct::where('module',$module)->where('parent_id',$parent)->where('user_id',$user)->delete();
 			}
 		}
        public static function deleteUsers($module,$parent)
        {
            UsersAct::where('module',$module)->where('parent_id',$parent)->delete();
        }
}