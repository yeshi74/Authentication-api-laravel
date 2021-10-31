@extends('layouts/contentLayoutMaster')
@section('title', 'Category')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>"")) !!}
  {!! Helper::form(array("name"=>"frm","action"=>"admin/category/save","validate"=>"Yes")) !!}
  {!! Helper::button(array("colspan"=>12,"name"=>"btnUpdate","class"=>"btn btn-primary btnAction","label"=>"Save Category","type"=>"submit"))!!}

  <div class="row">
    {!! Helper::textbox(array("colspan"=>4,"label"=>"Category Name","name"=>"name","max"=>150,"placeholder"=>"Enter Category Name","class"=>"validate[required]","value"=>"","required"=>"Y")) !!}
    {!! Helper::selectList(array("colspan"=>4,"label"=>"Parent Category","name"=>"typ","options"=>$lstParent,"value"=>"","key"=>"typ","val"=>"typ")) !!}
    {!! Helper::selectStatus(array("colspan"=>4,"label"=>"Status","name"=>"status","value"=>"" )) !!}
  </div>

  
 {!! Helper::textbox(array("colspan"=>12,"name"=>"summary","typ"=>"TEXTAREA","label"=>"Summary"))!!}
{!! Helper::close("form")!!}
{!! Helper::closePage() !!}
@endsection
   
