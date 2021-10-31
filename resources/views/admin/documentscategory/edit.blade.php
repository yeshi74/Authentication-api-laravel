@extends('layouts/contentLayoutMaster')
@section('title', 'Documents Category')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>""))!!}
  {!! Helper::form(array("name"=>"frm","action"=>"admin/documents-category/update","validate"=>"Yes"))!!}
  {!! Helper::hidden(array("name"=>"id","value"=>$id))!!}
  {!! Helper::button(array("colspan"=>12,"name"=>"btnUpdate","label"=>"Update","type"=>"submit")) !!}

  <div class="row">
    {!! Helper::textbox(array("colspan"=>6,"label"=>"Category Name","name"=>"name","max"=>150,"class"=>"validate['required']","value"=>$results['name']))!!}
    {!! Helper::select(array("colspan"=>3,"label"=>"Parent Category","name"=>"parent","options"=>$lstParent,"value"=>$results['parent']))!!}
    {!! Helper::selectStatus(array("colspan"=>3,"label"=>"Status","name"=>"status","value"=>$results['status'])) !!}
  </div>

  {!! Helper::textbox(array("colspan"=>12,"label"=>"Summary","name"=>"summary","placeholder"=>"Enter Summary","value"=>$results['summary'])) !!}

  {!! Helper::close("form") !!}
  {!! Helper::closePage() !!}
@endsection
