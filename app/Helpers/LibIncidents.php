<?php // Code within app\Helpers\Helper.php
namespace App\Helpers;
use Config;
use App\Model\DbModels\DbModels\Attachments;
use Illuminate\Http\Request;
use App\Model\DbModels\Tasks;
use App\Model\TasksComments;
use App\Model\DbModels\Incidents;
use App\Model\DbModels\Locations;
use App\Model\DbModels\Department;
use App\Model\DbModels\IncidentCategory;
use App\Model\DbModels\IncidentEvent;
use App\Helpers\LibTasks;
use App\Model\DbModels\Category;
use Carbon\Carbon;
use App\Model\DbModels\IncidentLogs;
use App\Model\DbModels\IncidentDetails;
use App\Model\DbModels\Users;
use App\Model\DbModels\OutcomeForms;
use App\Model\DbModels\Q4eForms;
use Illuminate\Support\Facades\Auth;
use DateInterval;
use DatePeriod;
use DateTime;
use DB;
use App\Model\DbModels\IncidentTasks;
use App\Helpers\LibNotifications;
use App\Helpers\LibUsers;
use App\Model\DbModels\ViewCenter;
class LibIncidents
{
  public static function deleteIncident($id)
  {
    LibTasks::deleteTask($id,"INCIDENT");
    LibNotifications::delete($id,"INCIDENT");
  }
  public static function getColorName($ctr)
  {
    $colorArray = array("","#c80000","#25cc51","#ed7809","#1f59ed","#eeffee","#6d13eb","#8a0b81","#d6384a");
    if($ctr > count($colorArray)-1) $ctr= rand(1,count($colorArray)-1);
    return $colorArray[$ctr];
  }
  public static function unitIncidents($user)
  {
    $canAdd  = LibUsers::canAdd("UNIT_INCIDENTS");
    $myIncidents=array();
    if($canAdd==1)
    {
      $cnt = Incidents::join('v_user_locations','v_user_locations.location','incidents.center')
          ->where('v_user_locations.id',$user)->count();
        if($cnt > 0)
        {
            $results = Incidents::join('v_user_locations','v_user_locations.location','incidents.center')
          ->where('v_user_locations.id',$user)->select('incidents.*')->orderBy('incident_date','desc')->get();
            foreach($results as $row)
            {
                $a['user']=$user;
                $a['id'] = $row->id;
                $a['uhid'] = $row->uhid;
                $a['identification'] = $row->identification;
                $a['incident_sev'] = $row->incident_sev;
                $a['locname'] = Locations::getLocationName($row->center);
                $a['place_occurence'] = $row->place_occurence;
                $a['incident_date'] = date('d/m/Y H:i',strtotime($row->incident_date));
                $a['last_updated'] = date('d/m/Y H:i',strtotime($row->updated_at));
                $a['status'] = $row->status;
                if($row->status == 0){
                  $a['color'] = "green";
                  $a['icon'] = "star_border";
                  $a['statusName'] = "New Incident";
                } 
                if($row->status == 10){
                  $a['color'] = "deep-orange";
                  $a['icon'] = "star_half";
                  $a['statusName'] = "In Progress";
                } 
                if($row->status == 20){
                  $a['color'] = "deep-orange";
                  $a['icon'] = "star_half";
                  $a['statusName'] = "In Progress";
                } 
                if($row->status == 50){
                  $a['color'] = "green";
                  $a['icon'] = "star";
                  $a['statusName'] = "Completed";
                } 
                $a['header'] = $row->incident_sev;
                array_push($myIncidents,$a);
            }
      }
    }
    return $myIncidents;
  }
  public static function getIncidentsGraph()
  {
      $data['labels'] = array("New","To Assign","In Progress","Completed","Declined");
      $data['colors'] = array("#c80000","#25cc51","#ed7809","#1f59ed","#eeffee");
      $count[] = Incidents::where('status','=',0)->count();
      $count[] = Incidents::where('status','=',10)->count();
      $count[] = Incidents::where('status','=',20)->count();
      $count[] = Incidents::where('status','=',50)->count();
      $count[] = Incidents::where('status','=',90)->count();
      $data['count'] = $count;
      return $data;
  }
  public static function getIncidentsBarGraph()
  {
    $query = "SELECT distinct(date_format(incident_date,'%Y-%m')) as v FROM incidents order by date_format(incident_date,'%Y-%m') desc limit 0,10";
    $results = DB::select($query);
    $lstPeriods = array();
    $count = array();
    foreach($results as $row){
      //$lstPeriods[] = array("id"=>$row->v,"name"=>date('F Y',strtotime($row->v."-01")));
      $lstPeriods[] = date('F Y',strtotime($row->v."-01"));
      $yy = date('Y',strtotime($row->v."-01"));
      $mm = date('m',strtotime($row->v."-01"));
      $count[] = Incidents::whereYear('incident_date',$yy)->whereMonth('incident_date',$mm)->count();
    }
    $lstPeriods = array_reverse($lstPeriods);
    $data['periods'] = $lstPeriods;
    $data['value'] = $count;
    return $data;
  }
  
  public static function getGrades()
  {
    return array("Grade 1"=>"Grade 1","Grade 2"=>"Grade 2","Grade 3"=>"Grade 3");
  }
  public static function getHODStatus()
  {
    return array("INPROGRESS"=>"In Progress","COMPLETED"=>"Completed");
  }
  public static function getIncidentLocation($id)
  {
    $loc = "";
    $cnt = Incidents::where('id',$id)->count();
    if($cnt > 0) {
      $rs = Incidents::where('id',$id)->first();
      $rsLoc = ViewCenter::where('center_id',$rs->center)->first();
      $loc = $rsLoc->bu_name." > ".$rsLoc->center_name;
    }
    return $loc;
  }
  public static function getOneIncident($id)
  {
    $cnt = Incidents::where('incidents.id','=',$id)->count();
    $output['status'] = "success";
    if($cnt > 0)
    {
      $results=Incidents::where('incidents.id','=',$id)->first();
      $results['expectedOutcome']="";
      if($results['exp_outcome'] != ""){
        $results['expectedOutcome'] = Category::getName($results['exp_outcome']);
      }
      $results['statusname']= LibIncidents::getStatusName($results['status']);
      $results['color'] = LibIncidents::getColor($results['status']);
      $results['buname'] = Locations::getName($results['bu']);
      $results['categoryName'] = Category::getName($results['category']);
      $results['center'] = Locations::getName($results['center']);
      $output['results'] = $results;
      $output['lstCategory'] = IncidentCategory::orderBy('ord')->get();

      $output['lstEvents'] = IncidentEvent::where('incident_id',$id)->where('typ','CATEGORY')->select('event_id')->get();
      $output['lstNotifications'] = IncidentEvent::join('category','category.id','incident_event.event_id')
                        ->where('incident_id',$id)->where('incident_event.typ','EVENTS')
                        ->select('category.name','incident_event.event_id')->get();
      $output['lstDetails'] = IncidentDetails::join('category','category.id','incident_details.field_id')
                        ->where('incident_id',$id)
                        ->select('category.name','incident_details.details')
                        ->orderBy('category.ord')->get();
      
      $output['lstTasks'] = LibTasks::getTasks($id,"INCIDENT");
    }
    else{
      $output['status'] = "fail";
    }
    return $output;
  }
  public static function updateAssign($data)
  {
    $o['user_comments'] = $data['user_comments'];
    $o['closed_date'] = Carbon::now();
    $o['status'] = 10;
    Tasks::where('id',$data['task'])->where('assign_to',$data['userid'])->where('parent_id',$data['id'])->update($o);
  }
  public static function getTaskDetails($id,$task,$userid)
  {
    $a=array();
    $cnt = IncidentTasks::where('assign_to',$userid)->where('parent_id',$id)->where('id',$task)->count();
    if($cnt > 0)
    {
      $row = IncidentTasks::where('assign_to',$userid)->where('parent_id',$id)->where('id',$task)->first();
      $incidentID = $row->parent_id;
      $a['id'] = $row->parent_id;
      $a['task_id'] = $row->id;
      $a['fAssignedDate'] = "Assigned On: ".date('d/m/Y H:i',strtotime($row->assign_date));
      $a['fClosingDate'] = "To be Completed by: ".date('d/m/Y',strtotime($row->exp_closing_date));
      $a['fClosedDate'] = "";
      $a['style'] = "background:orange";
      $a['color'] = "green";
      $a['icon'] = "star_border";
      $a['status'] = $row->status;
      $a['statusName'] = LibIncidents::getIncidentLogStatus($row->status);
      if($row->status == 10){
          $a['fClosedDate'] = "Completed On: ".date('d/m/Y H:i',strtotime($row->closed_date));
          $a['fClosingDate']="";
          $a['color'] = "deep-orange";
          $a['icon'] = "star_half";
      }
      else{
        if($row['closingdays'] < 0) $a['style'] = "background:red";
      }
      $a['incidentID'] = $incidentID;
      $a['uhid'] = $row->uhid;
      $a['identification'] = $row->identification;
      $a['incident_sev'] = $row->incident_sev;
      $a['locname'] = Locations::getLocationName($row->center);
      $a['incident_date'] = date('d/m/Y H:i',strtotime($row->incident_date));
      $a['last_updated'] = date('d/m/Y H:i',strtotime($row->updated_at));
      $a['inc_status'] = $row->incstatus;
      $a['inc_statusName'] = LibIncidents::getStatusName($row->incstatus);
      $a['qa_comments'] = $row->qa_comments;
      $a['user_comments'] = $row->user_comments;
      $a['header'] = $row->assigned_notes;
    }
    return $a;
  }
  public static function assignedIncidents($user,$status)
  {
    if($status == "ASSIGNED"){
      $lstStatus = array(0);
    }
    else{
      $lstStatus = array(10);
    }
    $assignIncidents=array();
    $cnt = IncidentTasks::where('assign_to',$user)->whereIn('status',$lstStatus)->count();
    if($cnt > 0)
    {
      $results = IncidentTasks::where('assign_to',$user)->whereIn('status',$lstStatus)->orderBy('status')->get();
      foreach($results as $row)
      {
        $incidentID = $row->parent_id;
        $a['id'] = $row->parent_id;
        $a['task_id'] = $row->id;
        $a['fAssignedDate'] = "Assigned On: ".date('d/m/Y H:i',strtotime($row->assign_date));
        $a['fClosingDate'] = "To be Completed by: ".date('d/m/Y',strtotime($row->exp_closing_date));
        $a['fClosedDate'] = "";
        $a['style'] = "background:orange";
        $a['color'] = "green";
        $a['icon'] = "star_border";
        $a['status'] = $row->status;
        $a['statusName'] = LibIncidents::getIncidentLogStatus($row->status);
        if($row->status == 10){
            $a['fClosedDate'] = "Completed On: ".date('d/m/Y H:i',strtotime($row->closed_date));
            $a['fClosingDate']="";
            $a['color'] = "deep-orange";
            $a['icon'] = "star_half";
        }
        else{
          if($row['closingdays'] < 0) $a['style'] = "background:red";
        }
        $a['incidentID'] = $incidentID;
        $a['uhid'] = $row->uhid;
        $a['identification'] = $row->identification;
        $a['incident_sev'] = $row->incident_sev;
        $a['locname'] = Locations::getLocationName($row->center);
        $a['incident_date'] = date('d/m/Y H:i',strtotime($row->incident_date));
        $a['last_updated'] = date('d/m/Y H:i',strtotime($row->updated_at));
        $a['inc_status'] = $row->incstatus;
        $a['inc_statusName'] = LibIncidents::getStatusName($row->incstatus);
        $a['qa_comments'] = $row->qa_comments;
        $a['header'] = $row->assigned_notes;
        array_push($assignIncidents,$a);
        
      }
    }
        return $assignIncidents;
    }
  public static function getStatus()
  {
    return array("0"=>"New","10"=>"To Assign","20"=>"In Progress","50"=>"Completed","90"=>"Declined");
  }
  public static function getStatusName($status)
  {
    $out = "";
    if($status == 0) $out= "New";
    if($status == 10) $out= "To Assign";
    if($status == 20) $out="In Progress";
    if($status == 50) $out= "Completed";
    if($status == 90) $out="Declined";
    return $out;
  }
  public static function getColor($status)
  {
    $badge="";
    if($status == 0) $badge="primary";
    if($status == 10) $badge="info";
    if($status == 20) $badge="success";
    if($status == 50) $badge="danger";
    if($status == 90) $badge="warning";
    return $badge;
  }
  public static function getIncidentCount()
  {
    $data['new'] = Incidents::where('status',0)->count();
    $data['assign'] = Incidents::where('status',10)->count();
    $data['inprogress'] = Incidents::where('status',20)->count();
    $data['completed'] = Incidents::where('status',50)->count();
    $data['declined'] = Incidents::where('status',90)->count();
    return $data;
  }
  public static function getIncidentLogStatus($status)
  {
    $out="";
    if($status == 0) $out="New";
    if($status == 10) $out="Completed";
    if($status == 20) $out="Accepted";
    return $out;
  }
  public static function getIncidentEvents($id)
  {
    $results = IncidentEvent::where('incident_id',$id)->where('typ','CATEGORY')->get();
    $lstEvents=array();
    $a=array();
    foreach($results as $row)
    {
      $a[] = LibIncidents::getEventName($row->event_id);
    }
    return $a;
  }
  public static function getIncidentNotifications($id)
  {
    $results = IncidentEvent::join('category','category.id','incident_event.event_id')
                ->where('incident_id',$id)->where('incident_event.typ','EVENTS')->select('category.name')->get();
    $a=array();
    foreach($results as $row)
    {
      $a[] = $row->name; 
    }
    return $results;
  }
  public static function getIncidentDetails($id)
  {
    $results = IncidentDetails::join('category','category.id','incident_details.field_id')
                    ->where('incident_id',$id)->select('category.name','incident_details.details')
                    ->orderBy('category.ord')->get();
    return $results;
  }
  public static function getEventName($id)
  {
    $name="";
    $cnt = IncidentCategory::where('id',$id)->count();
    if($cnt > 0){
      $r = IncidentCategory::where('id',$id)->first();
      $name = $r->caption;
      $xname = LibIncidents::getEventName($r->parent);
      //if($name != "") $name .= " > ".$name;
      if($xname != "") $name = $xname. " > ".$name;
    }
    return $name;
  }
  public static function getLogsForIncident($id)
  {
    $lstLogs=IncidentTasks::where('parent_id',$id)->orderBy('assign_date','desc')->get();
    $lstLogsdata=array();
    foreach($lstLogs as $row):
        $l=array();
        $l['id'] = $row->parent_id;
        $l['task_id'] = $row->id;
        $l['userName'] = Users::getName($row->assign_to);
        $l['fCreatedAt'] = date('d/m/Y H:i',strtotime($row->assign_date));
        $l['fClosedDate'] = "";
        $l['timeicon'] = "o_edit";
        $l['fApprovedDate'] = "";
        if($row->status > 0){
            $l['fClosedDate'] = "Completed On: ".date('d/m/Y H:i',strtotime($row->closed_date));
            $l['timeicon'] = "o_check";
        }
        if($row->status == 20){
            $l['fApprovedDate'] = "Approved On: ".date('d/m/Y H:i',strtotime($row->approved_date));
            $l['timeicon'] = "o_check";
        }
        $l['status'] = $row->status;
        $l['statusName'] = LibIncidents::getIncidentLogStatus($row->status);
        $l['assigned_notes'] = $row->assigned_notes;
        $l['comments'] = $row->user_comments;
        array_push($lstLogsdata,$l);
        
    endforeach;
    return $lstLogsdata;
  }

  
}
