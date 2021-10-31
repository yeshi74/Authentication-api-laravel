<?php // Code within app\Helpers\Helper.php
namespace App\Helpers;
use Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use DB;
use App\Model\DbModels\Users;
use App\Model\DbModels\Incidents;
use App\Model\DbModels\Locations;
use App\Model\DbModels\DBIncidents;
use App\Model\DbModels\Q4eAssign;
use App\Model\DbModels\Q4eForms;
use App\Model\DbModels\Dashboard;
use App\Model\DbModels\DBUpcoming;
use App\Model\DbModels\Slides;
use App\Helpers\LibIncidents;
use App\Model\DbModels\UserLocations;
use App\Helpers\LibFiles;
class LibDashboard
{
    public static function getSlides($userID,$userName)
    {
        $results = Slides::where('status','=',0)->orderBy('ord')->get();
        $lstSlides = array();
        $ctr=1;
        foreach($results as $row){
            $a['typ'] = $row->typ;
            $a['subtype'] = "";
            $a['video'] = "";
            $a['img'] = "";
            $a['name'] = "slide".$ctr;
            $ctr++;
            if($a['typ'] == "BANNER" || $a['typ'] =="VIDEO"){
                $a['subtype'] = $a['typ'];
                $a['video'] = $row->video;
                
                if($a['typ'] == "BANNER"){
                    $a['img'] = LibFiles::getSlideImage($row->id,$row->img);//env('IMAGE_URL')."slides/".$row->img;
                }   
                if($a['typ']=="VIDEO"){
                    $a['video'] = "https://www.youtube.com/embed/".$a['video'];
                }           
                $a['typ'] = "OTHERS";
            }
            $a['body'] = LibDashboard::getSlideBody($row->body,$userName);
            $a['caption']  = LibDashboard::getSlideCaption($row->caption,$userName);
            array_push($lstSlides,$a);
        }
        return $lstSlides;
    }
    public static function getSlideBody($caption,$name){
        $caption = str_replace("[NAME]",$name,$caption);
        return $caption;
    }
    public static function getSlideCaption($caption,$name){
        $caption = str_replace("[NAME]",$name,$caption);
        return $caption;
    }
    public static function countBoard($userid)
    {
        $lstResults = Dashboard::where('status',0)->where('typ','USER')->orderBy('ord')->get();
        $lstDashboard = array();
        $ctr=1;
        foreach($lstResults as $r):
            $query = $r->query;
            $query = str_replace("[USERID]", $userid,$query); 
            $val = DB::select($query);
            $cnt= $val[0]->cnt;
            //if($cnt != 0){
                $ar1 = array('index'=>$ctr,'dbid' => $r->dbid,'icon'=>$r->icon,'caption'=>$r->caption,'desturl'=>$r->desturl,'value'=>$cnt,'style'=>'color:'.$r->cls,'style1'=>'color:bg-'.$r->cls,'class'=>$r->cls."");
                $ctr++;
                array_push($lstDashboard,$ar1);
            //}
        endforeach;
        return $lstDashboard;
    }
}