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
    {!!Helper::form(array("name"=>"frm","action"=>"admin/contacts/update","validate"=>"Yes"))!!}
    {!!Helper::hidden(array("name"=>"action","value"=>"update"))!!}
    {!!Helper::hidden(array("name"=>"id","value"=>$id))!!}
    {!!Helper::button(array("colspan"=>12,"name"=>"btnUpdate","label"=>"Update","type"=>"submit"))!!}

    <div class="row">
        {!!Helper::textbox(array("colspan"=>4,"label"=>"Name","name"=>"name","max"=>150,"value"=>$results['name'],"class"=>"validate[required]"))!!}
        {!!Helper::display(array("colspan"=>4,"label"=>"Email","name"=>"email","max"=>150,"class"=>"validate[required,custom[email]]","required"=>"Y","value"=>$results['email']))!!}
        {!!Helper::textbox(array("colspan"=>4,"label"=>"Mobile","name"=>"mobile","value"=>$results['mobile'],"class"=>"validate[required,custom[number]]"))!!}
    </div>

    <div class="row">    
        {!!Helper::textbox(array("colspan"=>4,"label"=>"Designation","name"=>"designation","max"=>150,"value"=>$results['designation'],"class"=>"validate[required]"))!!}
        {!!Helper::selectStatus(array("colspan"=>4,"label"=>"Status","name"=>"status","class"=>"validate[required]","required"=>"Y","value"=>$results['status']))!!}
    </div>

    <div class="row">
        {!! Helper::attachment(array("colspan"=>4,"label"=>"Existing Profile","id"=>$results['id'],"module"=>"CONTACTS","value"=>$results['profile'])) !!}
        {!!Helper::textbox(array("colspan"=>8,"label"=>"Profile","name"=>"profile","typ"=>"FILE"))!!}
    </div>
  

    <legend>Choose Locations</legend>
    <?php echo ApolloHelpers::locationTree(array("name"=>"locations","mode"=>"EDIT","selLocations"=>$lstLocations,"selRoles"=>$lstRoles)); ?>
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

