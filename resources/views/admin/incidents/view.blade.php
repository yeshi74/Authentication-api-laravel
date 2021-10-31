@extends('layouts/contentLayoutMaster')
@section('title', 'Incidents')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>""))!!}
    {!!Helper::form(array("name"=>"frm","action"=>"admin/incidents/close","validate"=>"Yes"))!!}
    {!!Helper::hidden(array("name"=>"id","value"=>$id))!!}
    {!!Helper::hidden(array("name"=>"action","value"=>""))!!}
    {!!Helper::close("form")!!}
    {!!Helper::form(array("name"=>"frmDelete","action"=>"admin/incidents/delete","validate"=>"Yes"))!!}
    {!!Helper::hidden(array("name"=>"id","value"=>$id))!!}
    {!!Helper::close("form")!!}
    @php
        $results = $output['results'];
    @endphp
    <div class="row">
        <div class="col-md-8">
            <?php
                switch($results['status']):
                    case 0: //New
                        echo Helper::button(array("label"=>"Edit Incident","name"=>"btnEdit","type"=>"button"));
                        echo Helper::button(array("label"=>"Abort Incident","name"=>"btnAbort","class"=>"btn-warning","type"=>"button"));
                        break;
                    case 10: //Ready to assign to users
                        echo Helper::button(array("label"=>"Edit Incident","name"=>"btnEdit","type"=>"button"));
                        echo Helper::button(array("label"=>"Assign","name"=>"btnAssign","type"=>"button"));
                        echo Helper::button(array("label"=>"Close Incident","name"=>"btnClose","type"=>"button","class"=>" btn-danger"));
                        echo Helper::button(array("label"=>"Abort Incident","name"=>"btnAbort","class"=>"btn-warning","type"=>"button"));
                        break;
                    case 20: //Work in Progress
                        echo Helper::button(array("label"=>"Edit Incident","name"=>"btnEdit","type"=>"button"));
                        echo Helper::button(array("label"=>"Assign","name"=>"btnAssign","type"=>"button"));
                        echo Helper::button(array("label"=>"Close Incident","name"=>"btnClose","type"=>"button","class"=>" btn-danger"));
                        echo Helper::button(array("label"=>"Abort Incident","name"=>"btnAbort","class"=>"btn-warning","type"=>"button"));
                        break;
                    case 90: //Aborted
                         echo Helper::button(array("label"=>"Reopen Incident","name"=>"btnReopen","class"=>"btn-warning","type"=>"button"));
                        break;
                endswitch;
                echo Helper::button(array("label"=>"Delete Incident","name"=>"btnDelete","class"=>"btn-warning","type"=>"button"));
            ?>
        </div>

        <div class="col-md-4">
            <span class="badge badge-{{$results['color']}}" style="float:right;">{{$results['statusname']}}</span>
            <br/><span style="float:right;">Reported on {{date('d/m/Y H:i',strtotime($results['created_at']))}}</span>
            <br/><span style="float:right;">Incident Date {{date('d/m/Y H:i',strtotime($results['incident_date']))}}</span>
            
            <br/><span style="float:right;">Last Updated on {{date('d/m/Y H:i',strtotime($results['updated_at']))}}</span>
            @if($results['status']==50)
                <br/><span style="float:right;">Closed on {{date('d/m/Y',strtotime($results['closed_at']))}}</span>
            @endif
        </div>
    </div>
    @include('admin/incidents/details')
    <div class="modal fade text-left" id="mClose" tabindex="-1" role="dialog" aria-labelledby="myAddBUlabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                {!!Helper::form(array("name"=>"frm","action"=>"admin/incidents/close-incident","validate"=>"Yes"))!!}
                {!!Helper::hidden(array("name"=>"id","value"=>$id))!!}
                <div class="modal-header">
                    <h4 class="modal-title" id="myAddBUlabel1">Closing Comments</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Helper::textbox(array("colspan"=>12,"label"=>"Comments","name"=>"comments","placeholder"=>"Enter Notes","typ"=>"textarea","class"=>" validate[required]","required"=>"Yes","value"=>""))!!}
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Update Comments</button>
                </div>
                {!!Helper::close("form")!!}
            </div>
        </div>
    </div>
    {!! Helper::closePage()!!}
@endsection
@section('myscript')
<script>
     $("#btnDelete").on('click',function(){
        if(confirm("Do you want to delete this incident?")){
            $("#frmDelete").submit();
        }
    });
    $("#btnAssign").on('click',function(){
        $('#frm').attr('action', "{{url('admin/incidents/assign')}}").submit();
    });
    $("#btnClose").on('click',function(){
        if(confirm("Do you want to close this incident?")){
            $("#action").val('close');
            //$("#frm").submit();
            $("#mClose").modal('show');
        }
    });
    $("#btnEdit").on('click',function(){
        var pURL = '{{url("admin/incidents/edit/{$id}")}}';
        location.href = pURL;
    });
    $("#btnAbort").on('click',function(){
        if(confirm("Do you want to abort this incident?")){
            $("#action").val('abort');
            $("#frm").submit();
        }
    });
    $("#btnReopen").on('click',function(){
        if(confirm("Do you want to reopen this incident?")){
            $("#action").val('reopen');
            $("#frm").submit();
        }
    });
    $(".lnkTrackView").on('click',function(){
        var id = $(this).data("id");
        var uURL = '{{url("admin/incidents/track-view/")}}';
        $("#taskid").val(id);
        $.ajax({
              url: uURL + "/" + id,
              type: 'GET',
              success: function (data) {
                $("#modalTaskContents").html(data);
                $("#mTask").modal('show');
              }
          });
    });
</script>
@endsection







