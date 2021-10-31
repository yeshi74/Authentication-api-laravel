@extends('layouts/contentLayoutMaster')
@section('title', 'Q4e Forms')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
{!!Helper::form(array("name"=>"frm","action"=>"admin/q4ereports/usage/update","validate"=>"Yes"))!!}
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
	<div class="col-md-6">
		@if($rsField->typ=="SELECT")
			<label>Answer</label>
			<?php $o = explode(";",$rsAnswerType->options); ?>
			<select name="answer" id="answer" class="form-control validate[required]">
				@foreach($o as $opt)
					<?php $sel = $opt == $results['answer'] ? " selected" : ""; ?>
					<option {{$sel}} value="{{$opt}}">{{$opt}}</option>
				@endforeach
			</select>
		@else
			<label>Answer</label>
			<input type="text" name="answer" id="answer" class="form-control validate[required]" value="{{$results['answer']}}"/>
		@endif
	</div>
	{!! Helper::textBox(array("colspan"=>6,"label"=>"Answer 1","name"=>"answer1","value"=>$results['answer1']))!!}
</div>
{!! Helper::textBox(array("colspan"=>12,"label"=>"Remarks","name"=>"remarks","value"=>$results['remarks']))!!}
<div class="row">
	<div class="col-md-12" style="text-align:right">
		<button type="submit" class="btn btn-primary">Update</button>
	</div>
</div>
{!! Helper::close("form")!!}
{!! Helper::closePage()!!}
@endsection