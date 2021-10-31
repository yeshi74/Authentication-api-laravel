@extends('layouts/contentLayoutMaster')
@section('title', 'Q4e Type')
@section('content')
    {!!Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
        {!!Helper::form(array("name"=>"frm","action"=>"admin/q4etype/save","validate"=>"Yes"))!!}
        {!!Helper::hidden(array("name"=>"action","value"=>"save"))!!}
        {!!Helper::button(array("colspan"=>12,"name"=>"btnSave","label"=>"Save","type"=>"submit"))!!}
            <section id="column-selectors">
                <div class="row">
                    {!! Helper::textbox(array("name"=>"name","placeholder"=>"Enter Name","colspan"=>4,"label"=>"Name","required"=>"Yes","class"=>"validate[required]","max"=>50,"value"=>old('name'))) !!}
                    {!!Helper::textbox(array("colspan"=>4,"label"=>"Code","name"=>"code","class"=>"validate[required]","required"=>"Y","max"=>150,"value"=>old('code')))!!}
                    {!! Helper::select(array("name"=>"typ","placeholder"=>"Enter Type","colspan"=>4,"label"=>"Type","required"=>"Yes","class"=>"validate[required]",
                                        "options"=>array("Form"=>"Form","Rating"=>"Rating","value"=>old('typ')))) !!}
                </div>
            </section>
        {!!Helper::close("form")!!}
    {!! Helper::closePage()!!}
@endsection
