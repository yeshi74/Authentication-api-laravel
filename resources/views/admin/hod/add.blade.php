@extends('layouts/contentLayoutMaster')
@section('title', 'HOD')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>""))!!}
{!! Helper::form(array("name"=>"frm","action"=>"admin/hod/save","validate"=>"Yes"))!!}
{!! Helper::hidden(array("name"=>"action","value"=>"save"))!!}
{!! Helper::button(array("colspan"=>12,"name"=>"btnSave","label"=>"Save","type"=>"submit"))!!}
     @if($msg)
        <p style="color:#c80000;">{{$msg}}</p>
    @endif 
    
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
      {!! Helper::selectList(array("colspan"=>4,"label"=>"User Name","name"=>"userid","options"=>$getUsers,"key"=>"id","val"=>"name","value"=>$results['userid']))!!}
      {!! Helper::selectList(array("colspan"=>4,"label"=>"Location","name"=>"location","options"=>$getLocations,"key"=>"id","val"=>"name","value"=>$results['location']))!!}
      {!! Helper::selectList(array("colspan"=>4,"label"=>"Department","name"=>"dept","options"=>$getDepartment,"key"=>"id","val"=>"name","value"=>$results['dept']))!!}
    </div>
    <div class="row">
        {!! Helper::textbox(array("colspan"=>8,"label"=>"Title","name"=>"title","max"=>150,"placeholder"=>"Enter Title","class"=>"validate[required]","value"=>$results['title'],"required"=>"Yes"))!!}
        {!! Helper::selectStatus(array("colspan"=>4,"label"=>"Status","name"=>"status","value"=>$results['status']))!!}
    </div>

    {!! Helper::close("form")!!}
    {!! Helper::closePage()!!}
@endsection
