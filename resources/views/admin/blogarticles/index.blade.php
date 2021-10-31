@extends('layouts/contentLayoutMaster')
@section('title', 'Blog Articles')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
  {!! Helper::form(array("name"=>"frm","action"=>"admin/faq/view")) !!}
  {!! Helper::hidden(array("name"=>"action","value"=>"view"))!!}
  {!! Helper::hidden(array("name"=>"id","value"=>""))!!}

  
  {!! Helper::responsiveTableEx(array("Title","Postdate", "Author", "Summary", "Image"))!!}
  <?php
    foreach($blogArticles as $row):
      ?>
      <tr>
        <td>{{ $row->title }}</td>
        <td>{{ $row->postdate }}</td>
        <td>{{ $row->author }}</td>
        <td>{{ $row->summary }}</td>
        <td>
            <img src="{{ asset('public/blogcategory/'. $row->image) }}" style="width: 150px; height: 85px;">
        </td>
      </tr>
      <?php
        endforeach;
      ?>
  {!! Helper::closeResponsiveTable()!!}
  {!! Helper::close("form")!!}
  {!! Helper::closePage() !!} 
@endsection


