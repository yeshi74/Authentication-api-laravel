@extends('layouts/contentLayoutMaster')
@section('title', 'Close Periods')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    {!!Helper::form(array("name"=>"frm","action"=>"admin/q4eforms/close-periods/filter","validate"=>"Yes"))!!}
    <div class="row">
        {!! Helper::selectList(array("name"=>"typ","placeholder"=>"Select Type","colspan"=>4,"label"=>"Type","required"=>"Yes","class"=>"validate[required]","options"=>$lstFormTypes,"key"=>"id","val"=>"name","value"=>$data['typ'])) !!}
        {!! Helper::selectList(array("name"=>"period","placeholder"=>"Select Period","colspan"=>4,"label"=>"Period","required"=>"Yes","class"=>"validate[required]","options"=>$lstPeriods,"key"=>"id","val"=>"name","value"=>$data['per'])) !!}
        <div class="col-md-3">
            <button id="btnFilter" class="btn btn-primary formButton">Filter</button>
        </div>
    </div>
    {!! Helper::close("form")!!}
    @if($data["page"] == "FILTER")
        {!!Helper::form(array("name"=>"frmUpdate","action"=>"admin/q4eforms/close-periods/update","validate"=>"Yes"))!!}
        {!!Helper::hidden(array("name"=>"typ","value"=>$data['typ']))!!}
        {!!Helper::hidden(array("name"=>"typ","value"=>$data['per']))!!}
        {!!Helper::hidden(array("name"=>"status","value"=>""))!!}
        <div class="row">
            <div class="col-md-12">
                <button id="btnClose" type="button" class="btn btn-primary">Close Periods</button>
                <button id="btnOpen" type="button" class="btn btn-warning">Open Periods</button>
                <button id="btnDelete" type="button" class="btn btn-warning">Delete All Selected Forms</button>
                <button id="btnSelAll" type="button" class="btn btn-primary">Select All Forms</button>
            </div>
        </div>
        <br/><br>
        {!! Helper::responsiveTable(array("","Form","Status","Total","New","In Progress","Completed","Pending")) !!}
        @foreach($results as $row)
            <tr>
                <td><input class="chk" type="checkbox" name="f[]" value="{{$row['id']}}"/></td>
                <td><a href="{{url('admin/q4eforms/close-period/list/'.$row['formid'].'/'.$data['typ'].'/'.$data['per'])}}">{{$row['name']}}</a></td>
                <td>
                    <?php 
                        $status = $row['status'] == 0 ? "Open" : "Close"; 
                    ?>
                    {{$status}}
                </td>
                <td>{{$row['total']}}</td>
                <td>{{$row['new']}}</td>
                <td>{{$row['inprogress']}}</td>
                <td><a href="{{url('admin/q4eforms/close-period/clist/'.$row['formid'].'/'.$data['typ'].'/'.$data['per'])}}">{{$row['completed']}}</a></td>
                <td>{{$row['pending']}}</td>
            </tr>
        @endforeach
        {!! Helper::closeResponsiveTable() !!}
        {!! Helper::close("form")!!}
    @endif
    {!! Helper::closePage() !!}
@endsection
@section('myscript')
<script>
    $("#btnClose").on('click',function(){
        if(confirm("Are you sure you want to close the period for the selected forms?")){
            $("#status").val("CLOSE");
            $("#frmUpdate").submit();
        }
    });
    $("#btnOpen").on('click',function(){
        if(confirm("Are you sure you want to open the period for the selected forms?")){
            $("#status").val("OPEN");
            $("#frmUpdate").submit();
        }
    });
    $("#btnDelete").on('click',function(){
        if(confirm("Are you sure you want to delete the selected forms?")){
            $("#status").val("DELETE");
            $("#frmUpdate").submit();
        }
    });
    $("#btnSelAll").on('click',function(){
        $(".chk").attr('checked',true);
    });
</script>
@endsection
