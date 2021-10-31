<?php
    use App\Helpers\ApolloHelpers;
?>
@extends('layouts/contentLayoutMaster')
@section('title', 'Agent Details')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    {!!Helper::form(array("name"=>"frm","action"=>"admin/contacts/edit","validate"=>"Yes"))!!}
    {!!Helper::hidden(array("name"=>"action","value"=>"edit"))!!}
    {!!Helper::hidden(array("name"=>"bu", "value"=>""))!!}
    {!!Helper::hidden(array("name"=>"region","value"=>""))!!}
    {!!Helper::hidden(array("name"=>"location","value"=>""))!!}
    <div class="row">
        <a class="btn btn-primary" href="{{ route('agent.edit', $agent->id) }}" role="button">Edit</a>
      </div><br><br>
        
    <div class="row">
        {!!Helper::display(array("colspan"=>4,"label"=>"Name","name"=>"name","value"=>$agent['name']))!!}
        {!!Helper::display(array("colspan"=>4,"name"=>"email","label"=>"Email","value"=>$agent['email'],"required"=>"Y","class"=>"validate[required]"))!!}
        {!!Helper::display(array("colspan"=>4,"label"=>"City","name"=>"city","value"=>$agent['city']))!!}
        {!!Helper::display(array("colspan"=>4,"label"=>"State","name"=>"state","value"=>$agent['state']))!!}
    </div>
    
   
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


