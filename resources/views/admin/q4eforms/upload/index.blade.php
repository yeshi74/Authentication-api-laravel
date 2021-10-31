@extends('layouts/contentLayoutMaster')
@section('mystyle')
@endsection
@section('title', 'Q4E Forms')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    @include('admin/q4eforms/upload/formview')
    {!!Helper::form(array("name"=>"frm","action"=>"admin/q4eforms/".$ftype."/upload/step2","validate"=>"Yes"))!!}
    {!!Helper::hidden(array("name"=>"ftype","value"=>$ftype))!!}
    {!!Helper::hidden(array("name"=>"id","value"=>$id))!!}
    <div class="row">
        <div class="col-md-12">
            <label>Select CSV File for uploading data</label>
            <input type="file" name="csv_file" id="csv_file" class="form-control validate[required]"/>
        </div>
    </div>
    {!!Helper::button(array("colspan"=>12,"name"=>"btnSave","label"=>"Next >>","type"=>"submit"))!!}
    {!!Helper::close("form")!!}
    {!! Helper::closePage()!!}
@endsection
@section('myscript')
<script>

</script>
@endsection