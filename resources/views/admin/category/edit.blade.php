@extends('layouts/contentLayoutMaster')
@section('title', 'Category')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>""))!!}
  {!! Helper::form(array("name"=>"frm","action"=>"admin/category/update","validate"=>"Yes"))!!}
  {!! Helper::hidden(array("name"=>"action","value"=>"update"))!!}
  {!! Helper::hidden(array("name"=>"id","value"=>$id))!!}
  {!! Helper::button(array("colspan"=>12,"name"=>"btnUpdate","label"=>"Update","type"=>"submit")) !!}

  <div class="row">
    {!! Helper::textbox(array("colspan"=>6,"label"=>"Category Name","name"=>"name","max"=>150,"class"=>"validate['required']","value"=>$results['name']))!!}
    {!! Helper::selectList(array("colspan"=>6,"label"=>"Parent Category","name"=>"typ","options"=>$lstParent,"key"=>"typ","val"=>"typ","value"=>$results['typ']))!!}
  </div>

  <div class="row">
    {!! Helper::selectStatus(array("colspan"=>6,"label"=>"Status","name"=>"status","value"=>$results['status'])) !!}
  </div>
  {!! Helper::textbox(array("colspan"=>12,"name"=>"summary","typ"=>"TEXTAREA","label"=>"Summary","value"=>$results['summary']))!!}
  {!! Helper::close("form") !!}
  {!! Helper::closePage() !!}
@endsection
