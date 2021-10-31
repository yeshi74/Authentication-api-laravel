<?php // Code within app\Helpers\Helper.php
namespace App\Helpers;
use Config;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Helpers\FileAttachments;
use Hamcrest\Type\IsObject;
use App\Model\DbModels\Appointments;
use App\Libs\HelperLibs;
use DateTime;
class EDoc
{
    public static function getAPIData(Request $request)
    {
        $typ = $request->typ;
        $apiURL = "";
        $results = array();
        if($typ=="CITIES")  $results = EDoc::getCities($request); 
        if($typ=="HOSPITALS")  $results = EDoc::getHospitals($request); 
        if($typ=="SPECIALITY")  $results = EDoc::getSpecialities($request);
        if($typ=="DOCTORS")  $results = EDoc::getDoctors($request);
        if($typ=="APTDATES")  $results = EDoc::getAptDates($request);
        if($typ=="SLOTS") $results = EDoc::getSlots($request);
        // $params['hospitalTypeId'] = 2;
        // $results = EDoc::getResults($apiURL,$params);
        return $results;
    }
    public static function getCities(Request $request)
    {
        $apiURL = "GetAllCities";
        $params['hospitalTypeId'] = 2;
        $results = EDoc::getResults($apiURL,$params);
        $out['results'] = $results;
        $out['params'] = $params;
        return $out;
    }
    public static function getHospitals(Request $request)
    {
        $apiURL = "GetAllHospitals";
        $params['hospitalTypeId'] = 2;
        $params['cityId'] = $request->cityId;
        $results = EDoc::getResults($apiURL,$params);
        $out['results'] = $results;
        $out['params'] = $params;
        return $out;
    }
    public static function getSpecialities(Request $request)
    {
        $apiURL = "GetAllSpecilities";
        $params['hospitalTypeId'] = 2;
        $params['cityId'] = $request->city;
        $params['hospitalId'] = $request->hospitalId;
        $results = EDoc::getResults($apiURL,$params);
        $out['results'] = $results;
        $out['params'] = $params;
        return $out;
    }
    public static function getDoctors(Request $request)
    {
        $apiURL = "GetAllDoctors";
        $params['hospitalTypeId'] = 2;
        $params['cityId'] = $request->cityId;
        $params['hospitalId'] = $request->hospitalId;
        $params['specialityId'] = $request->specialityId;
        $results = EDoc::getResults($apiURL,$params);
        $out['results'] = $results;
        $out['params'] = $params;
        return $out;
    }
    public static function getAptDates(Request $request)
    {
        $apiURL = "GetAvailableConsultationDatesIneDocv3";
        $params['hospitalTypeId'] = 2;
        $params['hospitalId'] = $request->hospitalId;
        $params['doctorId'] = $request->doctorId;
        $params['isQuickApptRequest'] = "true";
        $results = EDoc::getResults($apiURL,$params);
        $lstDates = EDoc::getValidDates($results);
        $out['results'] = array("results"=>$results,"lstDates"=>$lstDates);
        //
        $out['params'] = $params;
        return $out;
    }
    public static function getValidDates($results)
    {
        $output = array();
        #print_r($results[0]->quickApptDates);
         
        $res = $results[0]->quickApptDates;
        foreach($res  as $row) {
            $output[] = EDoc::formatDate($row->appointmentDate);
        }
        return $output;
    }
    public static function formatDate($d)
    {
        $a = explode("-",$d);
        $d = $a[2]."/".$a[1]."/".$a[0];
        return $d;
    }
    public static function getSlots(Request $request)
    {
        $apiURL = "GetAvailableConsultationSlotsIneDocv3";
        // $params['hospitalTypeId'] = 2;
        $params['hospitalId'] = $request->hospitalId;
        $params['doctorId'] = $request->doctorId;
        $params['specialityId'] = $request->specialityId;
        $params['appointmentDate'] = EDoc::formatAptDate($request->appointmentDate);
         
        $results = EDoc::getResults($apiURL,$params);
        // $results->afternoonSlotTime = $results->eveningSlotTime;
        $output['lstSlots'] = EDoc::formatSlots($results);
        $output['lstMorning'] = EDoc::getSlotList($results,"MORNING");
        $output['lstNoon'] = EDoc::getSlotList($results,"NOON");
        $output['lstEvening'] = EDoc::getSlotList($results,"EVENING");
        $output['lstNight'] = EDoc::getSlotList($results,"NIGHT");
        $output['token'] = $results->appointmentBookingToken;
        // $output['lstNoon'] = isset($results->afternoonSlotTime) ? $results->afternoonSlotTime : array();
        // $output['lstEvening'] = isset($results->afternoonSlotTime) ? $results->afternoonSlotTime : array();
        // $output['lstNight'] = isset($results->afternoonSlotTime) ? $results->afternoonSlotTime : array();
        $out['results'] = $output;
        $out['params'] = $params;
        return $out;
    }
    public static function getSlotList($results,$t)
    {
        $out = array();
        if($t=="MORNING") {
            if(isset($results->morningSlotTime)) {
                foreach($results->morningSlotTime as $row)
                {
                    $a['label'] = $row->slotTime;
                    $a['value'] = $row->slotId;
                    array_push($out,$a);
                }
            }
        }
        if($t=="NOON") {
            if(isset($results->afternoonSlotTime)) {
                foreach($results->afternoonSlotTime as $row)
                {
                    $a['label'] = $row->slotTime;
                    $a['value'] = $row->slotId;
                    array_push($out,$a);
                }
            }
        }
        if($t=="EVENING") {
            if(isset($results->eveningSlotTime)) {
                foreach($results->eveningSlotTime as $row)
                {
                    $a['label'] = $row->slotTime;
                    $a['value'] = $row->slotId;
                    array_push($out,$a);
                }
            }
        }
        if($t=="NIGHT") {
            if(isset($results->nightSlottTime)) {
                foreach($results->nightSlottTime as $row)
                {
                    $a['label'] = $row->slotTime;
                    $a['value'] = $row->slotId;
                    array_push($out,$a);
                }
            }
        }
        return $out;
    }
    public static function formatAptDate($d)
    {
        $a = str_replace("/","-",$d);
       return $a;
    }
    public static function formatSlots($results)
    {
        $options = array();
        $a = array();
        $a['label'] = "Morning";
        $a['value'] = "morningSlotTime";
        $a['disable'] = false;
        if(count($results->morningSlotTime) == 0) $a['disable'] = true;
        array_push($options,$a);
        $a['label'] = "Afternoon";
        $a['value'] = "afternoonSlotTime";
        $a['disable'] = false;
        if(count($results->afternoonSlotTime) == 0) $a['disable'] = true;
        $a['disable'] = true;
        array_push($options,$a);
        $a['label'] = "Evening";
        $a['value'] = "eveningSlotTime";
        $a['disable'] = false;
        if(count($results->eveningSlotTime) == 0) $a['disable'] = true;
        array_push($options,$a);
        $a['label'] = "Night";
        $a['value'] = "nightSlottTime";
        $a['disable'] = false;
        if(count($results->nightSlottTime) == 0) $a['disable'] = true;
        array_push($options,$a);
        return $options;
    }
    public static function getResults($url,$params)
    {
        $apiConfig = config("custom.edocapi");
        $baseURL = $apiConfig['BASE'];
        $apiURL = $baseURL.$url;
        $authKey = $apiConfig['AUTHKEY'];
        $curl = curl_init();
        $curlHttpHeaders = array(
            'xauthtoken: '.$authKey,
            'Content-Type: application/x-www-form-urlencoded'
        );
        $postFields = "";
        foreach($params as $ky=>$val) {
            if($postFields != "") $postFields .= "&";
            $postFields .= $ky."=".$val;
        }
        curl_setopt_array($curl, array(
            CURLOPT_URL => $apiURL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postFields,
            CURLOPT_HTTPHEADER => $curlHttpHeaders,
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $results = json_decode($response);
        return $results;
    }
    public static function createAppointment($userid,$data,$params,$token)
    {
        
        $apiConfig = config("custom.edocapi");
        $baseURL = $apiConfig['BASE'];
        $url = "BookConsultationAppointmentIneDocv3";
        $apiURL = $baseURL.$url;
        $postFields = "";
        foreach($data as $ky=>$val) {
            if($postFields != "") $postFields .= "&";
            $postFields .= $ky."=".$val;
        }
        $authKey = $apiConfig['AUTHKEY'];
        $curlHttpHeaders = array(
            'xauthtoken: '.$authKey,
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization: Bearer '.$token
        );
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $apiURL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postFields,
            CURLOPT_HTTPHEADER => $curlHttpHeaders,
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $results = json_decode($response);
        if(isset($results->errorCode)) {
            $out['status'] = "success";
            $out['data'] = array("results"=>$results);
            $out['message'] = "";
            $errorCode = $results->errorCode;
            $aptID = $results->appointmentId;
            if($results->errorCode == 0 && $aptID > 0) {
                //success
                $out['message'] = EDoc::insertAppointment($userid,$data,$params,$response,10);
            } else {
                $out['status'] = "fail";
                $out['message'] = $results->errorMsg;
            }
        } else {
            $out['status'] = "fail";
            $out['message'] = $results->Message;
            $out['data'] = array();
        }
        return $out;
    }
    public static function insertAppointment($userid,$data,$params,$response,$status)
    {
        $p = json_decode($response);
        $docID = "";
        if($status == 10) {
            $docID  = $p->appointmentId;
        }
        $l = new Appointments;
        $l->userid = $userid;
        $l->city = $data['cityId'];
        $l->typ = "CONSULTATION";
        $l->apt_date = HelperLibs::convertToDate($params['apt_date']);
        $l->apt_time = $data['slotTime'];
        $l->speciality = "";
        $l->speciality_id = $params['speciality_id'];
        $l->selfothers = $params['selfothers'];
        $l->uhid = $data['patientUHID'];
        $l->docid = $docID;
        $l->status = $status;
        $l->appointment_date = Edoc::formatDateCreate($params['apt_date'],$data['slotTime']);
        $l->results = json_decode($response);
        $l->save();
        $msg = "<p>Your appointment with ".$p->objConsAppt->doctorName." for ".$p->specialityName." on ".$p->objConsAppt->AppointmentDate. " ".$p->objConsAppt->SlotTime. " at ".$p->objConsAppt->hospitalName.", ".$p->objConsAppt->hospitalAddress."</p><p>Your Appointment Reference number is <strong>".$p->objConsAppt->appointmentId."</strong></p>";
        return $msg;
        
      
    }
    public static function formatDateCreate($d,$t) {
        $d = str_replace("/","-",$d);
        $x = explode("-",$d);
        $d = $x[2]."-".$x[1]."-".$x[0];
        $ar = explode("-",$t);
        $apt = $d." ".trim($ar[0]);
        $date = $apt;
        if ($date instanceof \MongoDB\BSON\UTCDateTime)
        {
            return $date;
        }
        else if ($date instanceof \Carbon\Carbon)
        {
            return new \MongoDB\BSON\UTCDateTime(new DateTime($date->toDateTimeString()));
        }
        else
        {
            return new \MongoDB\BSON\UTCDateTime(new DateTime($date));
        }
        
    }
}
