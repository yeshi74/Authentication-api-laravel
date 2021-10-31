@extends('layouts/contentLayoutMaster')
@section('title', 'Unassigned Clinics')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>""))!!}
{!! Helper::responsiveTable(array("Type","Form","Location"))!!}
@foreach($lstLocations as $row)
    <tr>
        <td>{{$row['typ']}}</td>
        <td><a href="{{url($row['url'])}}">{{$row['form_name']}}</a></td>
        <td>{{$row['location']}}</td>
    </tr>
@endforeach
{!! Helper::closeResponsiveTable()!!}
{!! Helper::closePage()!!}
@endsection
@section('myscript')

@endsection