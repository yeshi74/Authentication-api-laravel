@extends('layouts/contentLayoutMaster')
@section('title', 'Q4E Forms')
@section('content')
    {!!Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    {!!Helper::form(array("name"=>"frm","action"=>"admin/q4eforms/".$ftype."/section/save","validate"=>"Yes"))!!}
    {!!Helper::hidden(array("name"=>"form_id","value"=>$id))!!}
    {!!Helper::hidden(array("name"=>"ftype","value"=>$ftype))!!}
    {!!Helper::button(array("colspan"=>12,"name"=>"btnSave","label"=>"Save","type"=>"submit"))!!}
    <section id="column-selectors">
        <h4>{{$formDetails->name}}</h4>

        {!! Helper::textbox(array("name"=>"name","placeholder"=>"Enter Title","colspan"=>12,"label"=>"Title","required"=>"Yes","class"=>"validate[required]","max"=>50,"value"=>old('name'))) !!}
         {!! Helper::textbox(array("name"=>"header1","placeholder"=>"Caption","colspan"=>12,"label"=>"1st Column Header","class"=>"","max"=>150,"value"=>old('header1'))) !!}
         {!! Helper::textbox(array("name"=>"header2","placeholder"=>"Sub Caption","colspan"=>12,"label"=>"2nd Column Header","class"=>"","max"=>150,"value"=>old('header2'))) !!}
         {!! Helper::textbox(array("name"=>"footer","placeholder"=>"Enter Footer","colspan"=>12,"label"=>"Footer","class"=>"","max"=>100,"value"=>old('Footer'))) !!}
        <div class="row">
            {!!Helper::selectStatus(array("name"=>"status","placeholder"=>"Enter Status","colspan"=>3,"label"=>"Status","class"=>"textarea validate[required]","value"=>old('status')))!!}
            {!! Helper::textbox(array("name"=>"ord","placeholder"=>"Display Order","colspan"=>3,"label"=>"Display Order","required"=>"Yes","class"=>"validate[required]","typ"=>"NUMBER","value"=>old('ord'))) !!}
            {!! Helper::textbox(array("name"=>"max_value","placeholder"=>"Max Value","colspan"=>3,"label"=>"Max. Value","typ"=>"NUMBER","value"=>old('max_value'))) !!}
            {!! Helper::select(array("colspan"=>3,"label"=>"Show Remarks","name"=>"showremarks","value"=>1,"options"=>array("1"=>"Yes","0"=>"No")))!!}
        </div>
    </section>
    {!!Helper::close("form")!!}
    {!! Helper::closePage()!!}
@endsection
