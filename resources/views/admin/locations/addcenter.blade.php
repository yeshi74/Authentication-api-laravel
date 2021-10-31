@extends('layouts/contentLayoutMaster')
@section('title', 'Locations')
@section('content')

    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    {!!Helper::form(array("name"=>"frm","action"=>"admin/locations/save","validate"=>"Yes"))!!}
        {!!Helper::hidden(array("name"=>"action","value"=>"save"))!!}
        {!!Helper::hidden(array("name"=>"typ","value"=>"CENTER"))!!}
        {!!Helper::button(array("colspan"=>12,"name"=>"btnSave","label"=>"Save","type"=>"submit"))!!}
        <section id="column-selectors">
            <div class="row">
                {!! Helper::textbox(array("colspan"=>6,"label"=>"Name","name"=>"name","max"=>150,"placeholder"=>"Enter Name","required"=>"Yes","class"=>"validate[required]")) !!}
                {!!Helper::selectList(array("colspan"=>6,"label"=>"Choose BU","name"=>"bu","options"=>$BUList,"value"=>"","key"=>"id","val"=>"name","attach"=>"region"))!!}
            </div>
            <div class="row">
                {!!Helper::selectList(array("colspan"=>6,"label"=>"Choose Region","name"=>"parent","options"=>$RegionList,"value"=>"","key"=>"id","val"=>"name","id"=>"region","data-ref"=>"parent"))!!}
            </div>

        </section>
   {!!Helper::close("form")!!}

{!! Helper::closePage()!!}
@endsection
