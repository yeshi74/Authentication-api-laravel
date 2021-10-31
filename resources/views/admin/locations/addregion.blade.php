@extends('layouts/contentLayoutMaster')
@section('title', 'Locations')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    {!!Helper::form(array("name"=>"frm","action"=>"admin/locations/save","validate"=>"Yes"))!!}
    {!!Helper::hidden(array("name"=>"action","value"=>"save"))!!}
    {!!Helper::hidden(array("name"=>"typ","value"=>"REGION"))!!}
    {!!Helper::button(array("colspan"=>12,"name"=>"btnSave","label"=>"Save","type"=>"submit"))!!}
       
        <div class="row">
            {!! Helper::textbox(array("colspan"=>6,"label"=>"Name","name"=>"name","max"=>150,"placeholder"=>"Enter Name","required"=>"Yes","class"=>"validate[required]")) !!}
            {!!Helper::selectList(array("colspan"=>6,"label"=>"Parent","name"=>"parent","options"=>$getParentCat,"value"=>"","key"=>"id","val"=>"name"))!!}
        </div>
    {!!Helper::close("form")!!}
    {!! Helper::closePage()!!}
@endsection
