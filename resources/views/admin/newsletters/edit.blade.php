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
    {!! Helper::textbox(array("colspan"=>12,"label"=>"Subject","name"=>"subject","max"=>150,"placeholder"=>"Enter Subject","value"=>$results['subject'],"class"=>"validate[required]")) !!}
    
    <div class="row">
        {!! Helper::textbox(array("colspan"=>3,"label"=>"Period","name"=>"period","placeholder"=>"Enter Period","class"=>"validate[required]","required"=>"Yes","value"=>$results['period'],"typ"=>"date")) !!}
        {!! Helper::selectStatus(array("colspan"=>3,"label"=>"Status","name"=>"status","value"=>$results['status'])) !!}
        {!! Helper::select(array("colspan"=>3,"options"=>array("0"=>"No","1"=>"Yes"),"label"=>"Is Public","name"=>"is_public","value"=>$results['is_public'])) !!}
    </div>
    <div class="row">
        {!! Helper::select(array("colspan"=>3,"label"=>"Type","name"=>"typ","options"=>array("PDF"=>"PDF","VIDEO"=>"VIDEO"),"value"=>$results['typ']))!!}
        <div class="col-md-9">
            @if($results['typ'] =="PDF")
            <div id="divFile">
                <div class="row">
                    {!! Helper::attachment(array("delete"=>"Yes","colspan"=>6,"label"=>"Existing NewsLetter Attachment","id"=>$results['id'],"module"=>"NEWSLETTERS","value"=>$results['file'])) !!}
                    {!! Helper::textbox(array("colspan"=>6,"label"=>"NewsLetter Attachment","name"=>"file","typ"=>"FILE"))!!}
                </div>
            </div>
            @endif
            @if($results['typ']=="VIDEO")
            <div id="divVideo">
                <div class="row">
                    <div class="col-md-9">
                        <iframe src="https://youtube.com/embed/{{$results['video']}}?rel=0" width="100%" frameborder=0 height="150px;"></iframe>
                    </div>
                    {!! Helper::textbox(array("colspan"=>3,"label"=>"Video URL","name"=>"video","value"=>$results['video']))!!}
                </div>
            </div>
            @endif
        </div>
    </div>
    
    
    {!! Helper::textbox(array("colspan"=>12,"label"=>"Summary","name"=>"summary","placeholder"=>"Enter Summary","class"=>"validate[required]","required"=>"Yes","value"=>$results['summary'],"typ"=>"HTML")) !!}
    <div class="accordion" id="accView">
        {!! Helper::accordion(array("id"=>"c2","parent"=>"accView","label"=>"Locations"))!!}
    <?php echo ApolloHelpers::locationTree(array("name"=>"locations","mode"=>"EDIT","selLocations"=>$lstLocations,"selRoles"=>$lstRoles)); ?>
    {!! Helper::close("form")!!}
    {!! Helper::closeAccordion() !!}
    {!! Helper::accordion(array("id"=>"c2a","parent"=>"accView","label"=>"Users"))!!}
    {!! Helper::linkButton(array("label"=>"Edit Users","url"=>url('admin/newsletters/editusers/'.$id),"name"=>"btnEdit","class"=>"btn btn-primary")) !!}
    {!! Helper::responsiveTable(array("Name","Emp. Code","Location"))!!}
      @foreach($lstUsers as $row)
        <tr>
          <td>{!!$row['name']!!}</td>
          <td>{!!$row['empcode']!!}</td>
          <td>{!!$row['location']!!}</td>
        </tr>
      @endforeach
      {!! Helper::closeResponsiveTable()!!}
    {!! Helper::closeAccordion() !!}
    </div>
    {!! Helper::close("form") !!}
    {{-- {!! Helper::gallery(array("module"=>"NEWSLETTERS","id"=>$id,"mode"=>"EDIT")) !!} --}}
    {!! Helper::closePage() !!}
    {!! Helper::form(array("name"=>"frmDelete","action"=>"admin/newsletters/delatt","validate"=>"Yes")) !!}
    {!! Helper::hidden(array("name"=>"id","value"=>$id)) !!}
    {!! Helper::close("form") !!}
@endsection


@section('myscript')
<script>
 var t = "{{$results['typ']}}";
 if(t == "VIDEO") {
    $("#divFile").hide();
    $("#divVideo").show();
 } else {
    $("#divFile").show();
    $("#divVideo").hide();
 }
$(".lnkDeleteAttachment").on('click',function (){
    if(confirm("Are you sure you want to remove this attachment?")) 
    {
        $("#frmDelete").submit();
    }
});
$("#typ").on('change',function(){
        var t = $(this).val();
        if(t=="VIDEO"){
            $("#divFile").hide();
            $("#divVideo").show();
        }
        else
        {
            $("#divFile").show();
            $("#divVideo").hide();
        }
    });
</script>
@endsection