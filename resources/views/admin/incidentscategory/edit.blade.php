@extends('layouts/contentLayoutMaster')
@section('title', 'Incident Category')
@section('content')
 
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>"")) !!}
  {!! Helper::form(array("name"=>"frm","action"=>"admin/incidents-category/update","validate"=>"Yes"))!!}
  {!! Helper::hidden(array("name"=>"id","value"=>$id))!!}
  
  <div class="row">
    <div class="col-md-12">
      {!! Helper::button(array("label"=>"Update","name"=>"btnUpdate","type"=>"submit"))!!}
    </div>
  </div>
  {!! Helper::textbox(array("colspan"=>12,"name"=>"caption","label"=>"Caption","class"=>"validate[required]","value"=>$results['caption']))!!}
  <div class="row">
    
    {!! Helper::textbox(array("colspan"=>2,"name"=>"ord","label"=>"Order","class"=>"validate[required]","value"=>$results['ord'],"typ"=>"NUMBER"))!!}
    {!! Helper::selectStatus(array("colspan"=>2,"label"=>"Status","name"=>"status","value"=>$results['status']))!!}
    @if($results['typ'] == "CATEGORY")
      {!! Helper::hidden(array("name"=>"parent","value"=>$results['parent']))!!}
      {!! Helper::display(array("colspan"=>2,"label"=>"Type","value"=>$results['typ']))!!}
    @endif
  </div>
  {!! Helper::close("form") !!}
  {!! Helper::closePage() !!}
@endsection

