<?php

namespace App\Model\AppModels;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Model\DbModels\CRM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Model\DbModels\City;
use App\Model\DbModels\Users;
use App\Model\DbModels\Clinics;
use App\Model\DbModels\Appointments;
use App\Model\DbModels\Attachment;
use App\Model\DbModels\ConsultationRecords;
use App\Model\DbModels\ConsultationTypes;
use App\Model\DbModels\ClinicServices;
use App\Model\DbModels\Cities;
use App\Model\DbModels\Leads;
use App\Model\DbModels\AllClinics;
use App\Model\DbModels\Treatments;
use App\Libs\HelperLibs;
use Carbon\Carbon;
use App\Model\AppModels\PrismApp;
use DateTime;
use App\Model\DbModels\TokenRecords;
class Consultations extends Model
{

    public static function getAttachment()
    {
        $userid = Auth::user()->id;
        $cnt = Attachment::count();
        if($cnt > 0){
            $results = Attachment::select('id', 'attachment_type', 'attachment')->get();
            foreach($results as $row):
                $a['id'] = $row->id;
                $a['attachment_type'] = $row->attachment_type;
                $a['attachment'] = $row->attachment;
            endforeach;
            return $a;
        } else {
            $out['status'] = 'fail';
            $out['message'] = 'No attachment available yet.';
        }
    }
    

    public static function createAttachment(Request $request)
    {
        $arr = $request->all();
        $request->validate([
            'attachment_type' => 'required',
            'attachment' => 'required',
        ]);

        $attachment = new Attachment();
        if($file = $request->file('attachment')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('attachmentFile/', $name);
            $path =$name;
            $arr['attachment']=$path;
        }
        $attachment->fill($arr);
        $attachment->save();
    }

    public static function getAllList()
    {
           $userid = Auth::user()->id;
       $data = ConsultationRecords::where('userid',$userid)->orderBy('created_at')->get();
     
       return $data;
   }

public static function getList($typ)
{
        $userid = Auth::user()->id;
       $data = ConsultationRecords::where('typ',$typ)->where('userid',$userid)->orderBy('created_at')->get();
     
       return $data;
 
}

    public static function getUsers()
    {
        $cnt = Users::count();
        if($cnt > 0){
            $results = Users::select('id', 'name','email','location','description','profile_image', 
                'mobile', 'gallery')->paginate(3);
            $users = array();
            foreach($results as $row):
                $a['id'] = $row->id;
                $a['name']=$row->name;
                $a['email']=$row->email;
                $a['location']=$row->location; 
                $a['description']=$row->description;
                $a['profile_image']=$row->profile_image;
                $a['mobile']=$row->mobile;
                $a['gallery']=$row->gallery;
                array_push($users,$a);
            endforeach;
            return $users;
        }
        else
        {
            $output['status'] = "fail";
            $output['message'] = "No Users available yet";
        }
    }

    public static function getUserDetails($id)
    {
        $userid = Auth::user()->id;
        $results = Users::where('_id',$id)->first();
        $a['id'] = $results->id;
        $a['name']=$results->name;
        $a['email']=$results->email;
        $a['date']=$results->date; 
        $a['sales_team']=$results->sales_team;
        $a['sales_man']=$results->sales_man;
        $a['mobile']=$results->mobile;
        $a['nationality']=$results->nationality;
        $a['living_country']=$results->living_country;
        $a['source']=$results->source;
        $a['department']=$results->department;
        $a['doctor']=$results->doctor;
        $a['receptionist']=$results->receptionist;
        $a['call_center_agent']=$results->call_center_agent;
        $output['data'] = $a;
        return $a;
    }


    public static function getClinics($typ)
    {
        $ctype=2;
        if($typ=="DIAGNOSTICS") $ctype = 4;
        if($typ=="DENTAL") $ctype = 7;
        if($typ=="DIABETES") $ctype = 6;
        $userid = Auth::user()->id;
        $mobile = Auth::user()->mobile;
        
        $city = Cities::orderBy('name')->get();
        $results = AllClinics::where('clinicTypeId','=',$ctype)->orderBy('cityName')->orderBy('ClinicName')->get();
        $lstCity = array();
        foreach($results as $row) {
            $b=0;
            foreach($lstCity as $srow) {
                if($srow['acode'] == $row->cityId) $b=1;
            }
            if($b==0) {
                $a['acode'] = $row->cityId;
                $a['name'] = $row->cityName;
                array_push($lstCity,$a);
            }
        }
        $lstServices = ClinicServices::where('typ',$typ)->orderBy('name')->get();
        $output['city'] = $lstCity;
        $output['clinics'] = $results;
        $output['services'] = $lstServices;
        $output['lstUsers'] = PrismApp::getUsers($mobile);
        return $output;
    }
    public static function __getClinics($typ)
    {
        $results = Clinics::where('typ',$typ)->orderBy('name')->get();
        $city = array();
        foreach($results as $row)
        {
            $b=0;
            foreach($city as $srow){
                if($srow['id'] == $row->city_id) $b=1;
            }
            if($b==0) {
                $rs = City::where('_id',$row->city_id)->select('name')->first();
                $name = $rs->name;
                $city[] = array("id"=>$row->city_id,"name"=>$name);
            }
        }
        $lstServices = ClinicServices::where('typ',$typ)->get();
        $output['city'] = $city;
        $output['clinics'] = $results;
        $output['services'] = $lstServices;
        return $output;
    }
    public static function _getClinics($typ)
    {
        $city = City::getCities();
        $output = array();
        $lstClinics = Clinics::getClinics();
        $lstServices = ClinicServices::where('typ',$typ)->get();
        $retClinics = array();
        foreach($lstClinics as $row)
        {
            $a = array();
            $a['id'] = $row->_id;
            $a['name'] = $row->name;
            $a['contact'] = $row->contact;
            $a['phone'] = $row->phone;
            $a['city'] = City::getName($row->city_id);
            $a['city_id'] = $row->city_id;
            $a['address'] = $row->address;
            $b = array();
            if(isset($row['services'])) {
                foreach($row['services'] as $row1) {
                    $x = array();
                    $rsSer = ClinicServices::where('code',$row1)->where('typ',$typ)->first();
                    if($rsSer) {
                        $x['code'] = $rsSer->code;
                        $x['name'] = $rsSer->name;
                        $x['acode'] = $rsSer->acode;
                        array_push($b,$x);
                    }
                }
            }
            $a['services'] = $b;
            array_push($retClinics,$a);
        }
        // $output['lstClinics'] = $retClinics;
        $retCities = array();
        foreach($city as $row)
        {
            $a = array();
            $a['id'] = $row->id;
            $a['name'] = $row->name;
            array_push($retCities,$a);
        }
        // $output['lstCities'] = $retCities;
        $retServices = array();
        foreach($lstServices as $row)
        {
            $a = array();
            $a['code'] = $row->code;
            $a['acode'] = $row->acode;
            $a['name'] = $row->name;
            array_push($retServices,$a);
        }
        // $output['lstServices'] = $retServices;

        $lstCityServices = array();
        $city = City::getCities();
        foreach($city as $row)
        {
            $ser = array();
            $ser['city'] = $row->id;
            $ser['name'] = $row->name;
            $l = array();
            $services = array();
            foreach($retClinics as $row1)
            {
                if($row1['city_id'] == $row->id) {
                    $x = array();
                    // $x['id'] = $row1id;
                    // $x['name'] = $row1->name;
                    foreach($row1['services'] as $srow)
                    {
                        $b=0;
                        foreach($services as $k1)
                        {
                            if($k1['code']==$srow['code']) $b=1;
                        }
                        if($b==0) {
                            $services[] = Consultations::getServiceDet($srow['code'],$row->id,$retClinics);
                        }
                    }
                    array_push($l,$x);
                }
            }
            $ser['services'] = $services;
            array_push($lstCityServices,$ser);
        }
        // $output['lstCityServices'] = $lstCityServices;
        // $output['timeSlots'] = Consultations::getTimeSlots();
        return $lstCityServices;

    }
    public static function getServiceDet($code,$id,$retClinics)
    {
        $rs = ClinicServices::where('code',$code)->first();
        $a['id'] = $rs->id;
        $a['code'] = $code;
        $a['name'] = $rs->name;
        $a['acode'] = $rs->acode;
        $a['descrip'] = $rs->description;
        $a['icon'] = url($rs->icon);
        $a['clinics'] = Consultations::getClinicsList($code,$id,$retClinics);
        return $a;
    }
    public static function getTimeSlots()
    {
        $x[] = array("label"=>"8:00 - 8:15","value"=>"8:00 - 8:15");
        $x[] = array("label"=>"8:15 - 8:30","value"=>"8:15 - 8:30");
        return $x;
    }
    public static function getClinicsList($service,$city,$lstClinics)
    {
        $services = array();
        foreach($lstClinics as $row1)
        {
            if($row1['city_id'] == $city) {
                $x = array();
                // $x['id'] = $row1id;
                // $x['name'] = $row1->name;
                foreach($row1['services'] as $srow)
                {
                    if($srow['code'] == $service) {
                        $x['id'] = $row1['id'];
                        $x['name'] = $row1['name'];
                        $x['contact'] = $row1['contact'];
                        $x['phone'] = $row1['phone'];
                        $x['address'] = $row1['address'];
                        array_push($services,$x);
                    }
                    
                }
            }
        }
        return $services;
    }

public static function getName($userid,$self,$uhid,$mobile)
{
    if($self=="self") {
        $rs = User::where('_id',$userid)->first();
        $name = $rs->name;
    } else {
        $name = PrismApp::getNameForUHID($uhid);
    }
    return $name;
}
public static function formatDate($d,$t) {

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

public static function getStatusName($status)
{
    $out="";
    if($status == 0) $out = "Waiting for Confirmation";
    if($status == 10) $out = "Confirmed";
    if($status == 20) $out = "Completed";
    if($status == 30) $out = "Cancelled by Operator";
    if($status == 40) $out = "Cancelled";
    return $out;
}
 
public static function getRecord($id)
{
    $results = ConsultationRecords::where('_id',$id)->first();
 
    return $results;
}
 public static function cancelConsultation(Request $request, $id)
    {
        $userid = Auth::user()->id;       
        ConsultationRecords::where('_id',$id)->update([
            'status' => 0
        ]);      
    }

public static function canCancel($id)
{
    return 1;
}


}
