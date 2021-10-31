<?php
    use App\Helpers\ApolloHelpers;
?>
@extends('layouts/contentLayoutMaster')
@section('title', 'Training')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>"")) !!}
  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
    </ul>
  </div><br />
  @endif
  {!! Helper::form(array("name"=>"frm","action"=>"admin/training/save","validate"=>"Yes")) !!}
  {!! Helper::hidden(array("name"=>"action","value"=>"save")) !!}
  {!! Helper::hidden(array("name"=>"id","value"=>"")) !!}
  {!! Helper::button(array("colspan"=>12,"name"=>"btnUpdate","class"=>"btn btn-primary btnAction","label"=>"Save","type"=>"submit"))!!}
  {!! Helper::textbox(array("colspan"=>12,"label"=>"Subject","name"=>"subject","max"=>150,"placeholder"=>"Enter Subject","class"=>"validate[required]","required"=>"Yes","value"=>old('subject')))!!}
  
  <div class="row">
    {!! Helper::dateTimePicker(array("colspan"=>6,"label"=>"Training Start Date","name"=>"training_date","placeholder"=>"Enter Training Start Date","required"=>"Yes","class"=>"validate[required]","value"=>old('training_date'),"hname"=>"training_date_hh","hvalue"=>old('training_date_hh'),"mname"=>"training_date_mm","mvalue"=>old('training_date_mm'))) !!}
    {!! Helper::dateTimePicker(array("colspan"=>6,"label"=>"Training End Date","name"=>"training_edate","placeholder"=>"Enter Training End Date","required"=>"Yes","class"=>"validate[required]","value"=>old('training_edate'),"hname"=>"training_edate_hh","hvalue"=>old('training_edate_hh'),"mname"=>"training_edate_mm","mvalue"=>old('training_edate_mm'))) !!}
  </div>
   
    {{-- {!! Helper::textbox(array("colspan"=>4,"label"=>"Attachment","name"=>"attachment","placeholder"=>"Choose File","required"=>"Yes","class"=>"validate[required]","typ"=>"FILE","value"=>old('attachment'))) !!} --}}
  
  <div class="row">
    {!! Helper::selectList(array("colspan"=>3,"label"=>"Category","name"=>"category","options"=>$getCategory,"value"=>old('category'),"key"=>"id","val"=>"name"))!!}
     {!! Helper::selectStatus(array("colspan"=>3,"label"=>"Status","name"=>"status","value"=>old('status'))) !!}
     {!! Helper::selectList(array("colspan"=>3,"label"=>"Training Mode","name"=>"mode","options"=>$lstMode,"value"=>old('mode'),"key"=>"id","val"=>"name"))!!}
     {!! Helper::select(array("colspan"=>3,"options"=>array("0"=>"No","1"=>"Yes"),"label"=>"Is Public","name"=>"is_public","value"=>old('is_public'))) !!}

    </div>
  {!! Helper::textbox(array("colspan"=>12,"label"=>"Location","name"=>"location","class"=>"validate[required]","value"=>old('location')))!!}
  <div class="row">
    {!! Helper::selectList(array("colspan"=>6,"label"=>"Before Evaluation","name"=>"before_survey","options"=>$getSurvey,"value"=>old('before_survey'),"key"=>"id","val"=>"name","blank"=>"Yes"))!!}
    {!! Helper::selectList(array("colspan"=>6,"label"=>"After Evaluation","name"=>"after_survey","options"=>$getSurvey,"value"=>old('after_survey'),"key"=>"id","val"=>"name","blank"=>"Yes"))!!}
  </div>
  {!! Helper::textbox(array("colspan"=>12,"label"=>"URL, if online training","name"=>"url","value"=>old('url')))!!}
  {!! Helper::textbox(array("colspan"=>12,"label"=>"Summary","name"=>"summary","class"=>"validate[required]","typ"=>"TEXTAREA","value"=>old('summary')))!!}
{!! Helper::textbox(array("colspan"=>12,"label"=>"Details","name"=>"details","class"=>"validate[required]","typ"=>"HTML","value"=>old('details')))!!}
  <legend>Choose Locations</legend>
  <?php echo ApolloHelpers::locationTree(array("name"=>"locations","mode"=>"ADD","selLocations"=>array(),"selRoles"=>array())); ?>
    
  {!! Helper::close("form")!!}
  {!! Helper::closePage() !!}
@endsection
@section('myscript')
<script>
var imgSize=0;
var maxFileLimit = 8 * 1024 * 1024; //2MB Max Size
$('#attachment').bind('change', function() {
  imgSize = this.files[0].size;
});
$("#frm").submit(function(event){
  if(imgSize > maxFileLimit)
  {
    alert("Invalid Attachment file Size");
    event.preventDefault();  
  }
  return;
});
</script>
@endsection