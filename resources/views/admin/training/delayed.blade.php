<?php
    use App\Helpers\ApolloHelpers;
?>
@extends('layouts/contentLayoutMaster')
@section('title', 'Delayed Users')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
{!! Helper::responsiveTable(array("Training","Start Date","End Date","User","Start Date","Completed Date","Last Attended"))!!}
@foreach($results as $row)
    <tr>
        <td>{{$row->subject}}</td>
        <td>{{date('d/m/Y',strtotime($row->training_date))}}</td> 
        <td>{{date('d/m/Y',strtotime($row->training_edate))}}</td> 
        <td>{{$row->name}}</td>
        <td>{{date('d/m/Y',strtotime($row->start_date))}}</td>
        <td>{{date('d/m/Y',strtotime($row->complete_date))}}</td> 
        <td>{{date('d/m/Y',strtotime($row->last_attend))}}</td> 
    </tr>
@endforeach
{!! Helper::closeResponsiveTable()!!}
{!! Helper::closePage()!!}
@endsection
