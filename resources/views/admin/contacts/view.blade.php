<?php
    use App\Helpers\ApolloHelpers;
?>
@extends('layouts/contentLayoutMaster')
@section('title', 'Contacts')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    {!!Helper::form(array("name"=>"frm","action"=>"admin/contacts/edit","validate"=>"Yes"))!!}
    {!!Helper::hidden(array("name"=>"action","value"=>"edit"))!!}
    {!!Helper::hidden(array("name"=>"bu", "value"=>""))!!}
    {!!Helper::hidden(array("name"=>"region","value"=>""))!!}
    {!!Helper::hidden(array("name"=>"location","value"=>""))!!}
    {!!Helper::hidden(array("name"=>"id","value"=>$id))!!}

    <div class="row">
        <div class="col-md-12">
            {!! Helper::linkButton(array("url"=>url('admin/contacts/edit/'.$id),"btnEdit","label"=>"Edit","type"=>"submit","class"=>"btn btn-primary"))!!}
            {!!Helper::button(array("name"=>"btnDelete","label"=>"Delete","type"=>"button","class"=>"btnAction btn-danger","data"=>array("action"=>"delete")))!!}
        </div>
    </div>
        
    <div class="row">
        {!!Helper::display(array("colspan"=>4,"label"=>"Name","name"=>"name","value"=>$results['name']))!!}
        {!!Helper::display(array("colspan"=>4,"name"=>"email","label"=>"Email","value"=>$results['email'],"required"=>"Y","class"=>"validate[required]"))!!}
        {!!Helper::display(array("colspan"=>4,"label"=>"Mobile","name"=>"mobile","value"=>$results['mobile']))!!}
    </div>

    <div class="row">
        {!!Helper::display(array("colspan"=>4,"label"=>"Designation","value"=>$results['designation']))!!}
        <?php $status = $results['status'] == 0 ? "Active" : "Suspend"; ?>
        {!!Helper::display(array("colspan"=>4,"name"=>"status","label"=>"Status","value"=>$status))!!}
    </div>

    <div class="row">
        {!! Helper::attachment(array("colspan"=>4,"label"=>"Profile","id"=>$results['id'],"module"=>"CONTACTS","value"=>$results['profile'])) !!}
    </div>
    
    <legend>Locations</legend>
    <?php echo ApolloHelpers::locationTree(array("name"=>"locations","mode"=>"VIEW","selLocations"=>$lstLocations,"selRoles"=>$lstRoles)); ?>
    {!!Helper::close("form")!!}
    {!! Helper::closePage()!!}
@endsection
@section('myscript')
<script>
    var url = "{{url('admin/contacts/')}}";
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


