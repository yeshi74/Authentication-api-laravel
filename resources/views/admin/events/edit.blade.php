<?php
    use App\Helpers\ApolloHelpers;
?>
@extends('layouts/contentLayoutMaster')
@section('title', 'Events')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>""))!!}
  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
  </div><br />
  @endif
  {!! Helper::form(array("name"=>"frm","action"=>"admin/events/update","validate"=>"Yes"))!!}
  {!! Helper::hidden(array("name"=>"action","value"=>"update"))!!}
  {!! Helper::hidden(array("name"=>"id","value"=>$id))!!}
  {!! Helper::button(array("colspan"=>12,"name"=>"btnUpdate","label"=>"Update","type"=>"button")) !!}

  <div class="row">
    {!! Helper::textbox(array("colspan"=>8,"label"=>"Event Name","name"=>"name","max"=>150,"placeholder"=>"Enter Event Name","class"=>"validate['required']","value"=>$results['name'],"required"=>"Yes",))!!}
    {!! Helper::selectList(array("colspan"=>4,"label"=>"Category","name"=>"category","options"=>$getCategory,"key"=>"id","val"=>"name","value"=>$results['category']))!!}
  </div> 

  <div class="row">
    {!! Helper::textbox(array("colspan"=>3,"label"=>"From Date","name"=>"from_date","placeholder"=>"Enter From Date","class"=>"validate[required]","required"=>"Yes","typ"=>"date",'value'=>$results['from_date']))!!}
    {!! Helper::textbox(array("colspan"=>3,"label"=>"To Date","name"=>"to_date","placeholder"=>"Enter To Date","class"=>"validate[required]","required"=>"Yes","typ"=>"date","value"=>$results['to_date']))!!}
    {!! Helper::textbox(array("colspan"=>3,"label"=>"Remind Date","name"=>"remind_date","placeholder"=>"Enter Remind Date","class"=>"validate[required]","required"=>"Yes","typ"=>"date","value"=>$results['remind_date']))!!}
    {!! Helper::selectStatus(array("colspan"=>3,"label"=>"Status","name"=>"status","value"=>$results['status']))!!}
  </div>
  
  <div class="row">
    {!! Helper::selectList(array("colspan"=>3,"label"=>"Author","name"=>"author","options"=>$getAuthor,"key"=>"id","val"=>"name","value"=>$results['author']))!!}
    {!! Helper::select(array("colspan"=>3,"options"=>array("0"=>"No","1"=>"Yes"),"label"=>"Is Public","name"=>"is_public","value"=>$results['is_public'])) !!}
    {!! Helper::textbox(array("colspan"=>6,"label"=>"Location","name"=>"location","value"=>$results['location']))!!}
  </div>
  
  <div class="accordion" id="accView">
    {!! Helper::accordion(array("id"=>"c0","parent"=>"accView","label"=>"Cover Image"))!!}
    {!! Helper::attachment(array("colspan"=>12,"label"=>"Existing Cover Image","id"=>$results['id'],"module"=>"EVENTS_COVER","value"=>$results['cover_img'])) !!}
    {!! Helper::textbox(array("colspan"=>12,"label"=>"Cover Image","name"=>"cover_img","typ"=>"FILE"))!!}
    {!! Helper::closeAccordion() !!}
    {!! Helper::accordion(array("id"=>"c1","parent"=>"accView","label"=>"Summary"))!!}
    {!! Helper::textbox(array("colspan"=>12,"label"=>"Summary","name"=>"summary","max"=>150,"placeholder"=>"Enter Summary","class"=>"validate[required]","typ"=>"HTML","value"=>$results['summary']))!!}
    {!! Helper::closeAccordion() !!}
    {!! Helper::accordion(array("id"=>"c2","parent"=>"accView","label"=>"Locations"))!!}
    <?php echo ApolloHelpers::locationTree(array("name"=>"locations","mode"=>"EDIT","selLocations"=>$lstLocations,"selRoles"=>$lstRoles)); ?>
    {!! Helper::close("form")!!}
    {!! Helper::closeAccordion() !!}
    {!! Helper::accordion(array("id"=>"c2a","parent"=>"accView","label"=>"Users"))!!}
    {!! Helper::linkButton(array("label"=>"Edit Users","url"=>url('admin/events/editusers/'.$id),"name"=>"btnEdit","class"=>"btn btn-primary")) !!}
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
    {!! Helper::gallery(array("module"=>"EVENTS","id"=>$id,"mode"=>"EDIT"))!!}
    {!! Helper::closeAccordion() !!}
  </div>
  
   
  {!! Helper::closePage() !!}
@endsection

@section('myscript')
<script>
   $("#btnUpdate").on('click',function()
  {
    $("#frm").submit();
  });
  var imgSize=0;
  var maxFileLimit = 2 * 1024 * 1024; //2MB Max Size
  var imgSize1 = 0;
  $('#cover_img').bind('change', function() {
    imgSize = this.files[0].size;
  });
  $("#frm").submit(function(event){
    if(imgSize > maxFileLimit)
    {
      alert("Invalid Cover Image Size");
      event.preventDefault();  
    }
    return;
  });
</script>
@endsection