<?php
    use App\Helpers\ApolloHelpers;
?>
@extends('layouts/contentLayoutMaster')
@section('title', 'Documents')
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
    {!! Helper::form(array("name"=>"frm","action"=>"admin/documents/save","validate"=>"Yes")) !!}
    {!! Helper::hidden(array("name"=>"action","value"=>"save"))!!}
    {!! Helper::button(array("colspan"=>12,"name"=>"btnSave","label"=>"Save","type"=>"submit"))!!}
    {!! Helper::textbox(array("colspan"=>12,"label"=>"Subject","name"=>"subject","max"=>150,"placeholder"=>"Enter Subject","required"=>"Yes","class"=>"validate[required]","value"=>old('subject'))) !!}
    
    <div class="row">
        {!! Helper::textbox(array("colspan"=>3,"label"=>"Published Date","name"=>"doc_date","placeholder"=>"Enter Date","required"=>"Yes","class"=>"validate[required]","typ"=>"date","value"=>old('doc_date'))) !!}
        {!! Helper::selectList(array("colspan"=>3,"label"=>"Author","name"=>"author","options"=>$getUsers,"value"=>$results['author'],"key"=>"id","val"=>"name")) !!}
        {!! Helper::select(array("colspan"=>3,"label"=>"Category","name"=>"category","options"=>$getCategory,"value"=>$results['category'],"key"=>"id","val"=>"name")) !!}
        {!! Helper::selectStatus(array("colspan"=>3,"label"=>"Status","name"=>"status","value"=>old('status')))!!}
    </div>
    
    {!! Helper::textbox(array("colspan"=>12,"label"=>"Summary","name"=>"summary","placeholder"=>"Enter Summary","class"=>"validate[required]","required"=>"Yes","typ"=>"HTML","value"=>old('summary')))!!}
    {!! Helper::textbox(array("colspan"=>12,"label"=>"Document","name"=>"attachment","placeholder"=>"Select Document","class"=>"validate[required]","required"=>"Yes","typ"=>"FILE"))!!}
    <legend>Choose Locations</legend>
    <?php echo ApolloHelpers::locationTree(array("name"=>"locations","mode"=>"ADD","selLocations"=>array())); ?>
    {!! Helper::close("form")!!}
    {!! Helper::closePage()!!}
@endsection

