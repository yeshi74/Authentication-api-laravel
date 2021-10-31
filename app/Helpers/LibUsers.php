<?php // Code within app\Helpers\Helper.php
namespace App\Helpers;
use Config;
use App\Model\DbModels\Attachments;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Model\DbModels\AttachmentSettings;
use App\Helpers\FileAttachments;
use App\Model\DbModels\Users;
use App\Helpers\LibFiles;
use App\Model\DbModels\Department;
use App\Model\DbModels\Locations;
use App\Model\DbModels\Menus;
use App\Model\DbModels\RolePerms;
use App\Model\DbModels\RoleOpts;
use App\Model\DbModels\Roles;
class LibUsers
{
    public static function canAdd($menu)
    {
        $bFlag=0;
        $user = Auth::user()->id;
        $cnt = Menus::where('code',$menu)->count();
        if($cnt > 0) {
            $id = Menus::where('code',$menu)->select('id')->first()->id;
            $defRole= Auth::user()->role;
            $cnt = RoleOpts::where('role_id','=',$defRole)->where('menuid',$id)->count();
            if($cnt > 0){
                $bFlag=1;
            }
            else{
                $lstRoles = RolePerms::where('module','USERS')->where('parent_id',$user)->select('role_id')->get();
                foreach($lstRoles as $row){
                    $cnt = RoleOpts::where('role_id','=',$row->role_id)->where('menuid',$id)->count();
                    if($cnt > 0) $bFlag=1;
                }
            }
        }
        return $bFlag;
    }
	public static function getProfile($userid)
	{
        $cnt = Users::where('id',$userid)->count();
        $a=array();
        $a['status'] = "fail";
        if($cnt > 0)
        {
            $row = Users::where('id',$userid)->first();
            $a['name'] = $row->name;
            $a['email'] = $row->email;
            $a['empCode'] = $row->emp_code;
            $a['profilepicture']= LibFiles::getProfilePicture($userid,$row->profile,$row->gender);
            $a['about'] = $row->about;
            //if($a['about'] == "" || $a['about']=="null") $a['about'] = "You can write a short bio of yourself, which will be visible for other users.";
            $a['mobile'] = $row->mobile;
            $a['gender'] = $row->gender;
            $a['dept'] =  Department::getDepartmentName($row->dept);
            $a['locname'] = Locations::getLocationName($row->location);
            $a['mgrname']="";
            if($row->mgr_id != 0){
            	$cnt = Users::where('id',$row->mgr_id)->count();
            	if($cnt > 0){
            		$a['mgrname'] = Users::where('id',$row->mgr_id)->select('name')->first()->name;
            	}
            }
            $a['status'] = "success";
        }
        return  $a;
	}
    public static function getPerms($user,$role)
    {
        $lstMenu=array();
        $lstFooter=array();
        $defaultMenus = Menus::where('parent','=',0)->where('typ','MENU')->where('status','=',0)->where('def','=',1)->select('id')->get();
        
        $lstMenuOpts = array();
        foreach($defaultMenus as $row){
            $lstMenuOpts[] = $row->id;
        }     
        $assignedMenus = Menus::join('role_opts','role_opts.menuid','menus.id')
                ->where('role_opts.role_id','=',$role)
                ->where('menus.status','=',0)
                ->where('menus.parent','=',0)
                ->where('menus.typ','MENU')
                ->select('menus.id')
                ->get();
        foreach($assignedMenus as $row){
            $b=0;
            foreach($lstMenuOpts as $l){
                if($l == $row->id) $b=1;
            }
            if($b==0){
                $lstMenuOpts[] = $row->id;
            }
        }
        $results = Menus::where('status','=',0)->where('parent','=',0)->where('typ','MENU')->whereIn('id',$lstMenuOpts)->orderBy('ord')->get();
        $ctr=1;
        foreach($results as $row)
        {
            $a['index'] = $ctr;
            $a['icon'] = "".$row->icon;
            $a['label'] = $row->name;
            $a['route'] = $row->route;
            $a['header'] = 0;
            array_push($lstMenu,$a);
            $ctr++;
        }
        $results = Menus::where('status','=',0)->where('parent','=',0)->where('footer','=',1)->where('typ','MENU')->whereIn('id',$lstMenuOpts)->orderBy('ord')->get();
        $a=array();
        $a['index'] = 1;
        $a['icon'] = "home.png";
        $a['label'] = "Home";
        $a['route'] = "/Index";
        array_push($lstFooter,$a);
        $ctr=2;
        foreach($results as $row)
        {
            $a=array();
            $a['index'] = $ctr;
            $a['icon'] = "".$row->icon;
            $a['label'] = $row->name;
            $a['route'] = $row->route;
            array_push($lstFooter,$a);
            $ctr++;
        }
        //$lstMenu = $lstMenuOpts;
        // $cnt = Menus::join('role_opts','role_opts.menuid','menus.id')
        //         ->where('role_opts.role_id','=',$role)
        //         ->where('menus.status','=',0)
        //         ->where('menus.parent','=',0)
        //         ->where('menus.typ','MENU')
        //         ->count();
        // if($cnt == 0)
        // {
        //     $ctr=1;
        //     $results = Menus::where('status','=',0)->where('parent','=',0)->where('typ','MENU')->where('def','=',1)->orderBy('ord')->get();
        //     foreach($results as $row)
        //     {
        //         $a['index'] = $ctr;
        //         $a['icon'] = "".$row->icon;
        //         $a['label'] = $row->name;
        //         $a['route'] = $row->route;
        //         $a['header'] = 0;
        //         array_push($lstMenu,$a);
        //         $ctr++;
        //     }
        //     $results = Menus::where('status','=',0)->where('parent','=',0)->where('typ','MENU')->where('def','=',1)->where('footer','=',1)->orderBy('ord')->get();
        //     $a=array();
        //     $a['index'] = 1;
        //     $a['icon'] = "home.png";
        //     $a['label'] = "Home";
        //     $a['route'] = "/Index";
        //     array_push($lstFooter,$a);
        //     $ctr=2;
        //     foreach($results as $row)
        //     {
        //         $a=array();
        //         $a['index'] = $ctr;
        //         $a['icon'] = "".$row->icon;
        //         $a['label'] = $row->name;
        //         $a['route'] = $row->route;
        //         array_push($lstFooter,$a);
        //         $ctr++;
        //     }
        // }
        // else
        // {
        //     $ctr=1;
        //     $results = Menus::join('role_opts','role_opts.menuid','menus.id')
        //         ->where('role_opts.role_id','=',$role)
        //         ->where('menus.status','=',0)
        //         ->where('menus.parent','=',0)
        //         ->where('menus.typ','MENU')
        //         ->select('menus.*')->orderBy('menus.ord')->get();
        //     foreach($results as $row)
        //     {
        //         $a['index'] = $ctr;
        //         $a['icon'] = "".$row->icon;
        //         $a['label'] = $row->name;
        //         $a['route'] = $row->route;
        //         $a['header'] = 0;
        //         array_push($lstMenu,$a);
        //         $ctr++;
        //     }
        //     $results = Menus::join('role_opts','role_opts.menuid','menus.id')
        //         ->where('role_opts.role_id','=',$role)
        //         ->where('menus.status','=',0)
        //         ->where('menus.footer','=',1)
        //         ->where('menus.parent','=',0)
        //         ->where('menus.typ','MENU')
        //         ->select('menus.*')->orderBy('menus.ord')->get();
        //     $a=array();
        //     $a['index'] = 1;
        //     $a['icon'] = "home.png";
        //     $a['label'] = "Home";
        //     $a['route'] = "/Index";
        //     array_push($lstFooter,$a);
        //     $ctr=2;
        //     foreach($results as $row)
        //     {
        //         $a=array();
        //         $a['index'] = $ctr;
        //         $a['icon'] = "".$row->icon;
        //         $a['label'] = $row->name;
        //         $a['route'] = $row->route;
        //         array_push($lstFooter,$a);
        //         $ctr++;
        //     }
        // }
        $output['status'] = "success";
        $output['message']="";
        $output['data'] = array("lstMenu"=>$lstMenu,"lstFooter"=>$lstFooter);
        return $output['data'];
    }
    public static function createNewUser($empcode,$password) {
        $out['status'] = "fail";
        $out['id'] = 0;
        $id=0;
        $results = LibAPI::getLoginDetails($empcode,$password);
         
        if($results['status'] == "success") {
            $email = $results['data']['Email'];
            $name = $results['data']['EmpName'];
            $role = Roles::where('def_role','=',1)->first();

            $defRole = $role->id;
            $cnt = Users::where('email',$email)->count();
            $cnt=0;
            if($cnt == 0) {
                $u = new Users;
                $u->name = $name;
                $u->email = $email;
                $u->email_verified_at = Carbon::now();
                $u->password =$name;
                $u->remember_token="";
                $u->is_admin=0;
                $u->status = 0;
                $u->img = "";
                $u->profile="";
                $u->gender="";
                $u->emp_code = $empcode;
                $u->mobile = "";
                $u->dept = 0;
                $u->location = 0;
                $u->role=$defRole;
                $u->about = '';
                $u->save();
                $id = $u->id;
                if($id != 0){
                    LibAPI::updateUserDetails($empcode);
                    $out['status'] = "success";
                    $out['id'] = $id;
                }
            }
        }
        
        return $id;
    }
}