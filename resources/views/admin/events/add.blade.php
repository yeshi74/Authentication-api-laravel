<?php
    use App\Helpers\ApolloHelpers;
?>
@extends('layouts/contentLayoutMaster')
@section('title', 'Events')
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
  {!! Helper::form(array("name"=>"frm","action"=>"admin/events/save","validate"=>"Yes")) !!}
  {!! Helper::hidden(array("name"=>"action","value"=>"save")) !!}
  {!! Helper::hidden(array("name"=>"id","value"=>"")) !!}
  {!! Helper::button(array("colspan"=>12,"name"=>"btnUpdate","class"=>"btn btn-primary btnAction","label"=>"Save Event","type"=>"submit"))!!}

  <div class="row">
    {!! Helper::textbox(array("colspan"=>8,"label"=>"Event Name","name"=>"name","max"=>150,"placeholder"=>"Enter Event Name","class"=>"validate[required]","value"=>old('name'),"required"=>"Yes"))!!}
    {!! Helper::selectList(array("colspan"=>4,"label"=>"Category","name"=>"category","options"=>$getCategory,"value"=>old('category'),"key"=>"id","val"=>"name"))!!}
  </div>

  <div class="row">
    {!! Helper::textbox(array("colspan"=>3,"label"=>"From Date","name"=>"from_date","placeholder"=>"Enter From Date","class"=>"validate[required]","required"=>"Yes","typ"=>"date","value"=>old('from_date')))!!}       
    {!! Helper::textbox(array("colspan"=>3,"label"=>"To Date","name"=>"to_date","placeholder"=>"Enter To Date","class"=>"validate[required]","required"=>"Yes","typ"=>"date","value"=>old('to_date')))!!}       
    
    {!! Helper::textbox(array("colspan"=>3,"label"=>"Remind Date","name"=>"remind_date","placeholder"=>"Enter Remind Date","class"=>"validate[required]","required"=>"Yes","typ"=>"date","value"=>old('remind_date')))!!}
    {!! Helper::selectStatus(array("colspan"=>3,"label"=>"Status","name"=>"status","value"=>old('status')))!!}
  </div>

  <div class="row">
    {!! Helper::selectList(array("colspan"=>3,"label"=>"Author","name"=>"author","options"=>$getAuthor,"value"=>old('author'),"key"=>"id","val"=>"name"))!!}
    {!! Helper::select(array("colspan"=>3,"options"=>array("0"=>"No","1"=>"Yes"),"label"=>"Is Public","name"=>"is_public","value"=>old('is_public'))) !!}
    {!! Helper::textbox(array("colspan"=>6,"label"=>"Location","name"=>"location","value"=>old('location')))!!}
    
  </div>
  
  
  <div class="accordion" id="accView">
    {!! Helper::accordion(array("id"=>"c0","parent"=>"accView","label"=>"Cover Image"))!!}
   {!! Helper::textbox(array("colspan"=>6,"label"=>"Cover Image","name"=>"cover_img","class"=>"validate[required]","required"=>"Yes","typ"=>"FILE")) !!}
    {!! Helper::closeAccordion() !!}
    {!! Helper::accordion(array("id"=>"c1","parent"=>"accView","label"=>"Summary"))!!}
    {!! Helper::textbox(array("colspan"=>12,"label"=>"Summary","name"=>"summary","placeholder"=>"Enter Summary","class"=>"validate[required]","typ"=>"HTML","value"=>old('summary')))!!}
    {!! Helper::closeAccordion() !!}
    {!! Helper::accordion(array("id"=>"c2","parent"=>"accView","label"=>"Locations"))!!}
    <?php echo ApolloHelpers::locationTree(array("name"=>"locations","mode"=>"ADD","selLocations"=>array())); ?>
    {!! Helper::close("form")!!}
    {!! Helper::closeAccordion() !!}
  </div>

  {!! Helper::close("form")!!}
  {!! Helper::closePage() !!}
@endsection

@section('myscript')
<script>
var imgSize=0;
var maxFileLimit = 2 * 1024 * 1024; //2MB Max Size
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