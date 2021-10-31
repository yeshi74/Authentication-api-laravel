<?php
    use App\Helpers\ApolloHelpers;
?>
@extends('layouts/contentLayoutMaster')
@section('title', 'Contacts')
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
    {!!Helper::form(array("name"=>"frm","action"=>"admin/contacts/save","validate"=>"Yes"))!!}
    {!!Helper::hidden(array("name"=>"action","value"=>"save"))!!}
    {!!Helper::button(array("colspan"=>12,"name"=>"btnSave","label"=>"Save","type"=>"submit"))!!}
   
    <div class="row">
        {!! Helper::textbox(array("colspan"=>4,"label"=>"Name","name"=>"name","max"=>150,"placeholder"=>"Enter name","required"=>"Yes","class"=>"validate[required]","value"=>old('name'))) !!}
        {!! Helper::textbox(array("colspan"=>4,"label"=>"Email","name"=>"email","max"=>150,"placeholder"=>"Enter Email","required"=>"Yes","class"=>"validate[required,custom[email]]","value"=>old('email'))) !!}
        {!! Helper::textbox(array("colspan"=>4,"label"=>"Mobile Number","name"=>"mobile","placeholder"=>"Enter Mobile Number","required"=>"Yes","class"=>"validate[required,custom[number]]","value"=>old('mobile'))) !!}
    </div> 

    <div class="row">
        {!! Helper::textbox(array("colspan"=>4,"label"=>"Desgination","name"=>"designation","max"=>150,"placeholder"=>"Enter Designation","required"=>"Yes","class"=>"validate[required]","value"=>old('designation'))) !!}
        {!!Helper::selectStatus(array("colspan"=>4,"label"=>"Status","name"=>"status","value"=>old('status')))!!}
        {!! Helper::textbox(array("colspan"=>4,"label"=>"Profile","name"=>"profile","placeholder"=>"Enter Profile","required"=>"Yes","class"=>"validate[required]","typ"=>"FILE")) !!}
    </div>

    <legend>Choose Locations</legend>
    <?php //echo ApolloHelpers::locationTree(array("name"=>"locations","mode"=>"ADD","selLocations"=>array(21,51))); ?>
    <?php echo ApolloHelpers::locationTree(array("name"=>"locations","mode"=>"ADD","selLocations"=>array(),"selRoles"=>array())); ?>
    

    {!!Helper::close("form")!!}
    {!! Helper::closePage()!!}
@endsection
@section('myscript')
<script type="text/javascript">
    var imgSize=0;
    var maxFileLimit = 2 * 1024 * 1024; //2MB Max Size
    $('#profile').bind('change', function() {
        imgSize = this.files[0].size;
    });
    $("#frm").submit(function(event){
        if(imgSize > maxFileLimit)
        {
            alert("Invalid Image Size");
            event.preventDefault();  
        }
        return;
    });
    
</script>
@endsection


