@extends('layouts/contentLayoutMaster')
@section('title', 'Survey')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>"")) !!}
  {!! Helper::form(array("name"=>"frm","action"=>"admin/survey/update","validate"=>"Yes")) !!}
  {!! Helper::hidden(array("name"=>"action","value"=>"Update")) !!}
  {!! Helper::hidden(array("name"=>"id","value"=>$id)) !!}
  {!! Helper::button(array("colspan"=>12,"name"=>"btnUpdate","label"=>"Save","type"=>"button")) !!}
  {!! Helper::textbox(array("colspan"=>12,"label"=>"Name","name"=>"name","max"=>150,"placeholder"=>"Enter Name","class"=>"validate[required]","required"=>"Yes","value"=>$results['name']))!!}
  <div class="row">
      
      {!! Helper::select(array("colspan"=>4,"label"=>"Type","name"=>"typ","value"=>$results['typ'],"options"=>array("CheckList"=>"CheckList","Evaluation"=>"Evaluation","Survey"=>"Survey"))) !!}
      {!! Helper::selectStatus(array("colspan"=>4,"label"=>"Status","name"=>"status","value"=>$results['status'])) !!}
       {!! Helper::textbox(array("colspan"=>4,"label"=>"Max. Points","name"=>"max_points","placeholder"=>"Enter Maximum Points","class"=>"validate[required]","required"=>"Yes","typ"=>"NUMBER","value"=>$results['max_points'])) !!}
  </div>
  {!! Helper::close("form")!!}
  
   <legend>Add Survey Fields</legend>
  <div class="row">
    {!! Helper::button(array("colspan"=>4,"name"=>"btnAdd","label"=>"Add Survey Field","type"=>"button","class"=>"btn btn-primary"))!!}
  </div>
  
  <div id="addField" style="display:none;">
    {!! Helper::form(array("name"=>"frm","action"=>"admin/survey/surveyField","validate"=>"Yes"))!!}
    {!! Helper::hidden(array("name"=>"action","value"=>"saveSurveyField")) !!}
    {!! Helper::hidden(array("name"=>"id","value"=>$id))!!}
    {!! Helper::hidden(array("name"=>"surveyid","value"=>"")) !!}
    
    <br/>
    <div class="row">
      {!! Helper::textbox(array("colspan"=>4,"label"=>"Field Name","name"=>"field_name","max"=>150,"placeholder"=>"Enter Field Name","class"=>"validate[required]","required"=>"Yes","value"=>""))!!}
      {!! Helper::textbox(array("colspan"=>4,"label"=>"Order","name"=>"ord","type"=>"number","placeholder"=>"Enter Order","class"=>"validate[required,custom[number]],","required"=>"Yes","value"=>""))!!}
      {!! Helper::selectStatus(array("colspan"=>4,"label"=>"Status","name"=>"status","value"=>"")) !!}
    </div>
    
    <div class="row">
      {!! Helper::select(array("colspan"=>4,"label"=>"Field Type","name"=>"field_type","value"=>"","options"=>array("SELECT"=>"Selection","TEXT"=>"Text"))) !!}
    </div>
    <div class="row">
      <div class="col-md-12" id="divOptions">
        <table border="0" class="table table-striped">
          <tr>
            <th>Option</th><th>Weightage</th>
          </tr>
          <?php for($ctr=1;$ctr<=5;$ctr++) { ?>
            <tr>
              <td><input type="text" name="fld<?php echo $ctr ?>" class="form-control"></td>
              <td><input type="number" name="points<?php echo $ctr ?>" class="form-control"></td>
            </tr>
          <?php } ?>
        </table>
      </div>
    </div>
    
    <div class="row">
      {!! Helper::button(array("colspan"=>12,"class"=>"btn btn-primary","label"=>"Save Field","type"=>"submit")) !!}
    </div>
    {!! Helper::close("form") !!}
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="table responsive">
          <table class="table table-striped dataex-html5-selectors">
            <thead>
              <tr>
                <th>Order</th>
                <th>Field Name</th>
                <th>Field Type</th>
                <th>Options</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($lstSurveyField as $row):
                 $status = $row['status'] == 0 ? "Active" : "Suspend";
                $url ="<a title='Edit' href='".url('/admin/survey/editSurveyField/'.$id."/".$row->id)."'><i class='fa fa-pencil'></i></a>";
              ?>
              <tr>
                <td>{!! $row['ord'] !!}</td>
                <td>{!! $row['field_name'] !!}</td>
                <td>{!! $row['field_type'] !!}</td>
                <td>{!! $row['html'] !!}</td>
                <td>{!! $status !!}</td>
                <td>{!! $url !!}</td>
              </tr>
              <?php
                endforeach;
              ?>
            </tbody>
          </table>
      </div>
  </div>
  </div>
  {!! Helper::close("form") !!}
  {!! Helper::closePage() !!}
@endsection

@section('myscript')
  <script>
     $("#btnUpdate").on('click',function()
      {
        $("#frm").submit();
      });
      $("#btnAdd").on('click',function(){
        $("#addField").show();
      });
    $("#field_type").on('change',function(){
      $("#divOptions").hide();
      var t = $(this).val();
      if(t=="SELECT"){
        $("#divOptions").show();
      }
    });

  </script>
@endsection




