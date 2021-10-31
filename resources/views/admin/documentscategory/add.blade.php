@extends('layouts/contentLayoutMaster')
@section('title', 'Documents Category')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>"")) !!}
  {!! Helper::form(array("name"=>"frm","action"=>"admin/documents-category/save","validate"=>"Yes")) !!}
  {!! Helper::hidden(array("name"=>"action","value"=>"save")) !!}
  {!! Helper::hidden(array("name"=>"id","value"=>"")) !!}
  {!! Helper::button(array("colspan"=>12,"name"=>"btnUpdate","class"=>"btn btn-primary btnAction","label"=>"Save Category","type"=>"submit"))!!}

  <div class="row">
    {!! Helper::textbox(array("colspan"=>4,"label"=>"Category Name","name"=>"name","max"=>150,"placeholder"=>"Enter Category Name","class"=>"validate[required]","value"=>old('name'),"required"=>"Y")) !!}
    {!! Helper::select(array("colspan"=>3,"label"=>"Parent Category","name"=>"parent","options"=>$lstParent,"value"=>old('parent'))) !!}
    {!! Helper::selectStatus(array("colspan"=>3,"label"=>"Status","name"=>"status","value"=>old('status') )) !!}
  </div>

  
  {!! Helper::textbox(array("colspan"=>12,"label"=>"Summary","name"=>"summary","placeholder"=>"Enter Summary","value"=>old('summary'))) !!}
{!! Helper::close("form")!!}
{!! Helper::closePage() !!}
@endsection
   
