@extends('layouts/contentLayoutMaster')
@section('title', 'Survey')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>"")) !!}
  {!! Helper::form(array("name"=>"frm","action"=>"admin/survey/updateServeyField","validate"=>"Yes")) !!}
  {!! Helper::hidden(array("name"=>"action","value"=>"updateSurveyField")) !!}
  {!! Helper::hidden(array("name"=>"id","value"=>$id)) !!}
  {!! Helper::hidden(array("name"=>"surveyid","value"=>$surveyid)) !!}
  {!! Helper::button(array("colspan"=>12,"name"=>"btnUpdate","label"=>"Save","type"=>"submit")) !!}
  
  <div class="row">
      {!! Helper::textbox(array("colspan"=>4,"label"=>"Field Name","name"=>"field_name","max"=>150,"placeholder"=>"Enter Field Name","class"=>"validate[required]","required"=>"Yes","value"=>$results['field_name']))!!}
      {!! Helper::textbox(array("colspan"=>4,"label"=>"Order","name"=>"ord","type"=>"number","placeholder"=>"Enter Order","class"=>"validate[required,custom[number]],","required"=>"Yes","value"=>$results['ord']))!!}
      {!! Helper::selectStatus(array("colspan"=>4,"label"=>"Status","name"=>"status","value"=>$results['status'])) !!}
  </div>
  <div class="row">
      {!! Helper::select(array("colspan"=>4,"label"=>"Field Type","name"=>"field_type","value"=>$results['field_type'],"options"=>array("SELECT"=>"Selection","TEXT"=>"Text"))) !!}
  </div>
  <div class="row">
      <div class="col-md-12" id="divOptions">
        <table border="0" class="table table-striped">
          <tr>
            <th>Option</th><th>Weightage</th>
          </tr>
          <?php for($ctr=1;$ctr<=5;$ctr++) { ?>
            <tr>
              <td><input type="text" value="{{$results['fld'.$ctr]}}" name="fld<?php echo $ctr ?>" class="form-control"></td>
              <td><input type="number" value="{{$results['points'.$ctr]}}" name="points<?php echo $ctr ?>" class="form-control"></td>
            </tr>
          <?php } ?>
        </table>
      </div>
    </div>
  {!! Helper::close("form") !!}
  {!! Helper::closePage() !!}
@endsection

@section('myscript')
  <script>
    
      $("#field_type").on('change',function(){
      var t = $(this).val();
      if(t=="SELECT"){
        $("#options").show();
      }
    });
  </script>
@endsection
