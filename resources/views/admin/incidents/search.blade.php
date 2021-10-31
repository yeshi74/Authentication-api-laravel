<style>
.btnMT20 {margin-top:20px;}
</style>
{!! Helper::form(array("name"=>"frmSearch","action"=>"admin/incidents/search","validate"=>"Yes"))!!}
<legend>Search</legend>
<div class="row">
	{!!Helper::textbox(array("colspan"=>3,"label"=>"From Date","name"=>"search_from_date","typ"=>"DATE","value"=>$params['search_from_date']))!!}
	{!!Helper::textbox(array("colspan"=>3,"label"=>"To Date","name"=>"search_to_date","typ"=>"DATE","value"=>$params['search_to_date']))!!}
	{!!Helper::selectList(array("colspan"=>3,"label"=>"Category","name"=>"search_category","options"=>$params['search_lst_category'],"key"=>"id","val"=>"name","value"=>$params['search_category'],"blank"=>"Yes"))!!}
	{!!Helper::select(array("colspan"=>3,"label"=>"Grade","name"=>"search_grade","options"=>$params['search_lst_grade'],"value"=>$params['search_grade'],"blank"=>"Yes"))!!}
</div>
<div class="row">
	{!!Helper::select(array("colspan"=>2,"label"=>"Status","name"=>"search_status","options"=>$params['search_lst_status'],"value"=>$params['search_status']))!!}
	{!!Helper::selectList(array("colspan"=>3,"label"=>"BU","name"=>"search_bu","options"=>$lstBU,"key"=>"id","val"=>"name","blank"=>"Yes","value"=>$params['search_bu']))!!}
	<div class="col-md-3">
		<label>Center</label>
		<select id="search_center" name="search_center" class="form-control select2">
		</select>
	</div>
	{!!Helper::select(array("colspan"=>2,"label"=>"HOD Status","name"=>"search_hod","blank"=>"Yes","options"=>$params['search_lst_hod'],"value"=>$params['search_hod']))!!}
	{!! Helper::button(array("colspan"=>2,"label"=>"Search","name"=>"btnSearch","type"=>"submit","class"=>"btn btn-primary btnMT20"))!!}
 </div>
{!! Helper::close("form")!!}
{!! Helper::form(array("name"=>"frmReport","action"=>"admin/incidents/report","target"=>"_blank"))!!}
{!! Helper::hidden(array("name"=>"report_from_date","value"=>""));!!}
{!! Helper::hidden(array("name"=>"report_to_date","value"=>""));!!}
{!! Helper::hidden(array("name"=>"report_category","value"=>""));!!}
{!! Helper::hidden(array("name"=>"report_grade","value"=>""));!!}
{!! Helper::hidden(array("name"=>"report_status","value"=>""));!!}
{!! Helper::close("form")!!}
<script>
var centers = <?php echo json_encode($lstCenters); ?>;
var selCenter = '<?php echo $params["search_center"] ?>';
var selBU = '<?php echo $params["search_bu"] ?>';
$("#search_bu").on('change',function(){
	var id = $(this).val();
	fillCenter(id);
});
function fillCenter(id)
{
	var html = '<option value=""></option>';
	for(var i=0;i<=centers.length-1;i++){
		if(centers[i].bu == id){
			html = html + '<option value="' + centers[i].id + '"';
			if(centers[i].id == selCenter) {
				html = html + " selected";
			}
			html = html + '>' + centers[i].name + '</option>';
		}
	}
	$("#search_center").html(html);
}
$("#search_bu").val(selBU);
$("#search_center").val(selCenter);
fillCenter(selBU);
</script>