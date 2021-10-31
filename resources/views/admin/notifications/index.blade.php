@extends('layouts/contentLayoutMaster')
@section('title', 'Admin Notifications')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
{!! Helper::responsiveTableEx(array("Date","Subject","Message","Location","User"))!!}
@foreach($results as $row)
  @if($row['status']==0)
    <tr style="font-weight:bold;color:#0000ff">
  @else
    <tr>
  @endif
    <td data-sort="{{ strtotime($row['created'])}}">
      <a href="{{url($row['action'])}}">{{$row['cDate']}}</a>
    </td>
    <td>{{$row['subject']}}</td>
    <td>{{$row['message']}}</td>
    <td>{{$row['location']}}</td>
    <td>{{$row['userName']}}</td>
  </tr>
@endforeach
{!! Helper::closeResponsiveTable()!!}
{!! Helper::closePage() !!} 
@endsection
@section('myscript')

@endsection