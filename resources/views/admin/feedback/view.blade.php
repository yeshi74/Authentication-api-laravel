@extends('layouts/contentLayoutMaster')
@section('title', 'Feedbacks')
@section('content')
  <?php
    if($typ=="REPLY"):?>
      {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>""))!!}
  <?php endif; ?>
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>"")) !!}
  {!! Helper::form(array("name"=>"frm","action"=>"admin/feedback/edit","validate"=>"Yes"))!!}
  {!! Helper::hidden(array("name"=>"action","value"=>"edit")) !!}
  {!! Helper::hidden(array("name"=>"id","value"=>$id))!!}
  {!! Helper::hidden(array("name"=>"typ","value"=>$typ))!!}
  
  <div class="row">
    <div class="col-md-8">
       
      {!! Helper::button(array("name"=>"btnDelete","label"=>"Delete","type"=>"button","class"=>"btnAction btn btn-danger","data"=>array("action"=>"delete")))!!}
    <?php if($results['status']==0):?>
      {!! Helper::button(array("name"=>"btnReply","label"=>"Reply to Feedback","type"=>"button","class"=>"btn btn-primary","data"=>array("action"=>"reply")))!!}
    <?php endif;?>
    <?php if($results['status']!=20):?>
      {!! Helper::button(array("name"=>"btnClose","label"=>"Close","type"=>"button","class"=>"btnAction btn btn-primary","data"=>array("action"=>"close")))!!}
    <?php endif;?>
    </div>
    <div class="col-md-4">
      <strong>
        @if($results['status'] == 0)
          <span style="color:red"><i class="fa fa-exclamation-o fa-lg"></i>&nbsp;New Feedback</span><br>
        @endif
        @if($results['status'] == 10)
          <span style="color:green"><i class="fa fa-check-circle fa-lg"></i>&nbsp;Replied</span><br>
        @endif
        <i class="fa fa-calendar fa-lg"></i>&nbsp;{{ date('d/m/Y',strtotime($results['created_at'])) }} </strong>
    </div>
  </div>
  <div class="row">
     {!! Helper::userDetails(array("colspan"=>4,"label"=>"Submitted By","name"=>"author","value"=>$results['author'])) !!}
     @if($results['status']==10)
        {!! Helper::display(array("colspan"=>4,"label"=>"Replied by","value"=>$results['repliedby'])) !!}
        {!! Helper::display(array("colspan"=>4,"label"=>"Replied on","value"=>date('d/m/Y',strtotime($results['replied_on']))))!!}
    @endif 
    
  </div>
  
 
  {!! Helper::display(array("colspan"=>12,"label"=>"Message","name"=>"message","value"=>$results['message'])) !!}
  @if($results['reply'] != "" && $results['status']==10)
    {!! Helper::display(array("colspan"=>12,"label"=>"Feedback Reply","name"=>"reply","value"=>$results['reply'])) !!}
  @endif
  {!! Helper::close("form")!!}
  <div class="modal fade text-left" id="modalReply" tabindex="-1" role="dialog" aria-labelledby="myAddBUlabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myAddBUlabel">Reply</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!!Helper::form(array("name"=>"frm","action"=>"admin/feedback/reply","validate"=>"Yes"))!!}
                {!!Helper::hidden(array("name"=>"id","id"=>"hdfBUID","value"=>$id))!!}

                <div class="modal-body">
                    {!! Helper::textbox(array("colspan"=>12,"label"=>"Reply for Feedback","name"=>"reply","placeholder"=>"Enter Reply for the feedback","typ"=>"textarea","class"=>" validate[required]","required"=>"Yes","value"=>""))!!}
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                {!! Helper::close("form") !!}
            </div>
        </div>
    </div>
  {!! Helper::closePage() !!}
@endsection

@section('myscript')
<script>
  var url = "{{url('admin/feedback/')}}";
  $(".btnAction").on('click',function(){
  var action = $(this).data("action");
  $("#action").val(action);
  if(confirm("Are you sure you want to perform this action?"))
  {
      var pURL = url + "/" + action;
      $('#frm').attr('action', pURL).submit();
  }
});

  $("#btnReply").on('click',function(){
        $("#modalReply").modal('show');
    });
</script>
@endsection