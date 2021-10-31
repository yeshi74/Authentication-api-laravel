@extends('layouts/contentLayoutMaster')
@section('title', 'Q4E Forms')
@section('content')
    {!!Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    {!!Helper::form(array("name"=>"frm","action"=>"admin/q4eforms/section/update","validate"=>"Yes"))!!}
    {!!Helper::hidden(array("name"=>"form_id","value"=>$id))!!}
    {!!Helper::hidden(array("name"=>"section","value"=>$sectionid))!!}
    {!!Helper::button(array("colspan"=>12,"name"=>"btnSave","label"=>"Update","type"=>"submit"))!!}
    <section id="column-selectors">
        <h4>{{$formDetails->name}}</h4>

        {!! Helper::textbox(array("name"=>"name","placeholder"=>"Enter Name","colspan"=>12,"label"=>"Name","required"=>"Yes","class"=>"validate[required]","max"=>50,"value"=>$results['name'])) !!}
        <div class="row">
            {!! Helper::selectList(array("name"=>"answer_type","placeholder"=>"Answer Type","colspan"=>4,"label"=>"Answer Type","required"=>"Yes","class"=>"validate[required]","options"=>$lstAnswerTypes,"key"=>"id","val"=>"name","value"=>$results['answer_type'])) !!}
            {!! Helper::select(array("name"=>"style","placeholder"=>"Style","colspan"=>4,"label"=>"Style","required"=>"Yes","class"=>"validate[required]","options"=>$lstStyle,"value"=>$results['style'])) !!}
            {!! Helper::select(array("name"=>"section_typ","placeholder"=>"Section Type","colspan"=>4,"label"=>"Section Type","required"=>"Yes","class"=>"validate[required]","options"=>$lstSectionType,"value"=>$results['section_typ'])) !!}
        </div>
        <div class="row">
            {!!Helper::selectStatus(array("name"=>"status","placeholder"=>"Enter Status","colspan"=>2,"label"=>"Status","class"=>"textarea validate[required]","value"=>$results['status']))!!}
            {!! Helper::select(array("name"=>"display","placeholder"=>"Display ","colspan"=>2,"label"=>"Display","required"=>"Yes","class"=>"validate[required]","options"=>array("0"=>"Yes","1"=>"No"),"value"=>$results['display'])) !!}
            {!! Helper::textbox(array("name"=>"ord","placeholder"=>"Display Order","colspan"=>2,"label"=>"Display Order","required"=>"Yes","class"=>"validate[required]","typ"=>"NUMBER","value"=>$results['ord'])) !!}
            {!! Helper::textbox(array("name"=>"max_value","placeholder"=>"Max Value","colspan"=>2,"label"=>"Max. Value","typ"=>"NUMBER","value"=>$results['max_value'])) !!}
            {!! Helper::select(array("name"=>"is_total","placeholder"=>"Show Total","colspan"=>2,"label"=>"Show Total","options"=>array("0"=>"Yes","1"=>"No"),"value"=>$results['is_total'])) !!}
        </div>
        <div class="row">
            {!! Helper::textbox(array("name"=>"header1","placeholder"=>"Enter Header","colspan"=>6,"label"=>"1st Column Header","class"=>"","max"=>150,"value"=>$results['header1'])) !!}
            {!! Helper::textbox(array("name"=>"header2","placeholder"=>"Enter Header","colspan"=>6,"label"=>"2nd Column Header","class"=>"","max"=>150,"value"=>$results['header2'])) !!}
        </div>
        <div class="row">
            {!! Helper::textbox(array("name"=>"results_header","placeholder"=>"Enter Results Header","colspan"=>6,"label"=>"Results Column Header","max"=>150,"value"=>$results['results_header'])) !!}
            {!! Helper::textbox(array("name"=>"remarks_header","placeholder"=>"Enter Remarks Header","colspan"=>6,"label"=>"Remarks Column Header","class"=>"","max"=>150,"value"=>$results['remarks_header'])) !!}
        </div>
        {!! Helper::textbox(array("name"=>"footer","placeholder"=>"Enter Footer","colspan"=>12,"label"=>"Footer","class"=>"","max"=>100,"value"=>$results['Footer'])) !!}
    </section>
    {!!Helper::close("form")!!}
    {!! Helper::closePage()!!}
@endsection
