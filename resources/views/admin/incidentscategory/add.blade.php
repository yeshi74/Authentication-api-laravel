@extends('layouts/contentLayoutMaster')
@section('title', 'Incident Category')
@section('content')
 
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>"")) !!}
  {!! Helper::form(array("name"=>"frm","action"=>"admin/incidents-category/save","validate"=>"Yes"))!!}
  {!! Helper::hidden(array("name"=>"parent","value"=>""))!!}
  <div class="row">
    <div class="col-md-12">
      {!! Helper::button(array("label"=>"Save","name"=>"btnSave","type"=>"button"))!!}
    </div>
  </div>
  {!! Helper::textbox(array("colspan"=>12,"name"=>"caption","label"=>"Caption","class"=>"validate[required]"))!!}
  <div class="row">
    
   
    {!! Helper::select(array("colspan"=>4,"label"=>"Type","name"=>"typ","options"=>array("CATEGORY"=>"Category","GROUP"=>"Group","ITEM"=>"Item")))!!}
    <div class="col-md-8" id="divGroup" style="display:none;">
      <label>Select Category</label>
      <select name="gparent" id="gparent" class="select2 form-control">
        @foreach($lstCategory as $r)
          <option value="{{$r->id}}">{{$r->caption}}</option>
        @endforeach
      </select>

    </div>
    <div class="col-md-8" id="divItem" style="display:none;">
      <div class="row">
        <div class="col-md-6">
          <label>Select Category</label>
          <select name="iparent" id="iparent" class="select2 form-control">
            <option value="">Select Category</option>
            @foreach($lstCategory as $r)
              <option value="{{$r->id}}">{{$r->caption}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-6">
          <label>Select Group</label>
          <select name="igroup" id="igroup" class="select2 form-control">
            <option value="">Select Group</option>
          </select>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    {!!Helper::textbox(array("colspan"=>2,"name"=>"ord","label"=>"Order","class"=>"validate[required]","typ"=>"NUMBER"))!!}
    {!! Helper::selectStatus(array("colspan"=>2,"label"=>"Status","name"=>"status"))!!}
  </div>
  {!! Helper::close("form") !!}
  {!! Helper::closePage() !!}
@endsection
@section('myscript')
<script>
var lstGroups = <?php echo json_encode($lstGroup); ?>;
$(document).ready(function(){
   $("#typ").on('change',function(){
    $("#divGroup").hide();
    $("#divItem").hide();
    var t = $(this).val();
    if(t == "GROUP"){
      $("#divGroup").show();
    }
    if(t == "ITEM"){
      $("#divItem").show();
    }
   });
  $("#iparent").on('change',function(){
    var c = $(this).val();
    $("#igroup").empty();
    var html = '<option value=""></option>';

    $.each(lstGroups, function(key,value) {
      if(value.parent == c){
        html = html + "<option value='" + value.id + "'>" + value.caption + "</option>";
      }
    }); 
     
   
    $("#igroup").html(html);
  }); 

  $("#btnSave").on('click',function(){
    var typ = $("#typ").val();
    var b = 0;
    var parent = 0;
    var grp="";
    if(typ=="GROUP"){
      parent = $("#gparent").val();
      if(parent == "") b=1;
    }
    if(typ=="ITEM"){
      parent = $("#iparent").val();
      grp = $("#igroup").val();
      if(parent == "" && grp=="") {
        b=1;
      }
      else{
        if(grp!="") parent = grp;
      }
    }
    if(b==1){
      alert("Required fields are not filled");
    }
    else{
      $("#parent").val(parent);
      if($("#frm").validationEngine('validate')){
        $("#frm").submit();
      }
    }
  });
});
</script>
@endsection

