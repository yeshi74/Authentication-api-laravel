@extends('layouts/contentLayoutMaster')
@section('title', 'Q4e Forms')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
{!!Helper::form(array("name"=>"frm","action"=>"admin/q4ereports/usage/update-outcome","validate"=>"Yes"))!!}
{!!Helper::hidden(array("name"=>"id","value"=>$assign))!!}
{!!Helper::hidden(array("name"=>"ansid","value"=>$id))!!}
{!!Helper::hidden(array("name"=>"fieldid","value"=>$fieldID))!!}
<div class="row">
	{!!Helper::display(array("colspan"=>4,"label"=>"Form","value"=>$rsAssign->formname))!!}
	{!!Helper::display(array("colspan"=>4,"label"=>"Assigned To","value"=>$data['userName']))!!}
	{!!Helper::display(array("colspan"=>4,"label"=>"Center","value"=>$data['locName']))!!}
</div>
<div class="row">
	{!!Helper::display(array("colspan"=>4,"label"=>"Assigned Date","value"=>$data['assignDate']))!!}
	{!!Helper::display(array("colspan"=>4,"label"=>"Completed Date","value"=>$data['completedDate']))!!}
</div>
<h6>{{$rsField->name}}</h6>
<div class="row">
	{!! Helper::textBox(array("colspan"=>6,"name"=>"numerator","label"=>$rsField->numerator,"value"=>$results['numerator']))!!}
	{!! Helper::textBox(array("colspan"=>6,"name"=>"denominator","label"=>$rsField->denominator,"value"=>$results['denominator']))!!}
</div>
{!! Helper::textBox(array("colspan"=>12,"name"=>"reason","label"=>"Reason","value"=>$results['reason'],"typ"=>"textarea"))!!}
{!! Helper::textBox(array("colspan"=>12,"name"=>"action_plan","label"=>"Action Plan","value"=>$results['action_plan'],"typ"=>"textarea"))!!}
{!! Helper::textBox(array("colspan"=>12,"name"=>"qa_remarks","label"=>"QA Remarks","value"=>$results['qa_remarks'],"typ"=>"textarea"))!!}
<div class="row">
	<div class="col-md-12" style="text-align:right">
		<button type="submit" class="btn btn-primary">Update</button>
	</div>
</div>
{!! Helper::close("form")!!}
{!! Helper::closePage()!!}
@endsection