<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\DbModels\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;
use Hash;
use App\Model\AppModels\LoginApp;
use Carbon\Carbon;
class AuthController extends Controller
{
	public $successStatus = 200;
	public function register (Request $request) {
    $validator = Validator::make($request->all(), [
  	    'name' => 'required|string|max:50',
        'location' => 'required',
        'description' => 'required',
        'password' => 'required|confirmed',
      	'email' => 'required|string|email|max:80|unique:users',
      	'mobile' => 'required|unique:users',
  	]);
    if ($validator->fails()) $response = ['errors'=>$validator->errors()->all()];
    else{
      $request['password']=Hash::make($request['password']);
      $request['password_confirmation']=Hash::make($request['password_confirmation']);
    	$user = Users::create($request->toArray());
      $token = $user->createToken('abcdefghijk123456')->accessToken;
    	$response = ['token' => $token];
    }
    return response($response, 200);
	}

	public function login (Request $request) 
  {
    $email = $request->email;
    $password = $request->password;
    $cnt = Users::where('email', $email)->count();
    $isValid=0;
    if($cnt > 0)
    {
      $user = Users::where('email', $email)->first();
      if (Hash::check($password, $user->password))  $isValid=1;
      if($isValid == 1)
      {
        $response = AuthController::getUserDetails($user->id);
      } else {
        $response = ["status"=> 'FAIL',"message"=>"Please enter correct password"];
      }
    }
    else {
      $response = ["status"=> 'FAIL',"message"=>"User does not exist"];
    }
      
        
    return response($response, 200);
	}

  public function getUserDetails($id)
  {
    $user = Users::where('_id', $id)->first();
    $token = $user->createToken('abcdefghijk123456')->accessToken;
    Users::where('_id',$id)->update(array("last_logged"=>Carbon::now()));
    $response = ['status'=>'success','token' => $token,'name' => $user->name];
    return $response;
  }

	public function logout (Request $request) 
  {
    $token = $request->user()->token();
  	$token->revoke();
    $response = 'You have been succesfully logged out!';
  	return response($response, 200);
	}

}
