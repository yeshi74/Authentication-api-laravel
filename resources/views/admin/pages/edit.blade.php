@extends('layouts/contentLayoutMaster')
@section('title', 'Edit Page')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}

<legend>Add Page</legend>
<div id="form_error" class="form_error"></div>  
<form method="post" action="{{ route('update-pages', $pages->id) }}" ENCTYPE="multipart/form-data">
    {{ csrf_field() }}
<div class="row">
  <div class="col-md-6">
    <label>Page Code *</label>
    <input id="name" name="page_code" class="form-control name" type="text" value="{{ $pages->page_code }}" required="">
  </div>
  <div class="col-md-6">
    <label>Header *</label>
    <input id="contact_name" name="header" class="form-control" type="text" value="{{ $pages->header }}" required="">
    <div id="contact_name_error" class="contact_name_error"></div>  
  </div>
</div>
<br>
{!! Helper::textbox(array("colspan"=>12,"label"=>"Body","name"=>"body","typ"=>"HTML", "value"=>$pages->body))!!}

  <br>

    {!! Helper::button(array("colspan"=>12,"label"=>"Update","type"=>"submit")) !!}

</form>

</div>

<?php
Helper::closePage();
?>
@endsection
