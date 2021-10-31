@extends('layouts/contentLayoutMaster')
@section('title', 'Department')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>""))!!}
{!! Helper::form(array("name"=>"frm","action"=>"admin/dept/save","validate"=>"Yes"))!!}
{!! Helper::hidden(array("name"=>"action","value"=>"save"))!!}
{!! Helper::button(array("colspan"=>12,"name"=>"btnSave","label"=>"Save","type"=>"submit"))!!}
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div><br/>
    @endif
    <div class="row">
        {!! Helper::textbox(array("colspan"=>6,"label"=>"Name","name"=>"name","max"=>150,"placeholder"=>"Enter Department Name","class"=>"validate[required]","required"=>"Yes"))!!}
      {!! Helper::selectList(array("colspan"=>3,"label"=>"Parent Department","name"=>"parent","options"=>$lstDept,"key"=>"id","val"=>"name","blanks"=>"Yes"))!!}
      {!! Helper::selectStatus(array("colspan"=>3,"label"=>"Status","name"=>"status"))!!}
    </div>
    {!! Helper::close("form")!!}
    {!! Helper::closePage()!!}
@endsection
