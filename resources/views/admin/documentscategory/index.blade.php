@extends('layouts/contentLayoutMaster')
@section('title', 'Documents Category')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
  {!! Helper::linkButton(array("colspan"=>12,"url"=>url('admin/documents-category/add'),"label"=>"Add New Category","class"=>"btn-primary btnAdd")) !!}
  {!! Helper::responsiveTable(array("Name","Parent","Status","Summary",""))!!}
  @foreach($results as $row)
    <tr>
      <td>{!! $row['name'] !!}</td>
      <td>{!! $row['parentName'] !!}</td>
      <td>{!! $row['statusName'] !!}</td>
      <td>{!! $row['summary']!!}</td>
      <td><a href="{{url('admin/documents-category/edit/'.$row['id'])}}"><i class="fa fa-pencil"></i></a></td>
    </tr>
  @endforeach
  {!! Helper::closeResponsiveTable()!!}
  {!! Helper::closePage() !!}
@endsection

