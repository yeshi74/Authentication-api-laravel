@extends('layouts/contentLayoutMaster')
@section('title', 'Roles')
@section('content')

    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>""))!!}
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div><br />
    @endif
    {!!Helper::form(array("name"=>"frm","action"=>"admin/roles/save","validate"=>"Yes"))!!}
    {!!Helper::hidden(array("name"=>"action","value"=>"save"))!!}
    {!!Helper::button(array("colspan"=>12,"name"=>"btnSave","label"=>"Save","type"=>"submit"))!!}
       
    <div class="row">
        {!! Helper::textbox(array("colspan"=>3,"max"=>45,"label"=>"Code","name"=>"code","placeholder"=>"Enter Code","required"=>"Yes","class"=>"validate[required]","value"=>"")) !!}
        {!! Helper::textbox(array("colspan"=>6,"max"=>150,"label"=>"Name","name"=>"name","placeholder"=>"Enter Name","required"=>"Yes","class"=>"validate[required]")) !!}
        {!! Helper::select(array("colspan"=>3,"label"=>"Default Role","name"=>"def_role","options"=>array("0"=>"No","1"=>"Yes")))!!}
    </div>
    <legend>Permissions</legend>
    <div class="row">
        @foreach($lstOpts as $row)
            <div class="col-md-3">
                <input type="checkbox" name="optid[]" value="{{$row->id}}">{{$row->name}}&nbsp;
            </div>
        @endforeach
    </div>
    {!!Helper::close("form")!!}
    {!!Helper::closePage()!!}
@endsection
