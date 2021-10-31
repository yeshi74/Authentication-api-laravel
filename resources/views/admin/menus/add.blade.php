@extends('layouts/contentLayoutMaster')
@section('title', 'Menus')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    {!! Helper::form(array("name"=>"frm","action"=>"admin/menus/save","validate"=>"Yes"))!!}
    {!! Helper::hidden(array("name"=>"action","value"=>"save"))!!}
    {!! Helper::button(array("colspan"=>12,"name"=>"btnSave","label"=>"Save","type"=>"submit"))!!}
    <section id="column-selectors">
        <div class="row">
            {!! Helper::textbox(array("colspan"=>4,"label"=>"Name","name"=>"name","placeholder"=>"Enter Name","required"=>"Yes","class"=>"validate[required]","max"=>150,"value"=>old('name'))) !!}
            {!! Helper::textbox(array("colspan"=>4,"label"=>"Icon","name"=>"icon","placeholder"=>"Enter Icon","class"=>"validate[required]","required"=>"Y","max"=>45,"value"=>old('icon')))!!}
            {!! Helper::textbox(array("colspan"=>4,"label"=>"Route","name"=>"route","placeholder"=>"Enter Route","class"=>"validate[required]","required"=>"Y","max"=>150,"value"=>old('route')))!!}
        </div>
        <div class="class row">
            {!! Helper::textbox(array("colspan"=>3,"label"=>"Ord","name"=>"ord","placeholder"=>"Enter Order","required"=>"Yes","class"=>"validate[required,custom[number]]","value"=>old('ord'))) !!}
            {!! Helper::selectStatus(array("colspan"=>3,"label"=>"Status","name"=>"status","value"=>old('status'))) !!}
        </div>
    </section>
    {!! Helper::close("form")!!}
    {!! Helper::closePage()!!}
@endsection
