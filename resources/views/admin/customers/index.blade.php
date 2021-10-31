@extends('layouts/contentLayoutMaster')
@section('title', 'Customers')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
  {!! Helper::hidden(array("name"=>"action","value"=>"view"))!!}
  {!! Helper::hidden(array("name"=>"id","value"=>""))!!}
  {{-- <a class="btn btn-primary" href="#" role="button">Add</a> --}}

  @if(session('updated'))
<div class="alert alert-primary">
  {{ session('updated') }}
</div>
@endif
  
  {!! Helper::responsiveTableEx(array("Name","Email", "Mobile", "Nationality", "Department", " "))!!}
  <?php
    foreach($customers as $row):
      ?>
      <tr>
        <td>
          <a href="{{ route('view-customer', $row->id) }}">{{ $row->name }}</a>
          </td>
          <td>
            {{ $row->email }}
        </td>
        <td>
            {{ $row->mobile }}
        </td>
        <td>
            {{ $row->nationality }}
        </td>
        <td>
            {{ $row->department }}
        </td>
        <td>
          <a href="{{ route('edit-customer', $row->id) }}">
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


