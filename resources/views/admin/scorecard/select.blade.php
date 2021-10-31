@extends('layouts/contentLayoutMaster')
@section('title', 'Scorecard')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
  {!! Helper::form(array("name"=>"frm","action"=>"admin/scorecard/export-selected")) !!}
  {!! Helper::hidden(array("name"=>"code","value"=>$data['code']))!!}
  {!! Helper::hidden(array("name"=>"period","value"=>$data['period']))!!}
  {!! Helper::hidden(array("name"=>"typ","value"=>$data['typ']))!!}
  {!! Helper::hidden(array("name"=>"form","value"=>$data['form']))!!}
  <div class="row">
    <div class="col-md-4">
      <label>Period</label><br>
      @foreach($options['lstPeriods'] as $row)
        @if($row['id'] == $data['period'])
          {{$row['name']}}
        @endif
      @endforeach
    </div>
    <div class="col-md-4">
      <label>Type</label><br>
      @foreach($options['lstType'] as $row)
        @if($row['id'] == $data['typ'])
          {{$row['name']}}
        @endif
      @endforeach
    </div>
    <div class="col-md-4">
      <label>Form</label><br>
      @foreach($options['lstForms'] as $row)
        @if($row['id'] == $data['form'])
          {{$row['name']}}
        @endif
      @endforeach
    </div>
  </div>
  @if($data['code'] == "OUTCOME")
  <label>Select Fields</label>
  <br/><input type="checkbox" name="chkAllFields" value="1" checked>&nbsp;Include All Items in the report<br/>
    <select name="sec" multiple class="form-control select2">
    @foreach($rsFields as $frow)
      <option value="{{$frow->id}}">{{$frow->parameter}}</option>
    @endforeach
    </select>
  @else
    @foreach($rsSections as $srow)
      <h4>{{$srow->name}}</h4><br/>
      <input type="checkbox" name="check{{$srow->id}}" value="1" checked>&nbsp;Include All Items in this section in the report<br/>
      <select name="sec{{$srow->id}}[]" multiple class="form-control select2">
      @foreach($rsFields as $frow)
        @if($frow->section_id == $srow->id)
          <option value="{{$frow->id}}">{{$frow->name}}</option>
        @endif
      @endforeach
      </select>
    @endforeach
  @endif
   <div class="row">
    <div class="col-md-12" style="text-align:right">
      <button type="submit" name="btnSubmit" class="btn btn-primary">Filter</button>
    </div>
  </div>
  {!! Helper::close("form")!!}
  {!! Helper::closePage() !!}
 
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
  var typ = '{{$data["typ"]}}';
  showForms(typ);
  var frm = '{{$data["form"]}}';
  $("#form").val(frm);

  var url = "{{url('admin/scorecard/')}}";
  $("#btnSelect").on('click',function(){
    var pURL = url + "/select";
    $('#frm').attr('action', pURL).submit();
  });
</script>
@endsection
