<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use App\Model\DbModels\Admin;
use App\Model\DbModels\Users;
use App\Helpers\FileAttachments;
use App\Model\DbModels\Attachments;
use App\Model\DbModels\Department;
use App\Model\DbModels\Locations;
use App\Model\DbModels\Roles;
class AdminUsersController extends Controller
{
    public $successStatus = 200;
    public function list()
    {
        $results = users::where('status','=',0)->get();
        return  response($results,200);
    }
    public function update(Request $request)
   	{
        $userid = Auth::user()->id;
        //$result=Users::where('id','=',$userid)->where('email','=',$request->email)->update(['name'=>$request->name,'password'=>bcrypt($request->password)]);
        $result = Users::where('id','=',$userid)->update(['name'=>$request->name,'password'=>bcrypt($request->password)]);
        if($result) return response(array('message'=>"updated"),200);
        else return response(array('message'=>'error invalid user'));
    }
    public function view($id)
    {
        $user = Auth::user()->id;
        $results=users::where('users.id','=',$id)->where('status','=',0)->first();
        if(isset($results))
        {
            return  response($results,200);
        }
        else
        {
            return response(array("message"=>"Not Found"),404);
        }
    }
    public function getResults($results)
    {
        $lstUsers = array();
        foreach($results as $row):
            $a['name'] = $row->name;
            $a['email'] = $row->email;
            $a['empCode'] = $row->emp_code;
            $fileResults=FileAttachments::getDetails(array("id"=>$row->id,"module"=>"PROFILE","value"=>$row->profile));
            $a['profilepicture']= $fileResults['url'];
            $a['about'] = $row->about;
            $a['mobile'] = $row->mobile;
            $a['gender'] = $row->gender;
            $a['dept'] =  Department::getDepartmentName($row->dept);
            $a['locname'] = Locations::getLocationName($row->location);
            array_push($lstUsers,$a);
        endforeach;
        return $lstUsers;
    }
    public function getProfile(Request $request)
    {
        $userid = Auth::user()->id;
        $output['status'] =  "success";
        $output['message'] = "";
        $output['data'] =array();
        $cnt = Users::where('id','=',$userid)->where('status','=',0)->count();
        if($cnt > 0){
          $results = Users::where('id','=',$userid)->where('status','=',0)->get();
             $lstUsers= $this->getResults($results);
            $output['data'] = $lstUsers[0];
        }
        else{
            $output['status'] = "fail";
            $output['message'] = "User is not found";
        }
        return  response($output,200);
    }
    public function updateProfile(Request $request)
    {
        $userid = Auth::user()->id;
        $output['status'] =  "success";
        $output['message'] = "";
        $output['data'] =array();
        $cnt = Users::where('id','=',$userid)->where('status','=',0)->count();
        if($cnt > 0){
            $results = Users::where('id','=',$userid)->update(['about'=>$request->about]);
            if($results){
                $imgResults = FileAttachments::upload($request,array("id"=>$userid,"col"=>"profile","module"=>"PROFILE"));
                if($imgResults['status'] == "SUCCESS")
                {
                    Users::where('id',$userid)->update(array("profile"=>$imgResults['ref']));
                    return response(array('status'=>"success","message"=>'Profile Updated',"userid"=>$userid),200);
                }
                else return response(array('status'=>"failed",'message'=>$imgResults['message']),200);
            }
            return response(array('message'=>"updated"),200);
        }
        else{
            $output['status'] = "fail";
            $output['message'] = "User is not found";
        }
        return  response($output,200);
    }
    public function updateProfileImage(Request $request)
    {
        $userid = Auth::user()->id;
        $output['status'] =  "success";
        $output['message'] = "";
        $output['data'] =array();
        $cnt = Users::where('id','=',$userid)->where('status','=',0)->count();
        if($cnt > 0){
            $results = Users::where('id','=',$userid)->where('status','=',0)->first();
            if($results){
                $imgResults = FileAttachments::upload($request,array("id"=>$userid,"col"=>"profile","module"=>"PROFILE"));
                if($imgResults['status'] == "SUCCESS")
                {
                    Users::where('id',$userid)->update(array("profile"=>$imgResults['ref']));
                    return response(array('status'=>"success","message"=>'Profile Updated',"userid"=>$userid),200);
                }
                else return response(array('status'=>"failed",'message'=>$imgResults['message']),200);
            }
            return response(array('message'=>"updated"),200);
        }
        else{
            $output['status'] = "fail";
            $output['message'] = "User is not found";
        }
        return  response($output,200);
    }
    public function updateAbout(Request $request)
    {
        $userid = Auth::user()->id;
        $output['status'] =  "success";
        $output['message'] = "";
        $output['data'] =array();
        $cnt = Users::where('id','=',$userid)->where('status','=',0)->count();
        if($cnt > 0){
            $results = Users::where('id','=',$userid)->where('status','=',0)->first();
            if($results)
            {
                Users::where('id','=',$userid)->update(['about'=>$request->about]);
                return response(array('message'=>"updated"),200);
            }
            else return response(array('message'=>'error invalid user'));
        }
        else{
            $output['status'] = "fail";
            $output['message'] = "User is not found";
        }
        return  response($output,200);
    }
    public function resetPassword(Request $request)
    {
        $userid = Auth::user()->id;
        $user = User::where('id', $userid)->first();
	    if ($user) {
	        if (Hash::check($request->password, $user->password)) {
                $updt['password'] = Hash::make($request->newpassword);
                $result = Users::where('id',$userid)->update($updt);
                return response(array('status'=>'success','messagge'=>"Password changed successfully"),200);
            }
            else return response(array('status'=>'fail','message'=>'Wrong password entered'));
        }
        else return response(array('status'=>'fail','message'=>'User does not exist'));
    }
}
