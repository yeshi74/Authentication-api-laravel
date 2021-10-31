<?php
namespace App\Http\Controllers\api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AppModels\TokenApp;
use App\User;
use App\Model\DbModels\TokenRecords;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;

class TokenController extends Controller
{
 public function createToken(Request $request)
    {
        $output['status'] =  "success";
        $output['message'] = "";
        $output['data'] = array(); 
        TokenApp::SaveToken($request);
        return response($output,200);
    }

      public function listTokens()
    {
        $output['status'] =  "success";
        $output['message'] = "";
        $output['data'] =
        TokenApp::list();
        return response($output,200);
    }

}