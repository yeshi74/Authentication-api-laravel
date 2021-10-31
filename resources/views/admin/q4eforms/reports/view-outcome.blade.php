@extends('layouts/contentLayoutMaster')
@section('title', 'Q4e Forms')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
{!!Helper::form(array("name"=>"frm","action"=>"admin/q4ereports/usage/report/export","target"=>"_new","validate"=>"Yes"))!!}
{!!Helper::hidden(array("name"=>"id","value"=>$id))!!}
{!!Helper::hidden(array("name"=>"typ","value"=>"OUTCOME"))!!}
<div class="row">
	<div class="col-md-12">
		<button id="btnSubmit" type="submit" class="btn btn-danger">Export to Excel</button>
	</div>
</div>
{!! Helper::close("form")!!}
<div class="row">
	{!!Helper::display(array("colspan"=>4,"label"=>"Form","value"=>$rsAssign->formname))!!}
	{!!Helper::display(array("colspan"=>4,"label"=>"Assigned To","value"=>$data['userName']))!!}
	{!!Helper::display(array("colspan"=>4,"label"=>"Center","value"=>$data['locName']))!!}
</div>
<div class="row">
	{!!Helper::display(array("colspan"=>4,"label"=>"Assigned Date","value"=>$data['assignDate']))!!}
	{!!Helper::display(array("colspan"=>4,"label"=>"Completed Date","value"=>$data['completedDate']))!!}
</div>
<div class="accordion" id="accView">
	  {!! Helper::responsiveTable(array("Sr#","Parameter","Numerator","Value","Denomiator","Value","Score","Reason",""))!!}
	  <?php $ctr=1; ?>
	  @foreach($lstOutput as $dsOut)
	  		<tr>
	  			<td>{{$ctr}}</td>
	  			<td>{{$dsOut['parameter']}}</td>
	  			<td>{{$dsOut['numerator']}}</td>
	  			<td>{{$dsOut['numval']}}</td>
	  			<td>{{$dsOut['denominator']}}</td>
	  			<td>{{$dsOut['denval']}}</td>
	  			<td>{{$dsOut['score']}}</td>
	  			<td>{{$dsOut['reason']}}</td>
	  			<td><a href="{{url('admin/q4ereports/usage/edit-outcome/'.$dsOut['ansid'].'/'.$rsAssign->id.'/'.$dsOut['id'])}}" ><i class="fa fa-pencil"></i></a></td>
	  		</tr>
	  		<?php $ctr++; ?>
	  @endforeach
	  {!! Helper::closeResponsiveTable()!!}
</div>
{!! Helper::closePage()!!}
@endsection
@section('myscript')
@endsection