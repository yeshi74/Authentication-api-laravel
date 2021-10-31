<?php
    use App\Helpers\ApolloHelpers;
?>
@extends('layouts/contentLayoutMaster')
@section('title', 'Training')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
    {!! Helper::form(array("name"=>"frm","action"=>"admin/training/users/update","validate"=>"Yes"))!!}
    {!! Helper::hidden(array("name"=>"id","value"=>$id))!!}

    <div class="row">
        <div class="col-md-12">
            {!! Helper::linkButton(array("url"=>url('admin/training/edit/'.$id),"label"=>"Edit","class"=>"btn btn-primary"))!!}
        </div>
    </div>
    <?php
        $status = ($results['status'] == 0 ? "Active" : "Suspend");
        $startDate = date('d/m/Y H:i',strtotime($results['training_date'])); 
        $endDate = date('d/m/Y H:i',strtotime($results['training_edate'])); 
    ?>
    <div class="row">
        {!! Helper::display(array("colspan"=>6,"label"=>"Subject","name"=>"subject","value"=>$results['subject'])) !!}
        {!! Helper::display(array("colspan"=>3,"label"=>"Category","name"=>"category","value"=>$results['categoryname'])) !!}
        {!! Helper::display(array("colspan"=>3,"label"=>"Mode","name"=>"mode","value"=>$results['modename'])) !!}
    </div>
    <div class="row">
        {!! Helper::display(array("colspan"=>6,"label"=>"Start Date","name"=>"date","value"=>$startDate))!!}
        {!! Helper::display(array("colspan"=>6,"label"=>"End Date","name"=>"date","value"=>$endDate))!!}
    </div>
    {!! Helper::display(array("colspan"=>12,"label"=>"Location","name"=>"date","value"=>$results['location']))!!}
    <div class="row">
        {{-- {!! Helper::attachment(array("colspan"=>6,"label"=>"Attachment","id"=>$results['id'],"module"=>"TRAINING","value"=>$results['attachment'])) !!} --}}
        {!! Helper::display(array("colspan"=>3,"label"=>"Before Evalutaion","name"=>"before_survey","value"=>$results['beforeSurveyName'])) !!}
        {!! Helper::display(array("colspan"=>3,"label"=>"After Evalutaion","name"=>"after_survey","value"=>$results['afterSurveyName'])) !!}
        {!! Helper::display(array("colspan"=>3,"label"=>"Status","value"=>$status)) !!}
    </div>
    <br/>
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
    {!! Helper::close("form") !!}
    {!! Helper::form(array("name"=>"frm","action"=>"admin/training/users/delete","validate"=>"Yes"))!!}
    {!! Helper::hidden(array("name"=>"id","value"=>$id))!!}
    {!! Helper::accordion(array("id"=>"c1","parent"=>"accView","label"=>"Users Attending"))!!}
        <div class="row">
            <div class="col-md-12 text-right">
                <button type="submit" id="btnSubmit" class="btn btn-warning">Delete</button>
                <button type="button" id="btnExistAll" class="btn btn-primary">Select All</button>
                <button type="button" id="btnExistRemove" class="btn btn-primary">Unselect All</button>
            </div>
        </div>
        {!! Helper::responsiveTable(array("","User","Status","Start Date","Complete Date","Last Attend","Before Evaluation","After Evaluation"))!!}
        @foreach($lstUsers as $row)
            <tr>
                <td><input type="checkbox" name="userid[]" value="{{$row->user_id}}" class="chkExisting"></td>
                <td>{{$row->username}}</td>
                <td>{{$row->statusName}}</td>
                <td>{{$row->fStartDate}}</td>
                <td>{{$row->fCompleteDate}}</td>
                <td>{{$row->fLastAttend}}</td>
                <td><a href="{{url('admin/training/viewsurvey/before/'.$row['id'])}}">{{$row->beforeSurvey}}</a></td>
                 <td><a href="{{url('admin/training/viewsurvey/after/'.$row['id'])}}">{{$row->afterSurvey}}</a></td>
            </tr>
        @endforeach
        {!! Helper::closeResponsiveTable()!!}
    {!! Helper::closeAccordion() !!}
    {!! Helper::close("form") !!}
    {!! Helper::closePage() !!}
@endsection

@section('myscript')
<script>
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
            
            var uURL = "{{url('admin/training/users/search/')}}";
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
            //$("#divResults").html('<table><tr><td><input type="checkbox" name="chk" class="chk" value="10"></td><td>ABBC</td></tr><tr><td><input type="checkbox" name="chk" class="chk" value="10"></td><td>ABBC</td></tr></table>');
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
