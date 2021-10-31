<?php
namespace App\Http\Controllers\api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AppModels\CRMApp;
use App\User;
use App\Model\DbModels\CRM;
use App\Model\DbModels\Cities;
use App\Model\DbModels\CRMRecords;
use Illuminate\Support\Facades\Auth;
use App\Model\AppModels\Consultations;
use Validator;
use Hash;
use App\Helpers\EDoc;
class ConsultationsController extends Controller
{
     
    public function initAll($typ)
    {
        
        $results = Consultations::getClinics(strtoupper($typ));
        $out['status'] = "success";
        $out['message'] = "";
        $userid = Auth::user()->id;
        $name = Auth::user()->name;
        $email = Auth::user()->email;
        $phone = Auth::user()->mobile;
        $userDet = array("name"=>$name,"email"=>$email,"mobile"=>$phone);
        $timeSlots = Consultations::getTimeSlots();
        $out['data'] = array("results"=>$results,"timeSlots"=>$timeSlots,"userDet"=>$userDet);
        return response($out,200);
    }
    public function init()
    {
        
        $results = Consultations::getClinics("CLINIC");
        $out['status'] = "success";
        $out['message'] = "";
        $userid = Auth::user()->id;
        $name = Auth::user()->name;
        $email = Auth::user()->email;
        $phone = Auth::user()->mobile;
        $userDet = array("name"=>$name,"email"=>$email,"mobile"=>$phone);
        $timeSlots = Consultations::getTimeSlots();
        $out['data'] = array("results"=>$results,"timeSlots"=>$timeSlots,"userDet"=>$userDet);
        return response($out,200);
    }
    public function createConsultation(Request $request)
    {
        Consultations::createConsultation($request);
        $out['status'] = "success";
        $out['message'] = "";
        $out['data'] = array("thankMessage"=>"Thank you. We will be confirming your appointment soon....");
        return response($out,200);
    }
    public function getlist($typ)
    {
          $results = Consultations::getList($typ);
        $out['status'] = "success";
        $out['message'] = "";
      $out['data'] = array("results"=>$results);
        return response($out,200);
    }


    public function getAllList()
    {
           $results = Consultations::getAllList();
        $out['status'] = "success";
        $out['message'] = "";
      $out['data'] = array("results"=>$results);
        return response($out,200);
    }




    public function view($id)
    {
        $results = Consultations::getRecord($id);
        $out['status'] = "success";
        $out['message'] = "";
        $out['data'] = array("results"=>$results);
        return response($out,200);
    }

  
    public function getData(Request $request)
    {
        $typ = $request->typ;
        $results = Edoc::getAPIData($request);
        $out['status'] = "success";
        $out['message'] = "";
        $out['data'] = $results;
        return response($out,200);
    }
    public function createAppointment(Request $request)
    {
        $userid = Auth::user()->id;
        $apiConfig = config("custom.edocapi");
        $rsUser = User::where('_id',$userid)->first();

        $data['patientFirstName']= $rsUser->firstname;
        $data['patientLastName']=$rsUser->lastname;
        $data['patientEmailId']= $rsUser->email_id;
        $data['patientMobileNo']= $rsUser->mobile;
        $data['patientUHID']=$rsUser->uhid;
        $data['dateOfBirth']=$rsUser->dob;
        $data['gender']= $rsUser->gender == "Male" ? 1 : 2;

        $data['slotTime']=$request->slotTime;
        $data['slotId']=$request->slotId;
        $data['cityId']=$request->cityId;
        $data['leadsource'] = $apiConfig['LEAD_SOURCE'];

        $params['speciality_id'] = $request->speciality_id;
        $params['selfothers'] = $request->selfothers;
        $params['apt_date'] = $request->apt_date;
        $token = $request->token;
       
        $results = array();
        $out = Edoc::createAppointment($userid,$data,$params,$token);
        // $out['status'] = "success";
        // $out['message'] = "";
        // $out['data'] = $results;
        return response($out,200);
    }

 public function edit(Request $request, $id)
    {
        $result = Consultations::editConsultation($request, $id);
        $out['status'] = 'success';
         $out['message'] = array("thankMessage"=>"Records Updated Successfully...");
        $out['data'] = array();
        return response($out, 200);
    }
   public function cancelConsultation(Request $request, $id)
    {
        $result = Consultations::cancelConsultation($request, $id);
        $out['status'] = 'success';
        $out['message'] = '';
        $out['data'] = array();
        return response($out, 200);
    }
    

}