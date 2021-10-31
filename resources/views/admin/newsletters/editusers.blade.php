<?php
    use App\Helpers\ApolloHelpers;
?>
@extends('layouts/contentLayoutMaster')
@section('title', 'Communications')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>"")) !!}
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div><br />
    @endif
    {!! Helper::form(array("name"=>"frm","action"=>"admin/newsletters/update","validate"=>"Yes")) !!}
    {!! Helper::hidden(array("name"=>"action","value"=>"update")) !!}
    {!! Helper::hidden(array("name"=>"id","value"=>$id)) !!}
    {!! Helper::button(array("colspan"=>12,"name"=>"btnUpdate","label"=>"Update","type"=>"submit")) !!}
    
    <div class="row">
        {!! Helper::display(array("colspan"=>6,"label"=>"Subject","value"=>$results['subject'])) !!}
        {!! Helper::display(array("colspan"=>3,"label"=>"Period","value"=>$results['period'])) !!}
        {!! Helper::display(array("colspan"=>3,"label"=>"Status","value"=>$results['status'] == 0 ? "Active" : "Suspend")) !!}
    </div>
    <div class="row">
        {!! Helper::display(array("colspan"=>3,"label"=>"Type","value"=>$results['typ']))!!}
        <div class="col-md-9">
            @if($results['typ'] =="PDF")
                <div class="row">
                    {!! Helper::attachment(array("colspan"=>6,"label"=>"Existing NewsLetter Attachment","id"=>$results['id'],"module"=>"NEWSLETTERS","value"=>$results['file'])) !!}
                </div>
            @endif
            @if($results['typ']=="VIDEO")
                <div class="row">
                    <div class="col-md-9">
                        <iframe src="https://youtube.com/embed/{{$results['video']}}?rel=0" width="100%" frameborder=0 height="150px;"></iframe>
                    </div>
                </div>
            @endif
        </div>
    </div>
    
    
    {!! Helper::display(array("colspan"=>12,"label"=>"Summary","name"=>"summary","placeholder"=>"Enter Summary","class"=>"validate[required]","required"=>"Yes","value"=>$results['summary'],"typ"=>"HTML")) !!}
    <div class="accordion" id="accView">
    {!! Helper::accordion(array("id"=>"c0","parent"=>"accView","label"=>"Add Users"))!!} 
    <div class="row">
      <div class="col-md-4">
        <select name="lstBU" id="lstBU" class="form-control">
          <option value=""></option>
          @foreach($lstBU as $row)
            <option value="{{$row->id}}">{{$row->name}}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-4">
        <select name="lstCenter" id="lstCenter" class="form-control">
        </select>
      </div>
      <div class="col-md-4">
        <button id="btnSearch" type="button" class="btn btn-primary">Search</button>
      </div>
    </div>
    <div class="row" id="divResButton" style="display:none;">
      <div class="col-md-12">
        <button type="submit" id="btnSubmit" class="btn btn-warning">Update</button>
        <button type="button" id="btnNewAll" class="btn btn-primary">Select All</button>
        <button type="button" id="btnNewRemove" class="btn btn-primary">Unselect All</button>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div id="divResults">
        </div>
      </div>
    </div>
    {!! Helper::closeAccordion() !!}
    {!! Helper::accordion(array("id"=>"c1","parent"=>"accView","label"=>"Existing Users"))!!} 
   
    {!! Helper::responsiveTable(array("Name","Emp. Code","Location",""))!!}
      @foreach($lstUsers as $row)
        <tr>
          <td>{!!$row['name']!!}</td>
          <td>{!!$row['empcode']!!}</td>
          <td>{!!$row['location']!!}</td>
          <td><a href="Javascript:void(0)" data-id="{{$row['id']}}" class="lnkDel"><i class="fa fa-trash"></i></a></td>
        </tr>
      @endforeach
      {!! Helper::closeResponsiveTable()!!}
    {!! Helper::closeAccordion() !!}
  </div>
    {!! Helper::close("form") !!}
     {!! Helper::closePage() !!}
  {!! Helper::form(array("name"=>"frmDelUser","action"=>"admin/newsletters/users/remove","validate"=>"Yes"))!!}
  {!! Helper::hidden(array("name"=>"id","value"=>$id))!!}
  {!! Helper::hidden(array("name"=>"userid","value"=>""))!!}
  {!! Helper::close("form")!!}
    {{-- {!! Helper::gallery(array("module"=>"NEWSLETTERS","id"=>$id,"mode"=>"EDIT")) !!} --}}
    {!! Helper::closePage() !!}
@endsection


@section('myscript')
<script>
    $(".lnkDel").on('click',function(){
    var id = $(this).data("id");
    if(confirm("Are you sure you want to remove this user?")){
      $("#userid").val(id);
      $("#frmDelUser").submit();
    }
  });
    var buList = <?php echo json_encode($lstBU) ?>;
    var centerList = <?php echo json_encode($lstCenters) ?>;
    $("#lstBU").on('change',function(){
        var i = $(this).val();
        $("#lstCenter").empty();
        var html = "";
        for(var k=0;k <= centerList.length-1;k++){
            if(centerList[k].bu == i){
                html = html + '<option value="' + centerList[k].id + '">' + centerList[k].name + '</option>';
            }
        }
        $("#lstCenter").html(html);
    });
    $("#btnNewAll").on('click',function(){
        $(".chk").attr('checked',true);
    });
    $("#btnNewRemove").on('click',function(){
        $(".chk").attr('checked',false);
    });
    $("#btnUExistAll").on('click',function(){
        $(".chkExisting").attr('checked',true);
    });
    $("#btnExistRemove").on('click',function(){
        $(".chkExisting").attr('checked',false);
    });
    $("#btnSearch").on('click',function(){
        var center = $("#lstCenter").val();
        $("#divResButton").hide();
        if(center != "") {
            
            var uURL = "{{url('admin/newsletters/users/search/')}}";
            uURL = uURL + "/" + center;
            $.ajax({
                url: uURL,
                type: 'GET',
                success: function (data) {
                    $("#divResults").html(data) 
                    if(data != ''){
                        $("#divResButton").show();
                    }
                }
            });
        }
    });
    var url = "{{url('admin/training/')}}";
    $(".btnAction").on('click',function(){
        var action = $(this).data("action");
        $("#action").val(action);
        if(confirm("Are you sure you want to perform this action?"))
        {
            var pURL = url + "/" + action;
            $('#frm').attr('action', pURL).submit();
        }
    });

</script>
@endsection