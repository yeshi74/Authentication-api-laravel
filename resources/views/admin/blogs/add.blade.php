@extends('layouts/contentLayoutMaster')
@section('title', 'Learning')
@section('content')

{!!Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>""))!!}
    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
           <li>{{ $error }}</li>
          @endforeach
      </ul>
    </div><br />
    @endif
    {!! Helper::form(array("name"=>"frm","action"=>"admin/blogs/save","validate"=>"Yes"))!!}
    {!! Helper::hidden(array("name"=>"action","value"=>"save"))!!}
    {!! Helper::button(array("colspan"=>12,"name"=>"btnSave","label"=>"Save","type"=>"submit"))!!}
    {!! Helper::textbox(array("colspan"=>12,"label"=>"Subject","name"=>"subject","max"=>150,"placeholder"=>"Enter Subject","class"=>"validate[required]","required"=>"Yes","value"=>old('subject')))!!}
    <div class="row">
      {!! Helper::selectList(array("colspan"=>6,"label"=>"Category","name"=>"category","options"=>$getCategory,"value"=>old('category'),"key"=>"id","val"=>"name"))!!}
      {!! Helper::selectList(array("colspan"=>6,"label"=>"Author","name"=>"author","options"=>$getUsers,"value"=>old('author'),"key"=>"id","val"=>"name"))!!}
    </div>
    {!! Helper::textbox(array("colspan"=>12,"label"=>"Summary","name"=>"body","typ"=>"HTML","value"=>old('body')))!!}
    @foreach($lstBlogContents as $row)
      {!! Helper::textbox(array("colspan"=>12,"label"=>$row->name,"name"=>"contents".$row->id,"typ"=>"HTML","value"=>old('contents'.$row->id)))!!}
    @endforeach
    {!! Helper::close("form")!!}
    {!! Helper::closePage()!!}
@endsection
