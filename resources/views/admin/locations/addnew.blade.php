@extends('layouts/contentLayoutMaster')
@section('title', 'Locations')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>"Add New Location")) !!}
    {!! Helper::form(array("name"=>"frm","action"=>"admin/locations/save","validate"=>"Yes")) !!}
    <div class="form-body">
        <div class="row">
            <div class="col-md-12">
                {!! Helper::button(array("name"=>"btnSave","type"=>"submit","label"=>"Save Location")) !!}
            </div>
        </div>
        <div class="row">
            {!! Helper::textbox(array("colspan"=>6,"label"=>"Location Name","name"=>"name","max"=>150,"placeholder"=>"Location Name","required"=>"Yes","class"=>"validate[required]")) !!}
            {!! Helper::selectList(array("colspan"=>3,"label"=>"Parent","name"=>"parent","blank"=>"No","options"=>$lstLocations,"key"=>"id","val"=>"name")) !!}
            {!! Helper::select(array("colspan"=>3,"label"=>"Type","name"=>"typ","options"=>array("BU"=>"Business Unit","REGION"=>"Region","CENTER"=>"Center"))) !!}
        </div>
    </div>
    {!! Helper::close("form") !!}
    {!! Helper::closePage() !!}
@endsection
