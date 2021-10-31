@extends('layouts/contentLayoutMaster')
@section('title', 'Blog Category')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
  {!! Helper::form(array("name"=>"frm","action"=>"admin/faq/view")) !!}
  {!! Helper::hidden(array("name"=>"action","value"=>"view"))!!}
  {!! Helper::hidden(array("name"=>"id","value"=>""))!!}
  <a class="btn btn-primary" href="{{ route('blogcategory.create')}}" role="button">Add</a>

  
  {!! Helper::responsiveTableEx(array("Name","Image"))!!}
  <?php
    foreach($blogCategory as $row):
      ?>
      <tr>
        <td>
          <a href="{{ route('blogarticles', $row->id) }}">{{ $row->name }}</a>
          </td>
        <td>
            <img src="{{ asset('public/blogcategory/'. $row->img) }}" style="width: 150px; height: 85px;">
        </td>
      </tr>
      <?php
        endforeach;
      ?>
  {!! Helper::closeResponsiveTable()!!}
  {!! Helper::close("form")!!}
  {!! Helper::closePage() !!} 
@endsection


