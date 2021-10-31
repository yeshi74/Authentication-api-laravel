@extends('layouts/contentLayoutMaster')
@section('title', 'Scorecard')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
  {!! Helper::form(array("name"=>"frm","action"=>"admin/scorecard/filter")) !!}
  <div class="row">
    {!! Helper::selectList(array("colspan"=>4,"label"=>"Period","name"=>"period","options"=>$options['lstPeriods'],"key"=>"id","val"=>"name","value"=>$data['period']))!!}
    {!! Helper::selectList(array("colspan"=>4,"blank"=>"Yes","label"=>"Type","name"=>"typ","options"=>$options['lstType'],"key"=>"id","val"=>"name","required"=>"Yes","value"=>$data['typ']))!!}
    <div class="col-md-4">
      <label>Form</label>
      <select id="form" name="form" required class="form-control select2">
      </select>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12" style="text-align:right">
      <button type="button" name="btnSelect" id="btnSelect" class="btn btn-primary">Select Fields</button>
      <button type="submit" name="btnSubmit" class="btn btn-primary">Filter</button>
      <button type="button" name="btnExport" id="btnExport" class="btn btn-danger">Export to Excel</button>
    </div>
  </div>

  {!! Helper::close("form")!!}
  @if($data['pg']=="RESULTS")
    {!! Helper::responsiveTable(array("User","Location","Center","Period","Assigned Date","Status","Completed Date","Score"))!!}
    @foreach($results as $row)
      <tr>
        <td>{{$row['userName']}}</td>
        <td>{{$row['location']}}</td>
        <td>{{$row['center']}}</td>
        <td>{{$row['period']}}</td>
        <td>{{$row['assignedDate']}}</td>
        <td>{{$row['statusName']}}</td>
        <td>{{$row['completedDate']}}</td>
        <td style="background:{{$row['bgColor']}};color:{{$row['foreColor']}}">{{$row['score']}}</td>
      </tr>
    @endforeach
    {!! Helper::closeResponsiveTable()!!}
  @endif
  {!! Helper::closePage() !!}
  {!! Helper::form(array("name"=>"frmExport","action"=>"admin/scorecard/export","target"=>"_new")) !!}
  {!! Helper::hidden(array("id"=>"hdfPeriod","name"=>"period","value"=>""))!!}
  {!! Helper::hidden(array("id"=>"hdfType","name"=>"typ","value"=>""))!!}
  {!! Helper::hidden(array("id"=>"hdfForm","name"=>"form","value"=>""))!!}
  {!! Helper::close("form")!!}
@endsection

@section('myscript')
<script>
  var lstForms = <?php echo json_encode($options['lstForms']); ?>;
  var selForm = '<?php echo $data["form"]; ?>';
  $("#typ").on('change',function(){
    var id = $(this).val();
    showForms(id);
  });
  function showForms(id)
  {
     var html = '';
    for(var i = 0;i<=lstForms.length-1;i++){
      if(lstForms[i].typ == id){
        html = html + '<option value="' + lstForms[i].id + '"';
        if(selForm == lstForms[i].id){
          html = html + ' selected';
        }
        html = html + '>' + lstForms[i].name + '</option>';
      }
    }
    $("#form").html(html);
  }
  @if($data['pg']=="RESULTS")
    var typ = '{{$data["typ"]}}';
    showForms(typ);
  @endif
  var url = "{{url('admin/scorecard/')}}";
  $("#btnSelect").on('click',function(){
    var pURL = url + "/select";
    $('#frm').attr('action', pURL).submit();
  });

  $("#btnExport").on('click',function(){
    var per = $("#period").val();
    var typ = $("#typ").val();
    var frm = $("#form").val();
    $("#hdfPeriod").val(per);
    $("#hdfType").val(typ);
    $("#hdfForm").val(frm);
    $("#frmExport").submit();
  });
</script>
@endsection
