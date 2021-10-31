<?php
    use App\Helpers\ApolloHelpers;
?>
@extends('layouts/contentLayoutMaster')
@section('title', 'Q4E Forms')
@section('content')
	{!!Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    {!!Helper::form(array("name"=>"frm","action"=>"admin/q4eforms/save","validate"=>"Yes"))!!}
    {!! Helper::linkButton(array("url"=>url('admin/q4eforms/outcome/outcome/add/'.$id),"label"=>"Add Parameters","class"=>"btn btn-primary"))!!}
    <section id="column-selectors">
    	<h4>{{$results['name']}}</h4>
    	{!!Helper::responsiveTable(array("Sr #","Parameter","Numerator","Denominator"))!!}
    	<?php 
    		$ctr=1;
    		foreach($lstOutcome as $row){

    	?>
    		<tr>
    			<td>{{$ctr}}</td>
    			<td><a href="{{url('admin/q4eforms/outcome/outcome/view/'.$id.'/'.$row->id)}}">{{$row->parameter}}</a></td>
    			<td>{{$row->numerator}}</td>
    			<td>{{$row->denominator}}</td>
    		</tr>
    	<?php $ctr++;
    	} 
    	?>
    	{!!Helper::closeResponsiveTable()!!}
    </section>
    {!!Helper::close("form")!!}
    {!! Helper::closePage()!!}
@endsection
@section('myscript')
<script>
	$("#btnAdd").on('click',function(){
		alert("in add")
	});
</script>
@endsection