<?php
    use App\Helpers\ApolloHelpers;
?>
@extends('layouts/contentLayoutMaster')
@section('title', 'Q4e Forms')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
<div class="row">
	{!! Helper::linkButton(array("url"=>url('admin/q4eforms/reports/bi-standing/'.$id),"label"=>"Survey Standing Report","class"=>"btn btn-primary"))!!}
	{!! Helper::linkButton(array("url"=>url('admin/q4eforms/reports/bi-trends/'.$id),"label"=>"Trend of Scores","class"=>"btn btn-primary"))!!}
</div>
{!! Helper::closePage() !!}
@endsection
