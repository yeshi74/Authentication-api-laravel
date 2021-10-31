@extends('layouts/contentLayoutMaster')
@section('title', 'Blog Articles')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
  {{-- <a class="btn btn-primary" href="{{ route('blogcategory.create')}}" role="button">Add</a> --}}

  
  {!! Helper::responsiveTableEx(array("Title","Postdate", "Author", "Summary", "Image"))!!}
  <?php
    foreach($blogArticles as $row):
      ?>
      <tr>
        <td>
            <a href="{{ route('blogarticlesdetail', $row->id) }}">{{ $row->title }}</a>
            </td>
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


