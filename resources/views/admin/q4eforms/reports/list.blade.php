@extends('layouts/contentLayoutMaster')
@section('title', 'Q4e Forms')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>""))!!}
{!!Helper::form(array("name"=>"frm","action"=>"admin/q4eforms/usage/report/".$data['typ']."/".$data['code'],"validate"=>"Yes"))!!}
{!!Helper::hidden(array("name"=>"code","value"=>$data['code']))!!}
{!!Helper::hidden(array("name"=>"typ","value"=>$data['typ']))!!}
<div class="row">
	{!! Helper::selectList(array("name"=>"form","placeholder"=>"Select Form","colspan"=>4,"label"=>"Form","required"=>"Yes","blank"=>"Yes","class"=>"validate[required]","options"=>$lstForms,"key"=>"id","val"=>"name","value"=>$data['form'])) !!}
	<div class="col-md-3">
		<label>Location</label>
		<select name="location" id="location" class="form-control select2">
		</select>
	</div>
	<div class="col-md-3">
		<label>Period</label>
		<select name="period" id="period" class="form-control select2">
		</select>
	</div>
	<div class="col-md-2">
		<button type="submit" class="btn btn-primary formButton">List Usage</button>
	</div>
</div>
{!! Helper::close("form")!!}
{!! Helper::closePage()!!}
@endsection
@section('myscript')
<script>
 var locations = <?php echo json_encode($lstLocations); ?>;
 var periods = <?php echo json_encode($lstPeriods); ?>;
 var selLocation = '{{$data["location"]}}';
 var selPeriod = '{{$data["period"]}}';
 $("#form").on('change',function(){
 	var html = "";
 	var phtml = "";
 	var selForm = $(this).val();
 	for(var i=0;i<=locations.length-1;i++){
 		if(locations[i].form == selForm){
 			html = html + "<option value='" + locations[i].id;
 			if(selLocation == locations[i].id){
 				html = html + " selected";
 			}
 			html = html + "'>" + locations[i].name + "</option>";
 		}
 	}
 	for(var i=0;i<=periods.length-1;i++){
 		if(periods[i].form == selForm){
 			phtml = phtml + "<option value='" + periods[i].id;
 			if(selPeriod == periods[i].id){
 				phtml = phtml + " selected";
 			}
 			phtml = phtml + "'>" + periods[i].name + "</option>";
 		}
 	}
 	$("#location").html(html);
 	$("#period").html(phtml);
 });
</script>
@endsection