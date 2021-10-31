@extends('layouts/contentLayoutMaster')
@section('title', 'Albums')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>"")) !!}
  {!! Helper::form(array("name"=>"frm","action"=>"admin/albums/rejsave","validate"=>"Yes")) !!}
  {!! Helper::hidden(array("name"=>"action","value"=>"rejsave")) !!}
  {!! Helper::hidden(array("name"=>"id","value"=>$id)) !!}
  {!! Helper::button(array("colspan"=>12,"name"=>"btnUpdate","class"=>"btn btn-primary btnAction","label"=>"Save Reject","type"=>"submit"))!!}

  {!! Helper::textbox(array("colspan"=>12,"label"=>"Reject Reason","name"=>"reject_reason","placeholder"=>"Enter Rejection","class"=>"textarea validate[required]","required"=>"Yes","value"=>""))!!}
  
  {!! Helper::close("form")!!}
  {!! Helper::closePage() !!}
@endsection