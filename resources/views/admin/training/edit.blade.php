<?php
    use App\Helpers\ApolloHelpers;
?>
@extends('layouts/contentLayoutMaster')
@section('title', 'Training')
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
  {!! Helper::form(array("name"=>"frm","action"=>"admin/training/update","validate"=>"Yes"))!!}
  {!! Helper::hidden(array("name"=>"action","value"=>"update"))!!}
  {!! Helper::hidden(array("name"=>"id","value"=>$id))!!}
  {!! Helper::button(array("colspan"=>12,"name"=>"btnUpdate","label"=>"Update","type"=>"button")) !!}
  {!! Helper::textbox(array("colspan"=>12,"label"=>"Subject","name"=>"subject","max"=>150,"class"=>"validate[required]","value"=>$results['subject'],"required"=>"Y"))!!}
  <div class="row">
    {!! Helper::dateTimePicker(array("colspan"=>6,"label"=>"Training Start Date","name"=>"training_date","placeholder"=>"enter Training Start Date","required"=>"Yes","class"=>"validate[required]","value"=>date('Y-m-d',strtotime($results['training_date'])),"hname"=>"training_date_hh","hvalue"=>date('H',strtotime($results['training_date'])),"mname"=>"training_date_mm","mvalue"=>date('i',strtotime($results['training_date'])))) !!}
    {!! Helper::dateTimePicker(array("colspan"=>6,"label"=>"Training End Date","name"=>"training_edate","placeholder"=>"Enter Training End Date","required"=>"Yes","class"=>"validate[required]","value"=>date('Y-m-d',strtotime($results['training_edate'])),"hname"=>"training_edate_hh","hvalue"=>date('H',strtotime($results['training_edate'])),"mname"=>"training_edate_mm","mvalue"=>date('i',strtotime($results['training_edate'])))) !!}
  </div>
  
  <div class="row">
    {!! Helper::selectList(array("colspan"=>3,"label"=>"Category","name"=>"category","options"=>$getCategory,"value"=>$results['category'],"key"=>"id","val"=>"name"))!!}
    {!! Helper::selectStatus(array("colspan"=>3,"label"=>"Status","name"=>"status","value"=>$results['status'])) !!}
    {!! Helper::selectList(array("colspan"=>3,"label"=>"Mode","name"=>"mode","options"=>$lstMode,"value"=>$results['mode'],"key"=>"id","val"=>"name"))!!}
    {!! Helper::select(array("colspan"=>3,"options"=>array("0"=>"No","1"=>"Yes"),"label"=>"Is Public","name"=>"is_public","value"=>$results['is_public'])) !!}

  </div>
  {!! Helper::textbox(array("colspan"=>12,"label"=>"Location","name"=>"location","class"=>"validate[required]","value"=>$results['location']))!!}
  <div class="row">
    {!! Helper::selectList(array("colspan"=>6,"label"=>"Before Evaluation","name"=>"before_survey","options"=>$getSurvey,"value"=>$results['before_survey'],"key"=>"id","val"=>"name","blank"=>"Yes"))!!}
    {!! Helper::selectList(array("colspan"=>6,"label"=>"After Evaluation","name"=>"after_survey","options"=>$getSurvey,"value"=>$results['after_survey'],"key"=>"id","val"=>"name","blank"=>"Yes"))!!}
  </div>
  
  {!! Helper::textbox(array("colspan"=>12,"label"=>"URL, if online training","name"=>"url","value"=>$results['url'],"value"=>old('url')))!!}
  {!! Helper::textbox(array("colspan"=>12,"label"=>"Summary","name"=>"summary","class"=>"validate[required]","typ"=>"TEXTAREA","value"=>$results['summary']))!!}
  <div class="accordion" id="accView">
    {!! Helper::accordion(array("id"=>"c0","parent"=>"accView","label"=>"Details")) !!}
      {!! Helper::textbox(array("colspan"=>12,"label"=>"Details","name"=>"details","class"=>"validate[required]","typ"=>"HTML","value"=>$results['details']))!!}
    {!! Helper::closeAccordion() !!}
    {!! Helper::accordion(array("id"=>"c1","parent"=>"accView","label"=>"Locations")) !!}
      <?php echo ApolloHelpers::locationTree(array("name"=>"locations","mode"=>"EDIT","selLocations"=>$lstLocations,"selRoles"=>$lstRoles)); ?>
    {!! Helper::closeAccordion() !!}
    {!! Helper::accordion(array("id"=>"c2","parent"=>"accView","label"=>"Users")) !!}
    <a href="{{url('admin/training/users/'.$id)}}" class="btn btn-primary">Manage Users</a><br><br>
      {!! Helper::responsiveTable(array("User","Status","Start Date","Last Attended","Completed On","Before Survey Points","After Survey Points"))!!}
      @foreach($lstUsers as $row)
        <tr>
          <td>{{$row['userName']}}</td>
          <td>{{$row['statusName']}}</td>
          <td>{{$row['start_date']}}</td>
          <td>{{$row['last_attend']}}</td>
          <td>{{$row['complete_date']}}</td>
          <td>{{$row['before_points']}}</td>
          <td>{{$row['after_points']}}</td>
        </tr>
      @endforeach
      {!! Helper::closeResponsiveTable() !!}
    {!! Helper::closeAccordion() !!}
    {!! Helper::close("form")!!}
    {!! Helper::accordion(array("id"=>"c3","parent"=>"accView","label"=>"Documents")) !!}
    {!! Helper::gallery(array("module"=>"TRAINING","id"=>$id,"mode"=>"EDIT"))!!}
    {!! Helper::close("form")!!}
    {!! Helper::closePage() !!}
 
@endsection

@section('myscript')
<script>
   $("#btnUpdate").on('click',function()
   {
     $("#frm").submit();
   });
  var imgSize=0;
  var maxFileLimit = 8 * 1024 * 1024; //2MB Max Size
  $('#attachment').bind('change', function() {
    imgSize = this.files[0].size;
  });
  
  $("#frm").submit(function(event){
    if(imgSize > maxFileLimit)
    {
      alert("Invalid Attachment File Size");
      event.preventDefault();  
    }
    return;
  });
</script>
@endsection
