@extends('layouts/contentLayoutMaster')
@section('title', 'Albums')
@section('content')
<?php
  if($typ=="APPROVE"):?>
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
<?php endif; ?>
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
{!! Helper::form(array("name"=>"frm","action"=>"admin/albums/edit","validate"=>"Yes"))!!}
{!! Helper::hidden(array("name"=>"action","value"=>"edit")) !!}
{!! Helper::hidden(array("name"=>"id","value"=>$id))!!}
{!! Helper::hidden(array("name"=>"detid","value"=>""))!!}
<?php
    $statusName = $results['statusname'];
    if($results['status'] == 10) $statusName = "<span style='color:green'><i class='fa fa-check-circle fa-lg'></i></span>&nbsp;".$statusName." on ".date('d/m/Y',strtotime($results['approved_on']));
    if($results['status'] == 20) $statusName = "<span style='color:red'><i class='fa fa-exclamation-circle fa-lg'></i></span>&nbsp;".$statusName." on ".date('d/m/Y',strtotime($results['approved_on']));
    $date=date('d/m/Y',strtotime($results['date']));
?>
<div class="row">
    <div class="col-md-8">
        {!! Helper::linkButton(array("url"=>url('admin/albums/edit/'.$id),"btnEdit","label"=>"Edit","type"=>"submit","class"=>"btn btn-primary","data"=>array("action"=>"edit")))!!}
        {!! Helper::button(array("name"=>"btnDelete","label"=>"Delete","type"=>"button","class"=>"btnAction btn btn-danger","data"=>array("action"=>"delete")))!!}
        <?php
            if($results['status'] == 0):?>
                {!! Helper::button(array("name"=>"btnApprove","class"=>"btnAction btn-primary","label"=>"Approve","type"=>"button","icon"=>"","data"=>array("action"=>"approve")))!!}
                {!! Helper::button(array("name"=>"btnReject","label"=>"Reject","type"=>"button","class"=>"btn btn-danger"))!!}
        <?php
            endif;
            if($results['status'] == 10): //Already Approved
        ?>
                {!! Helper::button(array("name"=>"btnReject","label"=>"Reject","type"=>"button","class"=>"btn btn-danger"))!!}
        <?php  endif;?>
        <?php
            if($results['status'] == 20): //Rejected, so approve again
        ?>
        {!!Helper::button(array("name"=>"btnApprove","label"=>"Approve","type"=>"button","class"=>"btnAction btn btn-primary","data"=>array("action"=>"approve")))!!}
        <?php  endif;?>
    </div>
    <div class="col-md-4">
        <strong>{!! $statusName !!} </strong><br>
        <strong><i class="fa fa-calendar fa-lg"></i>&nbsp; on {{ $date }}</strong>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <h4>{{$results['subject']}}</h4>
    </div>
</div>
        
<div class="row">
    {!! Helper::userDetails(array("colspan"=>6,"label"=>"Author","name"=>"author","value"=>$results['author'])) !!}
    {!! Helper::display(array("colspan"=>6,"label"=>"Location","name"=>"location","value"=>$results['locname'])) !!}
</div>
<div class="row">
    <div class="col-md-12">
        <label>Cover Image</label><br>
        @if($results['coverImage'] != "" )
            <img src="{{$results['coverImage']}}"/>
        @else
            <small>No Cover Image set</small>
        @endif
        <br/>
        @if($GalleryCount > 0)
            {!! Helper::linkButton(array("url"=>url('admin/albums/coverimg/'.$id),"label"=>"Set Cover Image","class"=>"btn btn-primary"))!!}
        @endif
    </div>
</div>
@if($results['status'] == 20)
    {!! Helper::display(array("colspan"=>12,"label"=>"Rejected Reason","name"=>"status","value"=>$results['reject_reason'])) !!}
@endif
<br/>
{!! Helper::display(array("colspan"=>12,"label"=>"Notes","name"=>"notes","value"=>$results['notes'])) !!}
{!! Helper::gallery(array("module"=>"ALBUMS","id"=>$id,"mode"=>"VIEW"))!!}
{!! Helper::closePage() !!}
{!! Helper::close("form") !!}
<div class="modal fade text-left" id="modalReject" tabindex="-1" role="dialog" aria-labelledby="myAddBUlabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myAddBUlabel">Reason for Rejection</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!!Helper::form(array("name"=>"frm","action"=>"admin/albums/rejsave","validate"=>"Yes"))!!}
                {!!Helper::hidden(array("name"=>"id","id"=>"hdfBUID","value"=>$id))!!}

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

 

@endsection
@section('myscript')
<script>
 var url = "{{url('admin/albums/')}}";
    $(".btnAction").on('click',function(){
        var action = $(this).data("action");
        $("#action").val(action);
        if(confirm("Are you sure you want to perform this action?"))
        {
            var pURL = url + "/" + action;
            $('#frm').attr('action', pURL).submit();
        }
    });
    $(".lnkDelete").on('click',function(){
        $("#detid").val($(this).data("id"));
        $("#action").val("deletealbum");
        if(confirm("Are you sure you want to delete the Image?"))
        {
            $('#frm').attr('action', "{{url('admin/albums/deletealbum')}}").submit();
        }
    });
    $("#btnReject").on('click',function(){
        $("#modalReject").modal('show');
    });
    
</script>
@endsection