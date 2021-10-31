@if($output['status'] == "success")
	<?php
		$results= $output['results'];
	?>
	<div class="row">
		{!!Helper::display(array("colspan"=>4,"label"=>"Assigned To","value"=>$results['username']))!!}
		{!!Helper::display(array("colspan"=>4,"label"=>"Assigned On","value"=>$results['fAssignDate']))!!}
		{!!Helper::display(array("colspan"=>4,"label"=>"Assigned By","value"=>$results['assigned_by_name']))!!}
	</div>
	<div class="row">
		{!!Helper::display(array("colspan"=>4,"label"=>"Expected Closing","value"=>$results['fExpCloseDate']))!!}
		{!!Helper::display(array("colspan"=>4,"label"=>"Closed On","value"=>$results['fClosedDate']))!!}
		{!!Helper::display(array("colspan"=>4,"label"=>"Status","value"=>$results['statusname']))!!}
	</div>
	{!!Helper::display(array("colspan"=>12,"label"=>"QA Comments","value"=>$results['assigned_notes']))!!}
	{!!Helper::display(array("colspan"=>12,"label"=>"User Comments","value"=>$results['user_comments']))!!}
	{{-- <legend>Comments</legend>
	@foreach($results['comments'] as $row)
		<strong>{{$row->username}} on {{date('d/m/Y H:i',strtotime($row->created_at))}}</strong>
		<p>{!! $row->comments !!}</p>
		<hr/>
	@endforeach --}}
	
@else
  <h3>Task not found!!</h3>
@endif