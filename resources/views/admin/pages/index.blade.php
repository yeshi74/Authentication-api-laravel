@extends('layouts/contentLayoutMaster')
@section('title', 'Pages')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
  {!! Helper::hidden(array("name"=>"action","value"=>"view"))!!}
  {!! Helper::hidden(array("name"=>"id","value"=>""))!!}
  <a class="btn btn-primary" href="{{ route('add-pages') }}" role="button">Add</a>

  @if(session('added'))
<div class="alert alert-success">
  {{ session('added') }}
</div>
@endif
  @if(session('updated'))
<div class="alert alert-primary">
  {{ session('updated') }}
</div>
@endif
  
  {!! Helper::responsiveTableEx(array("Page Code","Header", "Body", " "))!!}
  <?php
    foreach($pages as $row):
      ?>
      <tr>
        <td>
          <a href="{{ route('view-pages', $row->id) }}">{{ $row->page_code }}</a>
          </td>
          <td>
            {{ $row->header }}
        </td>
        <td>
           {!! $row->body !!}
        </td>
        <td>
          <a href="{{ route('edit-pages', $row->id) }}">
            <i class="fa fa-edit"></i>
          </a>
        </td>
      </tr>
      <?php
        endforeach;
      ?>
  {!! Helper::closeResponsiveTable()!!}
  {!! Helper::close("form")!!}
  {!! Helper::closePage() !!} 
@endsection


