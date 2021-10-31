<?php
    use App\Helpers\ApolloHelpers;
?>
@extends('layouts/contentLayoutMaster')
@section('title', 'Events')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
  {!! Helper::form(array("name"=>"frm","action"=>"admin/events/edit","validate"=>"Yes")) !!}
  {!! Helper::hidden(array("name"=>"action","value"=>"edit")) !!}
  {!! Helper::hidden(array("name"=>"id","value"=>$id))!!}
  <?php 
    $status = ($results['status'] == 0 ? "Active" : "Suspend");
  ?>
  <div class="row">
    <div class="col-md-10">
      {!! Helper::linkButton(array("label"=>"Edit","url"=>url('admin/events/edit/'.$id),"name"=>"btnEdit","class"=>"btn btn-primary","data"=>array("action"=>"edit"))) !!}
      {!! Helper::button(array("label"=>"Delete","name"=>"btnDelete","type"=>"button","class"=>"btnAction btn btn-danger","data"=>array("action"=>"delete"))) !!}
    </div>
    <div class="col-md-2">
      <h4>{{$status}}</h4>
    </div>
  </div>

  <div class="row">
    {!! Helper::display(array("colspan"=>8,"label"=>"Event Name","name"=>"name","value"=>$results['name'])) !!}
    {!! Helper::display(array("colspan"=>4,"label"=>"Category","value"=>$results['categoryname'])) !!}
  </div>
  <div class="row">
    <?php  
       
      $fromDate=date('d/m/Y',strtotime($results['from_date'])); 
      $toDate=date('d/m/Y',strtotime($results['to_date']));
      
      if(($results['remind_date'])=='')
      {
        $RemindDate='';
      }
      else {
        $RemindDate=date('d/m/Y',strtotime($results['remind_date']));
      }
    ?>
    {!! Helper::display(array("colspan"=>3,"label"=>"From Date","value"=>$fromDate)) !!}
    {!! Helper::display(array("colspan"=>3,"label"=>"To Date","value"=>$toDate)) !!}
    {!! Helper::display(array("colspan"=>3,"label"=>"Remind Date","value"=>$RemindDate)) !!}
    {!! Helper::display(array("colspan"=>3,"label"=>"Is Public","value"=>$results['is_public'] == 1 ? "Yes" : "No")) !!}
  </div>

  <div class="row">
    {!! Helper::userDetails(array("colspan"=>6,"label"=>"Author","name"=>"author","value"=>$results['author'])) !!}
    {!! Helper::display(array("colspan"=>6,"label"=>"Location","name"=>"location","value"=>$results['location'])) !!}</div>
  <br/>
  <div class="accordion" id="accView">
    {!! Helper::accordion(array("id"=>"c0","parent"=>"accView","label"=>"Cover Image"))!!}
    {!! Helper::attachment(array("colspan"=>6,"label"=>"Cover Image","id"=>$results['id'],"module"=>"EVENTS_COVER","value"=>$results['cover_img'])) !!}
    {!! Helper::closeAccordion() !!}
    {!! Helper::accordion(array("id"=>"c1","parent"=>"accView","label"=>"Summary"))!!}
    {!! $results['summary'] !!}
    {!! Helper::closeAccordion() !!}
    {!! Helper::accordion(array("id"=>"c2","parent"=>"accView","label"=>"Locations"))!!}
    <?php echo ApolloHelpers::locationTree(array("name"=>"locations","mode"=>"VIEW","selLocations"=>$lstLocations,"selRoles"=>$lstRoles)); ?>
    {!! Helper::closeAccordion() !!}
    {!! Helper::accordion(array("id"=>"c3","parent"=>"accView","label"=>"Users Attending"))!!}
      {!! Helper::responsiveTable(array("Name","Emp. Code","Location"))!!}
      @foreach($lstUsers as $row)
        <tr>
          <td>{!!$row['name']!!}</td>
          <td>{!!$row['empcode']!!}</td>
          <td>{!!$row['location']!!}</td>
        </tr>
      @endforeach
      {!! Helper::closeResponsiveTable()!!}
    {!! Helper::closeAccordion() !!}   
    {!! Helper::accordion(array("id"=>"c4","parent"=>"accView","label"=>"Documents"))!!}
    {!! Helper::gallery(array("module"=>"EVENTS","id"=>$id,"mode"=>"VIEW")) !!}
    {!! Helper::closeAccordion() !!}
  </div>


   
  
  
  {!! Helper::close("form")!!}
  {!! Helper::closePage() !!}
@endsection

@section('myscript')
<script>
  var url = "{{url('admin/events/')}}";
  $("#btnEdit").on('click',function(){
    var refid=$("#id").val();
    location.href = url + "/edit/"+refid;
  });

 $(".btnAction").on('click',function(){
    var action = $(this).data("action");
    $("#action").val(action);
    if(confirm("Are you sure you want to perform this action?"))
    {
      var pURL = url + "/" + action;
      $('#frm').attr('action', pURL).submit();
    }
  });
</script>
@endsection