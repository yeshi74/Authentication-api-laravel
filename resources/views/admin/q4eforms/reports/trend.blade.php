@extends('layouts/contentLayoutMaster')
@section('title', 'Outcome Trend')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>""))!!}
{!!Helper::form(array("name"=>"frm","action"=>"admin/q4ereports/trend/export","target"=>"_new","validate"=>"Yes"))!!}
<div class="row">
    {!! Helper::selectList(array("name"=>"form","placeholder"=>"Select Form","colspan"=>4,"blank"=>"Yes","label"=>"Form","required"=>"Yes","class"=>"validate[required]","options"=>$lstForms,"key"=>"form_id","val"=>"formname")) !!}
    <div class="col-md-4">
        <label>Region</label>
        <select name="region" id="region" class="form-control select2">
        </select>
    </div>
	<div class="col-md-2">
		<button type="submit" class="btn btn-primary formButton">Export</button>
	</div>
</div>
{!! Helper::close("form")!!}
{!! Helper::closePage()!!}
@endsection
@section('myscript')
<script>
 var lstRegions = <?php echo json_encode($lstRegions); ?>;
  
 $("#form").on('change',function(){
 	var html = "<option  value=''>All Regions</option>";
 	var selForm = $(this).val();
 	for(var i=0;i<=lstRegions.length-1;i++){
 		if(lstRegions[i].form_id == selForm){
 			html = html + "<option value='" + lstRegions[i].region;
 			html = html + "'>" + lstRegions[i].regionname + "</option>";
 		}
 	}

 	$("#region").html(html);
 });
</script>
@endsection