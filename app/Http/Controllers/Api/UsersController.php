<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use App\Model\DbModels\Users;
use Carbon\Carbon;
use App\Model\AppModels\Consultations;
use App\Model\AppModels\LoginApp;
use App\Model\AppModels\RegisterApp;
class UsersController extends Controller
{
 public $successStatus = 200;

    //Search user by name or location
    public function filter(Request $request, $name)
    {
        $data = $request->get('name');
        $users = Users::select('name', 'location', 'description', 'email', 'mobile')
            ->where('name', 'like', "%{$name}%")
            ->orWhere('location', 'like', "%{$name}%")
            ->get();

        return Response()->json([
            'status' => 'success',
            'data' => $users
        ], 200);
    }

    public function list()
    {
        $result = Consultations::getUsers();
        $out['status'] = 'success';
        $out['message'] = '';
        $out['data'] = array('result'=>$result);
        return response($out, 200);
    }

    public function logout(Request $request)
    {
        $output['status'] = 'success';
        $output['message'] = array();
        $signout = LoginApp::logout($request);
        return response($output, 200);
    }

    //Update user details
    public function profileUpdate(Request $request, $id)
    {
        $userid = Auth::user()->id;
        $output['status'] = 'success';
        $output['message'] = '';
        $output['data'] = array();
        $user = Users::find($id);            
        $user->update($request->all());                
        return response($output, 200);
    }
    
    //Show profile detail list
    public function profileInit()
    {
        $userid = Auth::user()->id;
        $rsUser = Users::select('_id', 'name', 'email', 'mobile', 'location')
            ->where('_id','=',$userid)->first();
        $out['status'] = "success";
        $out['message'] = "";
        $out['data'] = array("results"=>$rsUser);
        return response($out,200);
    }
 
    public function profileImage(Request $request)
    {
        $result = RegisterApp::getProfileImage($request);
        $out['status'] = 'success';
        $out['message'] = '';
        $out['data'] = array('result'=>$result);
        return response($out, 200);
    }
    
    //Upload photo gallery
    public function storeGallery(Request $request)
    {
        $result = RegisterApp::uploadImage($request);
        $out['status'] = 'success';
        $out['message'] = '';
        $out['data'] = array();
        return response($out, 200);
    }

    public function profileUpload(Request $request)
    {
        $result = RegisterApp::uploadProfile($request);
        $out['status'] = 'success';
        $out['message'] = '';
        $out['data'] = array();
        return response($out, 200);
    }

}
