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
    {!! Helper::form(array("name"=>"frm","action"=>"admin/documents/update","validate"=>"Yes")) !!}
    {!! Helper::hidden(array("name"=>"action","value"=>"update")) !!}
    {!! Helper::hidden(array("name"=>"id","value"=>$id)) !!}
    {!! Helper::button(array("colspan"=>12,"name"=>"btnUpdate","label"=>"Update","type"=>"submit")) !!}
    {!! Helper::textbox(array("colspan"=>12,"label"=>"Subject","name"=>"subject","max"=>50,"placeholder"=>"Enter Subject","value"=>$results['subject'],"class"=>"validate[required]","required"=>"Yes")) !!}
    <div class="row">
        {!! Helper::textbox(array("colspan"=>3,"label"=>"Published Date","name"=>"doc_date","placeholder"=>"Enter Date","class"=>"validate[required]","required"=>"Yes","typ"=>"date","value"=>$results['doc_date'])) !!}
        {!! Helper::selectList(array("colspan"=>3,"label"=>"Author","name"=>"author","options"=>$getUsers,"value"=>"","key"=>"id","val"=>"name","value"=>$results['author'])) !!}
        {!! Helper::select(array("colspan"=>3,"label"=>"Category","name"=>"category","options"=>$getCategory,"key"=>"id","val"=>"name","value"=>$results['category'])) !!}
        {!! Helper::selectStatus(array("colspan"=>3,"label"=>"Status","name"=>"status","value"=>$results['status']))!!}
    </div>
    <div class="row">
        {!! Helper::attachment(array("colspan"=>6,"label"=>"Existing Document","id"=>$results['id'],"module"=>"DOCUMENTS","value"=>$results['attachment'])) !!}
        {!! Helper::textbox(array("colspan"=>6,"label"=>"Document","name"=>"attachment","typ"=>"FILE"))!!}
    </div>
    {!! Helper::textbox(array("colspan"=>12,"label"=>"Summary","name"=>"summary","placeholder"=>"Enter Summary","class"=>"validate[required]","required"=>"Yes","value"=>$results['summary'],"typ"=>"HTML")) !!}
    <legend>Locations</legend>
    <?php echo ApolloHelpers::locationTree(array("name"=>"locations","mode"=>"EDIT","selLocations"=>$lstLocations,"selRoles"=>$lstRoles)); ?>
    {!! Helper::close("form")!!}
    {!! Helper::closePage()!!}
@endsection
