@extends('layouts/contentLayoutMaster')
@section('title', 'Forms & Surveys')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    {!!Helper::form(array("name"=>"frm","action"=>"admin/q4eforms/search","validate"=>"Yes"))!!}
    {!!Helper::hidden(array("name"=>"code","value"=>$code))!!}
    {!!Helper::hidden(array("name"=>"action","value"=>""))!!}
    
    {!! Helper::close("form")!!}
    {!! Helper::closePage()!!}
@endsection
@section('myscript')
<script>
    $("#btnReport").on('click',function(){
        $("#action").val("REPORT");
        $("#frm").submit();
    })
</script>
@endsection
