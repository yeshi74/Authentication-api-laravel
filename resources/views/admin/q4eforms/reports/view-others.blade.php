@extends('layouts/contentLayoutMaster')
@section('title', 'Q4e Forms - Others')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
{!!Helper::form(array("name"=>"frm","action"=>"admin/q4ereports/usage/report/export","target"=>"_new","validate"=>"Yes"))!!}
{!!Helper::hidden(array("name"=>"id","value"=>$id))!!}
{!!Helper::hidden(array("name"=>"typ","value"=>"OTHERS"))!!}
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
@foreach($rsSections as $dsSection)
  {!! Helper::accordion(array("id"=>"c".$dsSection->id,"parent"=>"accView","label"=>$dsSection->name))!!}
	  {!! Helper::responsiveTable(array("Sr#","Parameter","Answer","Answer - 1","Remarks",""))!!}
	  <?php $ctr=1; ?>
	  @foreach($lstOutput as $dsOut)
	  	@if($dsOut['section_id'] == $dsSection->id)
	  		<tr>
	  			<td>{{$ctr}}</td>
	  			<td>{{$dsOut['name']}}</td>
	  			<td>{{$dsOut['answer']}}</td>
	  			<td>{{$dsOut['answer1']}}</td>
	  			<td>{{$dsOut['remarks']}}</td>
	  			<td><a href="{{url('admin/q4ereports/usage/edit/'.$dsOut['ansid'].'/'.$rsAssign->id.'/'.$dsOut['id'])}}" ><i class="fa fa-pencil"></i></a></td>
	  		</tr>
	  		<?php $ctr++; ?>
	  	@endif
	  @endforeach
	  {!! Helper::closeResponsiveTable()!!}
	{!! Helper::closeAccordion() !!}
@endforeach
{!! Helper::accordion(array("id"=>"cobs","parent"=>"accView","label"=>"Observations & Attachments"))!!}
	<label>Remarks</label><br>
	{{$data['remarks']}}
	<br><label>Attachments</label><br>
	<ul>
		 
	@foreach($data['lstAttachments'] as $row)
		@if($row['status'] == "SUCCESS") 
			<li><a target="_new" href="{{$row['url']}}">{{$row['filename']}}</a></li>
		@endif
	@endforeach
	</ul>
{!! Helper::closeAccordion() !!}
</div>
<div class="modal fade text-left" id="mEdit" tabindex="-1" role="dialog" aria-labelledby="myAddBUlabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                {!!Helper::form(array("name"=>"frm","action"=>"admin/q4ereports/usage/edit","validate"=>"Yes"))!!}
                {!!Helper::hidden(array("name"=>"id","value"=>$rsAssign->id))!!}
                {!!Helper::hidden(array("name"=>"ansid","value"=>""))!!}
                {!!Helper::hidden(array("name"=>"fieldid","value"=>""))!!}
                <div class="modal-header">
                    <h4 class="modal-title" id="myAddBUlabel1">Edit</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                	<div class="row"><div class="col-md-12"><span id="spanName"></span></div></div>
                    {!! Helper::textbox(array("colspan"=>12,"label"=>"Answer","name"=>"answer","typ"=>"textarea","class"=>" validate[required]","required"=>"Yes","value"=>""))!!}
                    {!! Helper::textbox(array("colspan"=>12,"label"=>"Answer 1","name"=>"answer1","typ"=>"textarea","class"=>" validate[required]","required"=>"Yes","value"=>""))!!}
                    {!! Helper::textbox(array("colspan"=>12,"label"=>"Remarks","name"=>"remarks","typ"=>"textarea","class"=>" validate[required]","required"=>"Yes","value"=>""))!!}
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
                {!!Helper::close("form")!!}
            </div>
        </div>
    </div>
{!! Helper::closePage()!!}
@endsection
@section('myscript')
<script>
	$(".lnkEdit").on('click',function(){
		var ansid = $(this).data("id");
		var name = $(this).data("name");
		var answer = $(this).data("answer");
		var answer1 = $(this).data("answer1");
		var remarks = $(this).data("remarks");
		var fieldid = $(this).data("field");
		$("#ansid").val(ansid);
		$("#spanName").html(name);
		$("#answer").val(answer);
		$("#answer1").val(answer1);
		$("#remarks").val(remarks);
		$("#fieldid").val(fieldid);
		$("#mEdit").modal('show');
	});
</script>
@endsection