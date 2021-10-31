@extends('layouts/contentLayoutMaster')
@section('title', 'Q4e Forms')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
{!!Helper::form(array("name"=>"frm","action"=>"admin/q4ereports/usage/report","validate"=>"Yes"))!!}
{!!Helper::hidden(array("name"=>"status","value"=>$data['status']))!!}
<div class="row">
	{!! Helper::listLocations(array("colspan"=>3,"label"=>"Location","name"=>"location","multiple"=>"No","required"=>"Yes","value"=>$data['location']))!!}
	
	<div class="col-md-2">
		<label>Form</label>
		<select name="form" id="form" class="form-control">
		@foreach($formsList['lstType'] as $row)
			<optgroup label="{{$row['name']}}"></optgroup>
			<?php $typ = $row['id']; ?>
			@foreach($formsList['lstForms'] as $srow)
				<?php 
				if($typ == $srow['typ']) {
					$sel = $data['form'] == $srow['id'] ?  "selected" : "";
					?><option {{$sel}} value="{{$srow['id']}}">{{$srow['name']}}</option><?php
				}
				?>
			@endforeach
		@endforeach
		</select>
	</div>
	
	{!! Helper::textbox(array("colspan"=>3,"label"=>"From Date","name"=>"fdate","placeholder"=>"Enter From Date","required"=>"Yes","typ"=>"date","value"=>$data['fdate']))!!}  
	{!! Helper::textbox(array("colspan"=>3,"label"=>"Date","name"=>"tdate","placeholder"=>"Enter To Date",	"required"=>"Yes","typ"=>"date","value"=>$data['tdate']))!!}  
	{!! Helper::button(array("colspan"=>1,"name"=>"btnUpdate","class"=>"btn btn-primary btnAction formButton","label"=>"Filter","type"=>"submit"))!!}
</div>
{!! Helper::close("form")!!}
@if($pg=="RESULTS")
	<section id="column-selectors">
        <div class="d-flex justify-content-start flex-wrap">
        	
            <div class="text-center bg-info colors-container rounded text-white col-md-2 height-100 d-flex align-items-center justify-content-center mr-1 ml-20 my-1 shadow">
                <span class="align-middle">
                   	<a style="color:white;" data-id="ASSIGNED" data-count="{{$count['assigned']}}" class="lnkStatus" href="Javascript:void(0)"><strong>Assigned</strong></a>
                    <br><span style="font-size:2rem">{{$count['assigned']}}</span>
                </span>
            </div>
        	<div class="text-center bg-primary colors-container rounded text-white col-md-2 height-100 d-flex align-items-center justify-content-center mr-1 ml-20 my-1 shadow">
            	<span class="align-middle">
               		<a style="color:white;" data-id="INPROGRESS" data-count="{{$count['inprogress']}}" class="lnkStatus" href="Javascript:void(0)"><strong>In Progress</strong></a>
                	<br><span style="font-size:2rem">{{$count['inprogress']}}</span>
            	</span>
        	</div>
            <div class="text-center bg-success colors-container rounded text-white col-md-2 height-100 d-flex align-items-center justify-content-center mr-1 ml-20 my-1 shadow">
                <span class="align-middle">
                   	<a style="color:white;" data-id="COMPLETED" data-count="{{$count['completed']}}" class="lnkStatus" href="Javascript:void(0)"><strong>Completed</strong></a>
                    <br><span style="font-size:2rem">{{$count['completed']}}</span>
                </span>
            </div>
            <div class="text-center bg-danger colors-container rounded text-white col-md-2 height-100 d-flex align-items-center justify-content-center mr-1 ml-20 my-1 shadow">
                <span class="align-middle">
                   	<a style="color:white;" data-id="OVERDUE" data-count="{{$count['overdue']}}" class="lnkStatus" href="Javascript:void(0)"><strong>OverDue</strong></a>
                    <br><span style="font-size:2rem">{{$count['overdue']}}</span>
                </span>
            </div>
        </div>
    </section>
@endif
@if(count($lstForms)>0 && $pg=="RESULTS")
	{!! Helper::responsiveTable(array("User","Form","Type","Assign Date","To be Completed","Completed Date","Score","Status","Remarks"))!!}
	@foreach($lstForms as $row)
		<?php 
			$style = $row['days'] > 0 ? "color:#c80000" : "";
		?>
		<tr style="{{$style}}">
			@if($row['status'] == 20)
				<td style="{{$style}}"><a href="{{url('admin/q4ereports/usage/view/'.$row['id'])}}">{{$row['userName']}}</a></td>
			@else
				<td style="{{$style}}"><a href="{{url('admin/q4ereports/usage/view/'.$row['id'])}}">{{$row['userName']}}</a></td>
			@endif
			<td>{{$row['formName']}}</td>
			<td>{{$row['typName']}}</td>
			<td>{{$row['assign_date']}}</td>
			<td>{{$row['end_date']}}</td>
			<td>{{$row['completed_date']}}</td>
			<td>{{$row['score']}}</td>
			<td>{{$row['statusName']}}</td>
			<td>{{$row['remarks']}}</td>
		</tr>
	@endforeach
	{!! Helper::closeResponsiveTable()!!}
@endif
{!! Helper::closePage()!!}
@endsection
@section('myscript')
<script>
	$(".lnkStatus").on('click',function(){
		var cnt = $(this).data("count");
		var id = $(this).data("id");
		if(cnt > 0){
			$("#status").val(id);
			$("#frm").submit();
		}
	});
</script>
@endsection