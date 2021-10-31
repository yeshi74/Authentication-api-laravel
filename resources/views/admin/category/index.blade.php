@extends('layouts/contentLayoutMaster')
@section('title', 'Category')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
  {!! Helper::form(array("name"=>"frm","method"=>"POST","action"=>"admin/category/list"))!!}
  <div class="row">
    <div class="col-md-4">
      {!! Helper::linkButton(array("url"=>url('admin/category/add'),"label"=>"Add New Category","class"=>"btn-primary btnAdd")) !!}
    </div>
    <div class="col-md-4">
      <select name="category" id="category" class="form-control">
      @foreach($lstParent as $row)
        <?php $sel = $row->typ == $category ? "selected" : ""; ?>
        <option value="{{$row->typ}}" {{$sel}}>{{$row->typ}}</option>
      @endforeach
      </select>
    </div>
    <div class="col-md-4">
      {!! Helper::button(array("type"=>"submit","name"=>"btnFilter","label"=>"Filter"))!!}
    </div>
  </div>
  {!! Helper::close("form")!!}
  
  {!! Helper::responsiveTable(array("Category","Type","Status")) !!}
  <?php
    foreach($results as $row):
      $_status = ($row['status'] == 0 ? "Active" : "Suspend");
      $name = str_limit($row['name'],100);
      $url = "<a href='".url('admin/category/view/'.$row['id'])."'>".$row['name']."</a>";
  ?>
      <tr>
        <td>{!! $url !!}</td>
        <td>{!! $row['typ'] !!}</td>
        <td>{!! $_status !!}</td>
      </tr>
  <?php
    endforeach;
  ?>
  {!! Helper::closeResponsiveTable()!!}

  {!! Helper::closePage() !!}
@endsection

