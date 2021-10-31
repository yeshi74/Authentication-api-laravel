@extends('layouts/contentLayoutMaster')
@section('title', 'Evaluation Forms')
@section('content')
<?php 
  $cnt = count($lstTraining);
?>
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>"")) !!}
    {!! Helper::form(array("name"=>"frm","action"=>"admin/survey/edit","validate"=>"Yes")) !!}
    {!! Helper::hidden(array("name"=>"action","value"=>"edit")) !!}
    {!! Helper::hidden(array("name"=>"id","value"=>$id)) !!}
    <div class="row">
        {!! Helper::linkButton(array("colspan"=>2,"url"=>url('admin/survey/edit/'.$id),"btnEdit","label"=>"Edit","type"=>"submit","class"=>"btn btn-primary","data"=>array("action"=>"edit"))) !!}
        {!! Helper::button(array("colspan"=>3,"name"=>"btnDelete","label"=>"Delete","class"=>"btn-warning","type"=>"button"))!!}
    </div>
     {!! Helper::display(array("colspan"=>12,"label"=>"Name","name"=>"name","value"=>$results['name'])) !!}            
    <div class="row">
        <?php
            $status = ($results['status'] == 0 ? "Active" : "Suspend");
        ?>
       
        {!! Helper::display(array("colspan"=>4,"label"=>"Type","name"=>"name","value"=>$results['typ'])) !!}
        {!! Helper::display(array("colspan"=>4,"label"=>"Status","name"=>"status","value"=>$status)) !!}
        {!! Helper::display(array("colspan"=>4,"label"=>"Max. Points","name"=>"max_points","value"=>$results['max_points'])) !!}
    </div>
    <div class="row">
      <div class="col-md-12">
        <label>Used in</label><br/>
        @foreach($lstTraining as $row)
          <a href="{{url('admin/training/view/'.$row->id)}}">{{$row->subject}}</a>&nbsp;
        @endforeach
       
      </div>
    </div>
    <legend>Questions</legend>
    {!! Helper::responsiveTable(array("Order","Field Name","Field Type","Status"))!!}
    <?php
        foreach($lstSurveyField as $row):
        $status = $row['status'] == 0 ? "Active" : "Suspend";
      ?>
      <tr>
        <td>{!! $row['ord'] !!}</td>
        <td>{!! $row['field_name'] !!}</td>
        <td>{!! $row['field_type'] !!}</td>
        <td>{!! $status !!}</td>
      </tr>
      <?php
        endforeach;
      ?>
      {!! Helper::closeResponsiveTable()!!}
    {!! Helper::close("form")!!}
    {!! Helper::closePage() !!}
    {!! Helper::form(array("name"=>"frmDelete","action"=>"admin/survey/delete","validate"=>"Yes")) !!}
    {!! Helper::hidden(array("name"=>"id","value"=>$id)) !!}
    {!! Helper::close("form")!!}
@endsection

@section('myscript')
    <script>
        var url = "{{url('admin/survey/')}}";
        $(".btnAction").on('click',function(){
            var action = $(this).data("action");
            $("#action").val(action);
            if(confirm("Are you sure you want to perform this action?"))
            {
              var pURL = url + "/" + action;
              $('#frm').attr('action', pURL).submit();
            }
        });
        var used = '<?php echo $cnt ?>';
        used=0;
        $("#btnDelete").on('click',function(){
          if(used != 0){
            alert("Evaluation form used in training. Cannot delete");
          } else {
            if(confirm("Are you sure you want to delete?")) {
              $("#frmDelete").submit();
            }
          }
        });
    </script>
@endsection






