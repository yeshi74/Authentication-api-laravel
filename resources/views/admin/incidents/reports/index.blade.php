@extends('layouts/contentLayoutMaster')
@section('title', 'Incidents')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
{!! Helper::form(array("name"=>"frm","action"=>"admin/incidents/report/filter","validate"=>"Yes","target"=>"_blank"))!!}   
<div class="row">
  {!! Helper::selectList(array("colspan"=>2,"name"=>"bu","label"=>"BU","options"=>$lstBU,"key"=>"id","val"=>"name"))!!}
  <div class="col-md-2">
    <label>Region</label>
    <select name="region" id="region" class="form-control select2"></select>
  </div>
  <div class="col-md-2">
    <label>Center</label>
    <select name="center" id="center" class="form-control select2"></select>
  </div>
  {!! Helper::textbox(array("colspan"=>3,"name"=>"fdate","label"=>"From","value"=>$data['fdate'],"typ"=>"DATE"))!!}
  {!! Helper::textbox(array("colspan"=>3,"name"=>"tdate","label"=>"To","value"=>$data['tdate'],"typ"=>"DATE"))!!}
</div>
<div class="row">
  <div class="col-md-12" style="text-align:right;">
    <button type="button" class="btn btn-primary formButton" id="btnExport">Download</button>
  </div>
</div>
{!! Helper::close("form")!!}
{!! Helper::closePage() !!}
@endsection
@section('myscript')
<script>
  var lstRegions = <?php echo json_encode($lstRegion); ?>;
  var lstCenters = <?php echo json_encode($lstCenters); ?>;
  var selBU = '{{$data["bu"]}}';
  var selRegion = '{{$data["region"]}}';
  var selCenter = '{{$data["center"]}}';

  $("#bu").on('change',function(){
    var id = $(this).val();
    fillRegions(id);
  });
  $("#region").on('change',function(){
    var id = $(this).val();
    fillCenters(id);
  });
  function fillRegions(bu)
  {
    var html = '<option value=""></option>';
    for(var i = 0; i<=lstRegions.length-1;i++){
      if(lstRegions[i].parent == bu){
        html = html + '<option value="' + lstRegions[i].id + '">' + lstRegions[i].name + '</option>';
      }
    }
    $("#region").html(html);
    html = '<option value=""></option>';
    $("#center").html(html);
  }
  function fillCenters(region)
  {
    var html = '<option value=""></option>';
    var html = '';
    for(var i = 0; i<=lstCenters.length-1;i++){
      if(lstCenters[i].bu_id == bu && lstCenters[i].region_id == region){
        html = html + '<option value="' + lstCenters[i].center_id + '">' + lstCenters[i].center_name + '</option>';
      }
    }
    $("#center").html(html);
  }
  fillRegions($("#bu").val());
  $("#btnExport").on('click',function(){
    $("#frm").submit();
  })
</script>
@endsection