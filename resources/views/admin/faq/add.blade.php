@extends('layouts/contentLayoutMaster')
@section('title', 'FAQ')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>"")) !!}
  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
  </div><br />
  @endif
  {!! Helper::form(array("name"=>"frm","action"=>"admin/faq/save","validate"=>"Yes")) !!}
  {!! Helper::hidden(array("name"=>"action","value"=>"save")) !!}
  {!! Helper::hidden(array("name"=>"id","value"=>"")) !!}
  {!! Helper::button(array("colspan"=>12,"name"=>"btnUpdate","class"=>" btnAction btn btn-primary","label"=>"Save FAQ","type"=>"submit"))!!}
 
  {!! Helper::textbox(array("colspan"=>12,"label"=>"Question","name"=>"question","placeholder"=>"Enter Question","class"=>"validate[required]","typ"=>"HTML","value"=>old('question')))!!}
  {!! Helper::textbox(array("colspan"=>12,"label"=>"Answer","name"=>"answer","placeholder"=>"Enter Answer","class"=>"validate[required]","typ"=>"HTML","value"=>old('answer')))!!}
  
  <div class="row">
    {!!Helper::selectList(array("colspan"=>4,"label"=>"Category","name"=>"category","options"=>$getCategory,"value"=>"","key"=>"id","val"=>"name"))!!}
    {!!Helper::selectList(array("colspan"=>4,"label"=>"Author","name"=>"author","options"=>$getAuthor,"value"=>"","key"=>"id","val"=>"name"))!!}
    {!!Helper::selectStatus(array("colspan"=>4,"label"=>"Status","name"=>"status","value"=>$results['status'])) !!}
  </div>
  
  {!! Helper::close("form")!!}
  {!! Helper::closePage() !!}
@endsection
