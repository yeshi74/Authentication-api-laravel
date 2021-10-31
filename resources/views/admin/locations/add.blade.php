@extends('layouts/contentLayoutMaster')
@section('title', 'Locations')
@section('content')

    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    {!!Helper::form(array("name"=>"frm","action"=>"admin/locations/save","validate"=>"Yes"))!!}
        {!!Helper::hidden(array("name"=>"action","value"=>"save"))!!}
        {!!Helper::button(array("colspan"=>12,"name"=>"btnSave","label"=>"Save","type"=>"submit"))!!}
        <section id="column-selectors">
            <div class="row">
                {!! Helper::select(array("colspan"=>4,"label"=>"Type","name"=>"typ","blank"=>"No","options"=>array("BU"=>"BU","CENTER"=>"CENTER","REGION"=>"REGION"))) !!}
                {!! Helper::textbox(array("colspan"=>4,"label"=>"Name","name"=>"name","max"=>150,"placeholder"=>"Enter Name","required"=>"Yes","class"=>"validate[required]")) !!}
                {!!Helper::selectList(array("colspan"=>4,"label"=>"Parent","name"=>"parent","options"=>$getparentCat,"value"=>"","key"=>"id","val"=>"name"))!!}
            </div>
        </section>
   {!!Helper::close("form")!!}

{!! Helper::closePage()!!}
@endsection
