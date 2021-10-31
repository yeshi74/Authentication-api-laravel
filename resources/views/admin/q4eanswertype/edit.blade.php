@extends('layouts/contentLayoutMaster')
@section('title', 'Q4e Answer Type')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>""))!!}
{!! Helper::form(array("name"=>"frm","action"=>"admin/q4eanswertype/update","validate"=>"Yes"))!!}
{!! Helper::hidden(array("name"=>"action","value"=>"update"))!!}
{!! Helper::hidden(array("name"=>"id","value"=>$id))!!}
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
        {!! Helper::textbox(array("colspan"=>4,"label"=>"Name","name"=>"name","max"=>45,"placeholder"=>"Enter Name","class"=>"validate[required]","value"=>$results['name'],"required"=>"Yes"))!!}
        {!! Helper::textbox(array("colspan"=>4,"label"=>"Options","name"=>"options","max"=>150,"placeholder"=>"Enter Options","class"=>"validate[required]","value"=>$results['options'],"required"=>"Yes"))!!}
        {!! Helper::textbox(array("colspan"=>4,"label"=>"Code","name"=>"code","max"=>45,"placeholder"=>"Enter Code","class"=>"validate[required]","value"=>$results['code'],"required"=>"Yes"))!!}
    </div>

    {!! Helper::close("form")!!}
    {!! Helper::closePage()!!}
@endsection