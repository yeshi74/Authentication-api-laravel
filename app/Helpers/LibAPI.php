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
use App\Model\DbModels\Albums;
use App\Model\DbModels\Clinics;
use App\Model\DbModels\Locations;
use App\Model\DbModels\Users;
use App\Model\DbModels\Roles;
use Hamcrest\Type\IsObject;

class LibAPI
{
    public static function test()
    {
        $rs = Users::where('id',118)->first();
        //$fcmToken = "ddQv_904RrW3NkYhEN0Qp6:APA91bEPsYsY79bAK85Vr6nFP0-MIxBrDBKhfIBRYgr6uVrPmx85wxxasqykrwF2XO5hs6HiAOg_KmLQE9CiXKpIUlkxmS6NFtJjRlCyyoAdT6tziyzB07PHZ-ZtBUGORcrIu2pPPzYT";
        $fcmToken = $rs->ntoken;
        echo "FCM Token ".$fcmToken."\n";
        $serverKey = "AAAAWSYkIa8:APA91bGSZBAO2ifSJDEvZl1gInMY-yBHBco88jwxHPcNyhysnv_CxYurTQJAhvUN1wAbpnj6Ym0fQpmmB1dNE5OABY84haSgmX2Ii_1WBLH_Mjw-t1BBxQ4MvWSc3Ag0uMq9ZLrxluuK";
        echo "Server Key ".$serverKey."\n";
        $title="Message from App";
        $message="This is the message from the app";
        $id = null;  
        $url = "https://fcm.googleapis.com/fcm/send";            
        $header = [
        'authorization: key=' . $serverKey,
            'content-type: application/json'
        ];    
    
        $postdata = '{
            "to" : "' . $fcmToken . '",
                "notification" : {
                    "title":"' . $title . '",
                    "text" : "' . $message . '"
                },
            "data" : {
                "id" : "'.$id.'",
                "title":"' . $title . '",
                "description" : "' . $message . '",
                "text" : "' . $message . '",
                "is_read": 0
                }
        }';
    print_r($postdata);
    echo $url;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        echo "1";
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 180);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        echo "2";
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
echo "3";
        $result = curl_exec($ch);    
        curl_close($ch);
echo "here.....";
echo $result;
        print_r($result);
    }
    public static function getResultsFromAPI($mm,$yy)
    {
        $apiURL = env("RESULTS_API"); 
        $apiURL = str_replace("[MONTH]",$mm,$apiURL);
        $apiURL = str_replace("[YEAR]",$yy,$apiURL);
        $data = file_get_contents($apiURL);
        $results = array();
        $ctr=1;
        $xml=simplexml_load_string($data);
        foreach($xml->Table as $obj):
            $p = json_decode(json_encode($obj),true);
            $res = array();
            $a=array();
                if(isset($p['LOCATIONID'])) {
                    foreach($p as $ky=>$val)
                    {
                        if($ky != "LOCATIONID"){
                            $res[$ky] = $val;
                        }
                    }
                    
                    $a[$p['LOCATIONID']] = $res;
                    array_push($results,$a);
                }
            
        endforeach;
        return $results;
    }
    public static function updateLocations()
    {
        #LibAPI::updateUserDetails("AHLL04287");
        $apiURL = env("API_LOCATION");
        $data = file_get_contents($apiURL);
        $xml=simplexml_load_string($data);
        foreach($xml->Table as $obj):
            $p = json_decode(json_encode($obj),true);
            $clinicCode = "";
            if(isset($p['cliniccode'])) $clinicCode = LibAPI::getVarVal($p['cliniccode']);
            $cnt = Clinics::where('clinic_code',$clinicCode)->count();
            
            if($cnt==0){
                $c = new Clinics;
                $c->clinic_code = "";
                $c->region = "";
                $c->bu = "";
                $c->name = "";
                $c->is_active = 1;
                $c->center_head = "";
                $c->bu_head = "";
                $c->coo = "";
                $c->ceo = "";
                $c->hoq = "";
                $c->bu_id=0;
                $c->region_id=0;
                $c->center_head_id=0;
                $c->bu_head_id=0;
                $c->coo_id=0;
                $c->ceo_id=0;
                $c->hoq_id=0;
                $c->clinic_code = $clinicCode;
                if(isset($p['Region'])) $c->region = LibAPI::getVarVal($p['Region']);
                if(isset($p['ClinicName'])) $c->name = LibAPI::getVarVal($p['ClinicName']);
                if(isset($p['BU'])) $c->bu = LibAPI::getVarVal($p['BU']);
                if(isset($p['Isactive'])) $c->is_active = LibAPI::getVarVal($p['Isactive']);
                if(isset($p['CenterHead'])) $c->center_head = LibAPI::getVarVal($p['CenterHead']);
                if(isset($p['RegionalBUHead'])) $c->bu_head = LibAPI::getVarVal($p['RegionalBUHead']);
                if(isset($p['COO'])) $c->coo = LibAPI::getVarVal($p['COO']);
                if(isset($p['CEO'])) $c->ceo=LibAPI::getVarVal($p['CEO']);
                if(isset($p['HOQ'])) $c->hoq=LibAPI::getVarVal($p['HOQ']);
                $c->bu_id = LibAPI::getLocBUID($c->bu);
                $c->region_id = LibAPI::getLocRegion($c->bu_id,$c->region);
                $c->save();
             //   LibAPI::addLocClinic($c->region_id,$c->name,$c->id);
            } else {
                $rs = Clinics::where('clinic_code',$clinicCode)->first();
                $clinicID = $rs->id;
                $data=array();
                $data['bu_id'] = $rs->bu_id;
                $data['region_id'] = $rs->region_id;
                $data['name'] = $rs->name;
                if(isset($p['ClinicName'])) $data['name'] = LibAPI::getVarVal($p['ClinicName']);
                if(isset($p['BU'])) {
                    $data['bu'] = LibAPI::getVarVal($p['BU']);
                    $data['bu_id'] = LibAPI::getLocBUID($data['bu']);
                }
                if(isset($p['Region'])) {
                    $data['region'] = LibAPI::getVarVal($p['Region']);
                    $data['region_id'] = LibAPI::getLocRegion($data['bu_id'],$data['region']);
                }
                if(isset($p['Isactive'])) $data['is_active'] = LibAPI::getVarVal($p['Isactive']);
                if(isset($p['CenterHead'])) $data['center_head'] = LibAPI::getVarVal($p['CenterHead']);
                if(isset($p['RegionalBUHead'])) $data['bu_head'] = LibAPI::getVarVal($p['RegionalBUHead']);
                if(isset($p['COO'])) $data['coo'] = LibAPI::getVarVal($p['COO']);
                if(isset($p['CEO'])) $data['ceo'] = LibAPI::getVarVal($p['CEO']);
                if(isset($p['HOQ'])) $data['hoq'] = LibAPI::getVarVal($p['HOQ']);
                Clinics::where('id',$clinicID)->update($data);
            //    LibAPI::updateLocClinic($data['region_id'],$data['name'],$clinicID);
            }
        endforeach;
        LibAPI::updateLocationsFromClinics();
        $rsUsers = Clinics::select('center_head')->distinct('center_head')->get();
        foreach($rsUsers as $row){
            if($row->center_head != "") {
                $userID = LibAPI::updateUserDetails($row->center_head);
                if($userID != ""){
                    Clinics::where('center_head',$row->center_head)->update(array("center_head_id"=>$userID));
                }
            }
        }
        $rsUsers = Clinics::select('bu_head')->distinct('bu_head')->get();
        foreach($rsUsers as $row){
            $userID = LibAPI::updateUserDetails($row->bu_head);
            if($userID != ""){
                Clinics::where('bu_head',$row->bu_head)->update(array("bu_head_id"=>$userID));
            }
        }
        $rsUsers = Clinics::select('coo')->distinct('coo')->get();
        foreach($rsUsers as $row){
            $userID = LibAPI::updateUserDetails($row->coo);
            if($userID != ""){
                Clinics::where('coo',$row->coo)->update(array("coo_id"=>$userID));
            }
        }
        $rsUsers = Clinics::select('ceo')->distinct('ceo')->get();
        foreach($rsUsers as $row){
            $userID = LibAPI::updateUserDetails($row->ceo);
            if($userID != ""){
                Clinics::where('ceo',$row->ceo)->update(array("ceo_id"=>$userID));
            }
        }
        $rsUsers = Clinics::select('hoq')->distinct('hoq')->get();
        foreach($rsUsers as $row){
            $userID = LibAPI::updateUserDetails($row->hoq);
            if($userID != ""){
                Clinics::where('hoq',$row->hoq)->update(array("hoq_id"=>$userID));
            }
        }
        LibAPI::updateRelatedUsers();
    }
    public static function updateLocationsFromClinics(){
        $rs = Clinics::select('bu')->distinct('bu')->get();
        foreach($rs as $row){
            $name = strtoupper($row->bu);
            $cnt = Locations::where('typ','BU')->where('name',$name)->count();
            if($cnt == 0){
                $l = new Locations;
                $l->typ='BU';
                $l->name=$name;
                $l->parent = 0;
                $l->clinic_id = 0;
                $l->save();
                $id = $l->id;
                $c = array();
                $c['bu_id'] = $id;
                Clinics::where('bu',$row->bu)->update($c);
            } else {
                $data = array();
                $data['name'] = $name;
                $r = Locations::where('typ','BU')->where('name',$name)->first();
                Locations::where('id',$r->id)->update($data);
            }
        }
        $rs = Clinics::select('region','bu')->groupBy('region','bu')->get();
        foreach($rs as $row){
            $scnt = Locations::where('name',strtoupper($row->bu))->where('typ','BU')->count();
            if($scnt == 0){
                echo $row->bu;
                 
            }
            else {
                $rsBU = Locations::where('name',strtoupper($row->bu))->where('typ','BU')->select('id')->first();
                $cnt = Locations::where('typ','REGION')->where('name',$row->region)->where('parent',$rsBU->id)->count();
                if($cnt == 0){
                    $l = new Locations;
                    $l->typ='REGION';
                    $l->name = $row->region;
                    $l->parent = $rsBU->id;
                    $l->clinic_id=0;
                    $l->save();
                    $id = $l->id;
                    $c = array();
                    $c['region_id'] = $id;
                    Clinics::where('region',$row->region)->where('bu',$row->bu)->update($c);
                } else{
                    $data = array();
                    $data['name'] = $row->region;
                    $rsLoc=  Locations::where('typ','REGION')->where('name',$row->region)->where('parent',$rsBU->id)->first();
                    Locations::where('id',$rsLoc->id)->update($data);
                }
            }
        }
        $rs = Clinics::select('id','name','region','bu','region_id','bu_id')->get();
        foreach($rs as $row){
            $cnt = Locations::where('name',$row->name)->where('typ','CENTER')->count();
            if($cnt == 0){
                $l = new Locations;
                $l->typ='CENTER';
                $l->name = $row->name;
                $l->parent = $row->region_id;
                $l->clinic_id=$row->id;
                $l->save();
            } else{
                $rsLoc = Locations::where('name',$row->name)->where('typ','CENTER')->select('id')->first();
                $data = array();
                $data['name'] = $row->name;
                $data['parent'] = $row->region_id;
                $data['clinic_id'] = $row->id;
                Locations::where('name',$row->name)->where('typ','CENTER')->update($data);
            }
        }
    }
    public static function getVarVal($var){
        $out="";
        if(isset($var))
        {
            if(!is_array($var)) $out = $var;
        }
        return $out;
    }
    public static function refreshUser($empCode)
    {
        $userID = LibAPI::updateUserDetails($empCode);
    }
    public static function updateUserDetails($empCode)
    {
        $userID="";
        try
        {
            $apiURL = env("API_GET_EMP");
            $apiURL = str_replace("[EMPID]",$empCode,$apiURL);
            
            $data = file_get_contents($apiURL);
            $id=0;
            $params['eCode']="";
            $params['empName']="";
            $params['email']="";
            $params['clinicCode']="";
            $params['isActive']=1;
            $params['contactNumber']="";
            $params['reportingManager']="";
            $params['location'] = 0;
            $params['gender']="";
            $params['cost_center']="";
            $params['standard_role']="";
            $xml=simplexml_load_string($data);
            
            if(isset($xml->Table))
            {
                foreach($xml->Table as $obj):
                    $p = json_decode(json_encode($obj),true);
                    if(isset($p['EmpCode']))  $params['eCode'] = LibAPI::getVarVal($p['EmpCode']);
                    if(isset($p['EmpName']))  $params['empName'] = LibAPI::getVarVal($p['EmpName']);
                    if(isset($p['Email']))  $params['email'] = LibAPI::getVarVal($p['Email']);
                    if(isset($p['ClinicCode']))  $params['clinicCode'] = LibAPI::getVarVal($p['ClinicCode']);
                    if(isset($p['IsActive']))  $params['isActive'] = LibAPI::getVarVal($p['IsActive']);
                    $params['isActive'] = $params['isActive'] === "true" ? 0 : 1;
                    if(isset($p['CONTACT_NUMER'])) $params['contactNumber'] = LibAPI::getVarVal($p['CONTACT_NUMER']);
                    if(isset($p['REPORTING_MANAGER'])) $params['reportingManager'] = LibAPI::getVarVal($p['REPORTING_MANAGER']);
                    if(isset($p['GENDER'])) $params['gender'] = LibAPI::getVarVal($p['GENDER']);
                    if(isset($p['COST_CENTRE'])) $params['cost_center'] = LibAPI::getVarVal($p['COST_CENTRE']);
                    if(isset($p['STANDARD_ROLE'])) $params['standard_role'] = LibAPI::getVarVal($p['STANDARD_ROLE']);
                endforeach;
                if($params['clinicCode'] != ""){
                    $cnt = Clinics::where('clinic_code',$params['clinicCode'])->count();
                    if($cnt > 0){
                        $clinicID = Clinics::where('clinic_code',$params['clinicCode'])->select('id')->first()->id;
                        $cnt = Locations::where('typ','CENTER')->where('clinic_id',$clinicID)->count();
                        if($cnt > 0){
                            $params['location'] = Locations::where('typ','CENTER')->where('clinic_id',$clinicID)->select('id')->first()->id;
                        }
                    }
                }
                $cnt = Users::where('emp_code',$params['eCode'])->count();
                if($cnt == 0){
                    $u = new Users;
                    $u->name = $params['empName'];
                    $u->password="";
                    $u->gender="";
                    $u->role=0;
                    $u->email = $params['email'];
                    $u->is_admin=0;
                    $u->status = $params['isActive'];
                    $u->img="";
                    $u->profile="";
                    $u->emp_code=$params['eCode'];
                    $u->mobile=$params['contactNumber'];
                    $u->dept=0;
                    if($params['location'] != 0) $u->location = $params['location'];
                    $u->about="";
                    $u->is_hod=0;
                    $u->mgr_code = $params['reportingManager'];
                    $u->mgr_id=0;
                    $u->cost_center = $params['cost_center'];
                    $u->standard_role = $params['standard_role'];
                    if($params['gender'] != ""){
                        if($params['gender']=="M") $u->gender = "Male";
                        if($params['gender']=="F") $u->gender = "Female";
                    }
                    $u->save();
                    $userID = $u->id;
                }
                else{
                    $rsUser = Users::where('emp_code',$params['eCode'])->first();
                    $userID = $rsUser->id;
                    $update['name'] = $rsUser->name;
                    $update['email'] = $rsUser->email;
                    $update['mobile'] = $rsUser->mobile;
                    $update['status'] = $rsUser->status;
                    $update['location'] = $rsUser->location;
                    $update['mgr_code'] = $rsUser->mgr_code;
                    $update['mgr_id'] = $rsUser->mgr_id;
                    if($rsUser->name != $params['empName']) $update['name'] = $params['empName'];
                    if($rsUser->email != $params['email']) $update['email'] = $params['email'];
                    if($rsUser->mobile != $params['contactNumber']) $update['mobile'] = $params['contactNumber'];
                    if($rsUser->status != $params['isActive']) $update['status'] = $params['isActive'];
                    if($rsUser->location != $params['location'] && $params['location'] != 0) $update['location'] = $params['location'];
                    if($rsUser->mgr_code != $params['reportingManager']) {
                        $update['mgr_code'] = $params['reportingManager'];
                        $update['mgr_id'] = 0;
                    }
                    if($params['gender'] != ""){
                        if($params['gender']=="M") $update['gender'] = "Male";
                        if($params['gender']=="F") $update['gender'] = "Female";
                    }
                    $update['cost_center'] = $params['cost_center'];
                    $update['standard_role'] = $params['standard_role'];
                    Users::where('id',$userID)->update($update);
                }
            }
            LibAPI::updateUserRoles();
        }
        catch (Exception $e)
        {
           
        }
        return $userID;
    }
    public static function updateUserRoles()
    {
        $results = Users::where('standard_role','!=','')->select('standard_role')->distinct('standard_role')->get();
        foreach($results as $row){
            $cnt = Roles::where('code',$row->standard_role)->count();
            if($cnt == 0){
                $r = new Roles;
                $r->code = $row->standard_role;
                $r->name = $row->standard_role;
                $r->def_role = 0;
                $r->save();
                $id = $r->id;
            }
            else{
                $id = Roles::where('code',$row->standard_role)->select('id')->first()->id;
            }
            Users::where('standard_role',$row->standard_role)->update(array("role"=>$id));
        }
    }
    public static function updateRelatedUsers()
    {
        $results = Users::where('mgr_id','=',0)->where('mgr_code','!=','')->select('mgr_code')->distinct('mgr_code')->get();
        foreach($results as $row){
            $cnt = Users::where('emp_code',$row->mgr_code)->count();
            if($cnt == 0){
                $managerID = LibAPI::updateUserDetails($row->mgr_code);
            }
            else{
                $managerID = Users::where('emp_code',$row->mgr_code)->select('id')->first()->id;
            }
            if($managerID != "") {
                Users::where('mgr_code',$row->mgr_code)->update(array('mgr_id'=>$managerID));
            }
        }
    }
    public static function addLocClinic($region,$name,$id){
        $cnt = Locations::where('name',trim($name))->where('parent',$region)->where('typ','CENTER')->count();
        if($cnt == 0){
            $l = new Locations;
            $l->typ="CENTER";
            $l->name=trim($name);
            $l->parent = $region;
            $l->clinic_id = $id;
            $l->save();
            $id = $l->id;
        }
        else{
            $id = Locations::where('name',trim($name))->where('typ','CENTER')->where('parent',$region)->select('id')->first()->id;
            Locations::where('id',$id)->update(array("clinic_id"=>$id));
        }
    }
    public static function updateLocClinic($region,$name,$id){
        $cnt = Locations::where('clinic_id',$id)->count();
        if($cnt> 0){
            $data['name']=trim($name);
            $data['parent'] = $region;
            Locations::where('id',$id)->update($data);
        }
    }
    public static function getLocRegion($buID,$region)
    {
        $id=0;
        if($buID !=0 && $region != ""){
            $cnt = Locations::where('name',trim($region))->where('typ','REGION')->where('parent',$buID)->count();
            if($cnt==0){
                $l = new Locations;
                $l->typ="REGION";
                $l->name=trim($region);
                $l->parent = $buID;
                $l->save();
                $id = $l->id;
            }
            else{
                $id = Locations::where('name',trim($region))->where('typ','REGION')->where('parent',$buID)->select('id')->first()->id;
            }
        }
        return $id;
    }
    public static function getLocBUID($bu)
    {
        $id=0;
        if($bu != "")
        {
            $cnt = Locations::where('name',trim($bu))->where('typ','BU')->count();
            if($cnt==0){
                $l = new Locations;
                $l->typ="BU";
                $l->name=trim($bu);
                $l->parent = 0;
                $l->save();
                $id = $l->id;
            }
            else{
                $id = Locations::where('name',trim($bu))->where('typ','BU')->select('id')->first()->id;
            }
        }
        return $id;
    }
	public static function checkUserExists($email,$empCode)
	{
		try
        {
            $apiURL = env("API_CHECK_MAIL_EXISTS");
            $apiURL = str_replace("[EMAIL]",$email,$apiURL);
            $apiURL = str_replace("[EMPCODE]",$empCode,$apiURL);
            $data = file_get_contents($apiURL);
            $out = array();
            $out["status"]="FAIL";
            $out["mobile"]="";
            $xml=simplexml_load_string($data);
            foreach($xml->Table as $obj):
                $p = json_decode(json_encode($obj));
                if($p->status == "SUCCESS"){
                    $out  = array("status"=>"success",
                           "mobile"=>$p->mobile
                        );
                }
            endforeach;
        }
        catch (Exception $e)
        {
           
        }
        return $out;
	}
	public static function checkLogin($email,$password,$empcode="")
	{
        $out = array();
            $out["status"]="fail";
            $out["message"]="";
		try
        {
            $apiURL = env("API_CHECK_PASS");
            $apiURL = str_replace("[EMAIL]",$email,$apiURL);
            $apiURL = str_replace("[EMPCODE]",$empcode,$apiURL);
            $apiURL = str_replace("[PASSWORD]",$password,$apiURL);
            
            
            $data = file_get_contents($apiURL);
            
            $xml=json_decode(json_encode(simplexml_load_string($data)));
            foreach($xml as $obj):
                $p = json_decode(json_encode($obj));
                if($p->status == "SUCCESS"){
                    $out  = array("status"=>"success","message"=>"");
                } else {
                    $message = $p->message;
                    $out  = array("status"=>"fail","message"=>$message);
                }
            endforeach;
           
            //$status = strtoupper($xml->Result);
            // $status="";
            // print_r($xml);
            // echo $status;
            // die();
            // if($status == "SUCCESS"){
            //     $out  = array("status"=>"success","message"=>"");
            // }
            // else{
            //     $message = $xml->FailureReason;
            //     $out  = array("status"=>"fail","message"=>$message);
            // }
            #print_r($xml);
            // foreach($xml as $obj):
            //     $p = json_decode(json_encode($obj));
            // print_r($p);
            //     if($p[0] == "SUCCESS"){
            //         $out  = array("status"=>"success",
            //                "message"=>""
            //             );
            //     }
            //     else{
            //     	$out  = array("status"=>"fail",
            //                "message"=>$p[1]
            //             );
            //     }
            // endforeach;
        }
        catch (Exception $e)
        {
           
        }
         
        return $out;
	}
	public static function getUserDetailsByEmpCode($email,$empCode)
	{
		try
        {
            $apiURL = env("API_GET_USER_DETAILS_EMP");
            $apiURL = str_replace("[EMAIL]",$email,$apiURL);
            $apiURL = str_replace("[EMPCODE]",$empCode,$apiURL);
            $data = file_get_contents($apiURL);
            $out = array();
            $out["status"]="FAIL";
            $out["name"]="";
            $xml=simplexml_load_string($data);
            foreach($xml->Table as $obj):
                $p = json_decode(json_encode($obj));
                if($p->status == "SUCCESS"){
                    $out  = array("status"=>$p->status,
                           "name"=>$p->name
                        );
                }
                else{
                	
                }
            endforeach;
        }
        catch (Exception $e)
        {
           
        }
        return $out;
	}
	public static function getUserDetails($email)
	{
		try
        {
            $apiURL = env("API_GET_USER_DETAILS_EMAIL");
            $apiURL = str_replace("[EMAIL]",$email,$apiURL);
            $data = file_get_contents($apiURL);
            $out = array();
            $out["status"]="FAIL";
            $out["name"]="";
            $xml=simplexml_load_string($data);
            foreach($xml->Table as $obj):
                $p = json_decode(json_encode($obj));
                if($p->status == "SUCCESS"){
                    $out  = array("status"=>"success",
                           "name"=>$p->name
                        );
                }
                else{
                	
                }
            endforeach;
        }
        catch (Exception $e)
        {
           
        }
        return $out;
	}

    public static function sendSMS($number,$message)
    {
        $url = env("SMS_URL");        
        $smsUser = env("SMS_USER");
        $smsPass = env("SMS_PASS");
        $sms = '<message-submit-request><username>'.$smsUser.'</username><password>'.$smsPass.'</password>';
        $sms .= '<sender-id>APQLTY</sender-id><MType>TXT</MType><message-text><text>';
        $sms .= $message.'</text>';
        $sms .= "<to>".$number."</to></message-text>";
        $sms .= '</message-submit-request>';

        #echo $sms;
       # echo $url;
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_HEADER, false );      
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 2 );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "data=".$sms);
        #$response = curl_exec( $ch );
        curl_close( $ch );
        #print_r($response);
        #$message="1234 is OTP for Registering ApolloQ4E App";
        $pass = "dM76\$Bc-";
        $message = urlencode($message);
        $url = "http://www.smsjust.com/sms/user/urlsms.php?username=apollohealth&pass=".$pass."&senderid=APOLLO&dest_mobileno=".$number."&message=".$message."&response=Y";
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_HEADER, false );      
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 2 );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch, CURLOPT_URL, $url );
        #$response = curl_exec( $ch );
        curl_close( $ch );
    }
    public static function getLoginDetails($empcode,$password)
    {
        $out = array();
        $out["status"]="fail";
        $out["message"]="";
        $out['data'] = array();
        $params['EmpName']="";
        $params['Email']="";
        try
        {
            $apiURL = env("API_CHECK_PASS");
            $apiURL = str_replace("[EMPCODE]",$empcode,$apiURL);
            $apiURL = str_replace("[PASSWORD]",$password,$apiURL);
            $data = file_get_contents($apiURL);
            
            $xml=json_decode(json_encode(simplexml_load_string($data)));
            foreach($xml as $obj):
                $p = json_decode(json_encode($obj));
                if($p->status == "SUCCESS"){
                    $params['EmpName']=$p->EmpName;
                    if(is_object($p->Email)) {
                        $params['Email'] = "";
                    } else {
                        $params['Email'] = $p->Email;
                    }
                    $out['data'] = $params;
                    $out['status'] = "success";
                } else {
                    $message = $p->message;
                    $out  = array("status"=>"fail","message"=>$message);
                }
            endforeach;
        }
        catch (Exception $e)
        {
           
        }
         
        return $out;
    }



 public static function refreshCRM($id)
    {
        $crmID = LibAPI::updateCRMDetails($id);
    }
    public static function updateCRMDetails()
    {
       /* $crmID=$id;*/
       
            $apiURL = env("API_GET_CRM");
          /*  $apiURL = str_replace("[EMPID]",$empCode,$apiURL);*/
            
       /*     $data = file_get_contents($apiURL);*/

       

      
          $ch=curl_init();//initiating curl
          curl_setopt($ch,CURLOPT_URL,$apiURL);// CALLING THE URL
          curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
          curl_setopt($ch,CURLOPT_PROXYPORT,3128);
          curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);
          curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
          $data=curl_exec($ch); 
      
     /*   $out =array();
        foreach($data as $rs){
            $a = array();
            $a['Nation'] = $rs->Nation;
            $a['Year'] = $rs->Year;           
            array_push($out,$a);
            
        } */
      
        return $data;
    }

    //AIRS API
    public static function getAIRSFields()
    {
        $apiURL = env("AIRS_GET_FIELDS");
        $ch=curl_init();//initiating curl
          curl_setopt($ch,CURLOPT_URL,$apiURL);// CALLING THE URL
          curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
          curl_setopt($ch,CURLOPT_PROXYPORT,3128);
          curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);
          curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
          $data=curl_exec($ch); 
          echo $data;
    }




}
?>