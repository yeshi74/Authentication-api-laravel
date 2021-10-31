@extends('layouts/contentLayoutMaster')
@section('title', 'Forms & Surveys')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    {!!Helper::form(array("name"=>"frm","action"=>"admin/q4eforms/".$ftype."/search","validate"=>"Yes"))!!}
    {!!Helper::hidden(array("name"=>"code","value"=>$code))!!}
    {!!Helper::hidden(array("name"=>"action","value"=>""))!!}
    {!!Helper::hidden(array("name"=>"formid","value"=>""))!!}
    {!!Helper::hidden(array("name"=>"per","value"=>""))!!}
    {!!Helper::hidden(array("name"=>"ftype","value"=>$ftype))!!}
    <div class="row">
        <div class="col-md-12">
            {!!Helper::linkButton(array("url"=>url('admin/q4eforms/'.$ftype.'/list/'.$code),"name"=>"btnAdd","label"=>"Manage Forms","class"=>"btn-primary btnAdd"))!!}
           
        </div>
    </div>
    {!! Helper::closePage()!!}
    <div class="row">
        @foreach($lstRecords as $row)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header mb-1">
                        <h4 class="card-title">{{$row['name']}}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <select name="per{{$row['id']}}" id="per{{$row['id']}}" class="form-control">
                                <option value="">Select Period</option>
                                @foreach($row['months'] as $per)
                                    <option value="{{$per['period']}}">{{$per['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        <span class="float-right">
                            <button type="button" class="btn btn-primary btnAction" data-id="{{$row['id']}}">Filter</button>
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
   {{--  <div class="row">
        {!! Helper::selectList(array("name"=>"formid","placeholder"=>"Select Form","colspan"=>4,"label"=>"Form","required"=>"Yes","class"=>"validate[required]","options"=>$lstForms,"key"=>"id","val"=>"name","value"=>$data['formid'])) !!}
        {!! Helper::selectList(array("name"=>"per","placeholder"=>"Select Period","colspan"=>4,"label"=>"Period","required"=>"Yes","class"=>"validate[required]","options"=>$lstMonths,"key"=>"id","val"=>"name","value"=>$data['per'])) !!}
        <div class="col-md-4">
            <button type="submit" style="margin-top:20px;" class="btn btn-primary">List</button>
            <button type="button" style="margin-top:20px;" class="btn btn-warning">Report</button>
        </div>
    </div> --}}
    {!! Helper::close("form")!!}
    @if($results)
        @if($code=="OUTCOME")
            {!! Helper::responsiveTable(array("User","Location","Score","Assigned On","Completed On","Status","")) !!}
        @else
            {!! Helper::responsiveTable(array("User","Location","Assigned On","Completed On","Status","")) !!}
        @endif
        @foreach($results as $row)
            <tr>
                <td>
                    @if($code=="OUTCOME" && $row['status'] == 20)
                        <a href="{{url('admin/q4eforms/outcome/outcome/viewresults/'.$row['id'])}}">{{$row['username']}}</a>
                    @else
                        {{$row['username']}}
                    @endif
                </td>
                <td>{{$row['locname']}}</td>
                @if($code=="OUTCOME")
                    <td>{{$row['totalScore']}}</td>
                @endif
                <td>{{$row['assignDate']}}</td>
                <td>{{$row['completeDate']}}</td>
                <td>{{$row['statusName']}}</td>
                <td>
                    {{-- <a href="Javascript:void(0)" class="lnkEdit" data-id="{{$row['id']}}"><i class="fa fa-pencil"></i></a> --}}
                    <a href="Javascript:void(0)" class="lnkDel" data-id="{{$row['id']}}"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        @endforeach
        {!! Helper::closeResponsiveTable() !!}
    @endif
    {!! Helper::closePage()!!}
    {!!Helper::form(array("name"=>"frmDel","action"=>"admin/q4eforms/".$ftype."/deleteAssignment","validate"=>"Yes"))!!}
    {!!Helper::hidden(array("name"=>"id","id"=>"hdfDel","value"=>""))!!}
    {!!Helper::hidden(array("name"=>"code","value"=>$data['code']))!!}
    {!!Helper::hidden(array("name"=>"action","value"=>$data['action']))!!}
    {!!Helper::hidden(array("name"=>"formid","value"=>$data['formid']))!!}
    {!!Helper::hidden(array("name"=>"per","value"=>$data['per']))!!}
    {!!Helper::hidden(array("name"=>"ftype","value"=>$ftype))!!}
    {!! Helper::close("form")!!}
@endsection
@section('myscript')
<script>
    $("#btnReport").on('click',function(){
        $("#action").val("REPORT");
        $("#frm").submit();
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
        if(per != ""){
            $("#per").val(per);
            $("#frm").submit();
        }
    });
</script>
@endsection
