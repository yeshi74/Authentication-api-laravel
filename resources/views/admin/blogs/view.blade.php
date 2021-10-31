@extends('layouts/contentLayoutMaster')
@section('title', 'Learning')
@section('content')
<?php
  if($typ=="APPROVE"):?>
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>""))!!}
<?php endif; ?>
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>""))!!}
    {!! Helper::form(array("name"=>"frm","action"=>"admin/blogs/edit","validate"=>"Yes"))!!}
    {!! Helper::hidden(array("name"=>"action","value"=>"edit"))!!}
    {!! Helper::hidden(array("name"=>"id","value"=>$id))!!}
    {!! Helper::hidden(array("name"=>"typ","value"=>$typ))!!}
    <?php
        $approvecls = $results['categoryname'] == "" ? "addCategory" : "btnAction";
        $approvedDate = "";
        $createDate=date('d/m/Y',strtotime($results['created_at']));
        if ($results['approved_date'] != "") $approvedDate = date('d/m/Y',strtotime($results['approved_date']));
        $statusName = $results['statusname'];
    ?>      
    <div class="row">
        <div class="col-md-8">
            {!! Helper::linkButton(array("url"=>url('admin/blogs/edit/'.$id),"btnEdit","label"=>"Edit","type"=>"submit","class"=>"btn btn-primary","data"=>array("action"=>"edit")))!!}
            {!! Helper::button(array("name"=>"btnDelete","label"=>"Delete","type"=>"button","class"=>"btnAction btn btn-danger","data"=>array("action"=>"delete")))!!}
            @if($results['status'] == 0)
                {!! Helper::button(array("name"=>"btnApprove","label"=>"Approve","type"=>"button","class"=>"btn btn-primary ".$approvecls,"data"=>array("action"=>"approve")))!!}
                {!! Helper::button(array("name"=>"btnReject","label"=>"Reject","type"=>"button","class"=>"btn btn-danger"))!!}
            @endif
            @if($results['status'] == 5)
                {!! Helper::button(array("name"=>"btnApproveHOD","label"=>"Approval from HOD","type"=>"button","class"=>"btn btn-primary ".$approvecls,"data"=>array("action"=>"approve-hod")))!!}
                {!! Helper::button(array("name"=>"btnReject","label"=>"Reject","type"=>"button","class"=>"btn btn-danger"))!!}
            @endif
            @if($results['status'] == 10)
                {!! Helper::button(array("name"=>"btnReject","label"=>"Reject","type"=>"button","class"=>"btn btn-danger"))!!}
            @endif
            @if($results['status'] == 20)
                {!! Helper::button(array("name"=>"btnApprove","label"=>"Approve","type"=>"button","class"=>"btnAction btn btn-primary ".$approvecls,"data"=>array("action"=>"approve")))!!}
        
            @endif
            @if($results['publish'] == 0)
                {!! Helper::button(array("name"=>"btnPublish","label"=>"Publish","type"=>"button","class"=>"btn btn-warning"))!!}
            @endif
        </div>
        <div class="col-md-4" style="text-align:left">
            <strong>{!! $statusName !!} </strong><br>
            @if($results['publish'] == 1)
                <strong>Published on {{date('d/m/Y',strtotime($results['publish_date']))}}</strong>
            @endif
        </div>
    </div>
    {!! Helper::display(array("colspan"=>12,"label"=>"Subject","name"=>"subject","value"=>$results['subject'])) !!}
    
    <div class="row">
       {!! Helper::display(array("colspan"=>6,"name"=>"category","label"=>"Category","value"=>$results['categoryname'])) !!}
       {!! Helper::display(array("colspan"=>6,"name"=>"author","label"=>"Author","value"=>$results['authorname'])) !!}
    </div>

    {!! Helper::display(array("colspan"=>12,"label"=>"Summary","name"=>"body","typ"=>"HTML","value"=>$results->body)) !!}
    @if($results['status'] == 20)
         {!! Helper::display(array("colspan"=>12,"label"=>"Rejected Reason","name"=>"status","value"=>$results['reject_reason'])) !!}
    @endif

    <br/>
    @foreach($lstBlogContents as $row)
        {!! Helper::display(array("colspan"=>12,"label"=>$row->catname,"name"=>"body","typ"=>"HTML","value"=>$row->contents))!!}
    @endforeach
    <legend>Approvals</legend>
    {!! Helper::responsiveTable(array("Assigned To","Assigned Date","Status","Exp. Closing Date","Closed On","QA Comments","HOD Comments"))!!}
    @foreach($lstApprovals as $row)
        <tr>
            <td>{{$row['assignName']}}</td>
            <td>{{$row['assign_date']}}</td>
            <td>{{$row['statusName']}}</td>
            <td>{{$row['exp_closing_date']}}</td>
            <td>{{$row['closed_date']}}</td>
            <td>{{$row['qa_comments']}}</td>
            <td>{{$row['user_comments']}}</td>
        </tr>
    @endforeach
    {!! Helper::closeResponsiveTable() !!}
    {!! Helper::close("form")!!}
    {!! Helper::gallery(array("module"=>"BLOGS","id"=>$id,"mode"=>"VIEW"))!!}
    {!! Helper::closePage()!!}

<div class="modal fade text-left" id="modalReject" tabindex="-1" role="dialog" aria-labelledby="myAddBUlabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myAddBUlabel">Reason for Rejection</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
           
            {!! Helper::form(array("name"=>"frm","action"=>"admin/blogs/rejsave","validate"=>"Yes"))!!}
            {!! Helper::hidden(array("name"=>"id","id"=>"hdfBUID","value"=>$id))!!}

            <div class="modal-body">
                {!! Helper::textbox(array("colspan"=>12,"label"=>"Reject Reason","name"=>"reject_reason","placeholder"=>"Enter Rejection","typ"=>"textarea","class"=>" validate[required]","required"=>"Yes","value"=>""))!!}
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            {!! Helper::close("form") !!}
        </div>
    </div>
</div>
<div class="modal fade text-left" id="modalApprove" tabindex="-1" role="dialog" aria-labelledby="myAddBUlabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myAddBUlabel">Choose the Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Helper::form(array("name"=>"frm","action"=>"admin/blogs/approve","validate"=>"Yes"))!!}
            {!! Helper::hidden(array("name"=>"id","id"=>"hdfBUID","value"=>$id))!!}

            <div class="modal-body">
                {!!Helper::selectList(array("colspan"=>12,"label"=>"Category","name"=>"category","options"=>$getCategory,"value"=>old('category'),"key"=>"id","val"=>"name"))!!}
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            {!! Helper::close("form") !!}
        </div>
    </div>
</div>
@endsection
@section('myscript')
  <script>
        var url = "{{url('admin/blogs/')}}";
        $(".btnAction").on('click',function(){
            var action = $(this).data("action");
            $("#action").val(action);
            if(confirm("Are you sure you want to perform this action?"))
            {
                var pURL = url + "/" + action;
                $('#frm').attr('action', pURL).submit();
            }
        });
        $("#btnPublish").on('click',function(){
            var action = "publish";
            $("#action").val(action);
            if(confirm("Are you sure you want to publish this learning?"))
            {
                var pURL = url + "/" + action;
                $('#frm').attr('action', pURL).submit();
            }
        });
        $("#btnReject").on('click',function()
        {
            $("#modalReject").modal('show');
        });
        $("#btnApprove.addCategory").on('click',function(){$("#modalApprove").modal('show');});
        //$("#btnApprove").on('click',function(){$("#modalApprove").modal('show');});
    </script>
@endsection
