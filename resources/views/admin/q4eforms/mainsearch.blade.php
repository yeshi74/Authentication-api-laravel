@extends('layouts/contentLayoutMaster')
@section('title', 'Forms & Surveys')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    {!!Helper::form(array("name"=>"frm","action"=>"admin/q4eforms/".$data['ftype']."/close-period","validate"=>"Yes"))!!}
    {!!Helper::hidden(array("name"=>"code","value"=>$data['code']))!!}
    {!!Helper::hidden(array("name"=>"formid","value"=>$data['formid']))!!}
    {!!Helper::hidden(array("name"=>"per","value"=>$data['per']))!!}
    {!!Helper::hidden(array("name"=>"ftype","value"=>$data['ftype']))!!}
    @if($data['periodStatus'] == 0)
        <div class="row">
            <div class="col-md-12">
                {!! Helper::button(array("type"=>"button","name"=>"btnClose","label"=>"Close Period","class"=>"btn btn-primary"))!!}
            </div>
        </div>
    @endif
    {!! Helper::close("form")!!}
    <div class="row">
        {!! Helper::display(array("colspan"=>4,"label"=>"Form","value"=>$data['formName']))!!}
        {!! Helper::display(array("colspan"=>4,"label"=>"Period","value"=>$data['periodName']))!!}
        {!! Helper::display(array("colspan"=>4,"label"=>"Status","value"=>$data['periodStatusName']))!!}
    </div>
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" aria-controls="all" role="tab" aria-selected="true">All ({{$count['all']}})</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($count['progress'] == 0) echo 'disabled'; ?>" id="progress-tab" data-toggle="tab" href="#progress" aria-controls="progress" role="tab" aria-selected="false">In Progress ({{$count['progress']}})</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($count['completed'] == 0) echo 'disabled'; ?>" id="completed-tab" data-toggle="tab" href="#completed" aria-controls="completed" role="tab" aria-selected="false">Completed ({{$count['completed']}})</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="all" aria-labelledby="all-tab" role="tabpanel">
            {!! Helper::responsiveTable(array("Region","Location","User","Score","Assigned On","Completed On","Status","")) !!}
                @foreach($results as $row)
                    <tr>
                        <td>{{$row['region']}}</td>
                        <td>{{$row['locname']}}</td>
                        <td>
                            @if($code=="OUTCOME" && $row['status'] == 20)
                                <a href="{{url('admin/q4eforms/outcome/outcome/viewresults/'.$row['id'])}}">{{$row['username']}}</a>
                            @else
                                {{$row['username']}}
                            @endif
                        </td>
                        <td style="color:#fff;background:{{$row['scoreColor']}}">{{$row['totalScore']}}</td>
                        <td>{{$row['assignDate']}}</td>
                        <td>{{$row['completeDate']}}
                        @if($row['forced_closed']==1)
                                <br><strong><span style="color:red"><i class="fa fa-circle"></i></span>&nbsp;Closed by system</strong>
                            @endif
                        </td>
                        <td>{{$row['statusName']}}</td>
                        <td>
                            {{-- <a href="Javascript:void(0)" class="lnkEdit" data-id="{{$row['id']}}"><i class="fa fa-pencil"></i></a> --}}
                            <a href="Javascript:void(0)" class="lnkDel" data-id="{{$row['id']}}"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            {!! Helper::closeResponsiveTable() !!}
        </div>
        <div class="tab-pane" id="progress" aria-labelledby="progress-tab" role="tabpanel">
           {!! Helper::responsiveTable(array("User","Location","Score","Assigned On","Completed On","Status","")) !!}
                @foreach($results as $row)
                    @if($row['status'] == 10)
                        <tr>
                            <td>
                                @if($code=="OUTCOME" && $row['status'] == 20)
                                    <a href="{{url('admin/q4eforms/outcome/outcome/viewresults/'.$row['id'])}}">{{$row['username']}}</a>
                                @else
                                    {{$row['username']}}
                                @endif
                            </td>
                            <td>{{$row['locname']}}</td>
                            <td>{{$row['totalScore']}}</td>
                            <td>{{$row['assignDate']}}</td>
                            <td>{{$row['completeDate']}}</td>
                            <td>{{$row['statusName']}}</td>
                            <td>
                                {{-- <a href="Javascript:void(0)" class="lnkEdit" data-id="{{$row['id']}}"><i class="fa fa-pencil"></i></a> --}}
                                <a href="Javascript:void(0)" class="lnkDel" data-id="{{$row['id']}}"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            {!! Helper::closeResponsiveTable() !!}
        </div>
        <div class="tab-pane" id="completed" aria-labelledby="completed-tab" role="tabpanel">
            Completed
           {!! Helper::responsiveTable(array("User","Location","Score","Assigned On","Completed On","Status","")) !!}
                @foreach($results as $row)
                    @if($row['status'] == 20)
                        <tr>
                            <td>
                                @if($code=="OUTCOME" && $row['status'] == 20)
                                    <a href="{{url('admin/q4eforms/outcome/outcome/viewresults/'.$row['id'])}}">{{$row['username']}}</a>
                                @else
                                    {{$row['username']}}
                                @endif
                            </td>
                            <td>{{$row['locname']}}</td>
                            <td style="color:#fff;background:{{$row['scoreColor']}}"><span style="color:#fff;"><strong>{{$row['totalScore']}}</strong></span></td>
                            <td>{{$row['assignDate']}}</td>
                            <td>{{$row['completeDate']}}</td>
                            <td>{{$row['statusName']}}
                            @if($row['forced_closed']==1)
                                <br><strong><span style="color:red"><i class="fa fa-circle"></i></span>&nbsp;Closed by system</strong>
                            @endif
                            </td>
                            <td>
                                {{-- <a href="Javascript:void(0)" class="lnkEdit" data-id="{{$row['id']}}"><i class="fa fa-pencil"></i></a> --}}
                                <a href="Javascript:void(0)" class="lnkDel" data-id="{{$row['id']}}"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            {!! Helper::closeResponsiveTable() !!}
        </div>
    </div>
    {!! Helper::closePage()!!}
    {!!Helper::form(array("name"=>"frmDel","action"=>"admin/q4eforms/".$data['ftype']."/deleteAssignment","validate"=>"Yes"))!!}
    {!!Helper::hidden(array("name"=>"id","id"=>"hdfDel","value"=>""))!!}
    {!!Helper::hidden(array("name"=>"code","value"=>$data['code']))!!}
    {!!Helper::hidden(array("name"=>"action","value"=>$data['action']))!!}
    {!!Helper::hidden(array("name"=>"formid","value"=>$data['formid']))!!}
    {!!Helper::hidden(array("name"=>"per","value"=>$data['per']))!!}
    {!!Helper::hidden(array("name"=>"ftype","value"=>$data['ftype']))!!}
    {!! Helper::close("form")!!}
@endsection
@section('myscript')
<script>
    var inprogress = '<?php echo $count["progress"] ?>';
    $("#btnReport").on('click',function(){
        $("#action").val("REPORT");
        $("#frm").submit();
    });
    $("#btnClose").on('click',function(){
         var b= 0;
        if(confirm("Are you sure you want to close this period?")){
            b=1
            if(inprogress != "0"){
                b=0
                if(confirm("Some forms are still under progress. Do you want to close all assignments?")) {
                    b=1
                }
            }
        }
        if(b==1){
            $("#frm").submit();
        }
    });
    $(".lnkDel").on('click',function(){
        if(confirm("Are you sure you want to delete this assignment?")){
            var i = $(this).data("id");
            $("#hdfDel").val(i);
            $("#frmDel").submit();
        }
    });

    $(".btnAction").on('click',function(){
        var id = $(this).data("id");
        $("#formid").val(id);
        var per = $("#per" + id).val();
        alert(per);
        if(per != ""){
            $("#per").val(per);
            $("#frm").submit();
        }
    });
</script>
@endsection
