@extends('layouts/contentLayoutMaster')
@section('title', 'Learning')
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
    {!! Helper::form(array("name"=>"frm","action"=>"admin/blogs/update","validate"=>"Yes"))!!}
    {!! Helper::hidden(array("name"=>"action","value"=>"update"))!!}
    {!! Helper::hidden(array("name"=>"id","value"=>$id))!!}
    {!! Helper::button(array("colspan"=>12,"name"=>"btnUpdate","label"=>"Update","type"=>"submit"))!!}
    {!! Helper::textbox(array("colspan"=>12,"label"=>"Subject","name"=>"subject","max"=>150,"value"=>$results['subject'],"class"=>"validate[required]","required"=>"Yes"))!!}
    
    <div class="row">
        {!! Helper::selectList(array("colspan"=>6,"label"=>"Category","name"=>"category","options"=>$getCategory,"value"=>"","key"=>"id","val"=>"name","value"=>$results['category']))!!}
        {!! Helper::selectList(array("colspan"=>6,"label"=>"Author","name"=>"author","options"=>$getUsers,"value"=>"","key"=>"id","val"=>"name","value"=>$results['author']))!!}
    </div>

    {!! Helper::textbox(array("colspan"=>12,"label"=>"Summary","name"=>"body","typ"=>"HTML","value"=>$results['body']))!!}
    @foreach($lstBlogContents as $row)
        {!! Helper::textbox(array("colspan"=>12,"label"=>$row->catname,"name"=>"contents".$row->category_id,"typ"=>"HTML","value"=>$row->contents))!!}
    @endforeach
    {!! Helper::close("form") !!}
    {!! Helper::gallery(array("module"=>"BLOGS","id"=>$id,"mode"=>"EDIT")) !!}
    {!! Helper::closepage() !!}
@endsection



