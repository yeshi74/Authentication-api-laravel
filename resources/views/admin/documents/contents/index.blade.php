@extends('layouts/contentLayoutMaster')
@section('title', 'Contents')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
  {{-- {!! Helper::form(array("name"=>"frm","action"=>"admin/faq/view")) !!} --}}
  {!! Helper::hidden(array("name"=>"action","value"=>"view"))!!}
  {!! Helper::hidden(array("name"=>"id","value"=>""))!!}
  <a class="btn btn-primary" href="{{ route('contents.add') }}" role="button">Add</a>

  
  {!! Helper::responsiveTableEx(array("Type","Subject", "Order", "Image"))!!}
  <?php
    foreach($contents as $row):
      ?>
      <tr>
        <td>
          <a href="{{ route('contents.detail', $row->id) }}">{{ $row->typ }}</a>
          </td>
          <td>
            {{ $row->subject }}
        </td>
        <td>
            {{ $row->ord }}
        </td>
        <td>
            <img src="{{ asset('public/contentimg/'. $row->coverimg) }}" style="width: 150px; height: 85px;">
        </td>
        <td>
            <a class="btn" onclick="return confirm('Are you sure, you want to delete?')" role="button">
                <form action="{{ route('contents.delete', $row->id) }}" method="post">
                    <input class="btn btn-danger" style="padding:6px;" type="submit" value="Delete" />
                        {!! method_field('delete') !!}
                        {!! csrf_field() !!}
                </form>
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


