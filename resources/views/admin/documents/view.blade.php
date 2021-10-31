<?php
    use App\Helpers\ApolloHelpers;
?>
@extends('layouts/contentLayoutMaster')
@section('title', 'Documents')
@section('content')
  {!!Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>""))!!}
  {!!Helper::form(array("name"=>"frm","action"=>"admin/documents/edit","validate"=>"Yes"))!!}
  {!!Helper::hidden(array("name"=>"action","value"=>"edit"))!!}
  {!!Helper::hidden(array("name"=>"id","value"=>$id))!!}
        
    <div class="row">
        <div class="col-md-12">
        {!! Helper::linkButton(array("url"=>url('admin/documents/edit/'.$id),"label"=>"Edit","type"=>"submit","class"=>"btn btn-primary"))!!}
        {!!Helper::button(array("label"=>"Delete","name"=>"btnDelete","type"=>"button","class"=>"btnAction btn-danger","data"=>array("action"=>"delete")))!!}
    </div>
    </div>
    {!!Helper::display(array("colspan"=>12,"label"=>"Subject","name"=>"subject","value"=>$results['subject']))!!}
    
    <div class="row">
        <?php  
            $status = ($results['status'] == 0 ? "Active" : "Suspend");
            $date=date('d/m/Y',strtotime($results['doc_date']));
        ?>
        {!!Helper::display(array("colspan"=>3,"label"=>"Published Date","name"=>"doc_date","value"=>$date))!!}
        {!!Helper::display(array("colspan"=>3,"label"=>"Author","name"=>"author","value"=>$results['authorname']))!!}
        {!!Helper::display(array("colspan"=>3,"label"=>"Category","name"=>"category","value"=>$results['categoryname']))!!}
        {!!Helper::display(array("colspan"=>3,"label"=>"Status","value"=>$status)) !!}   
    </div>

    <div class="row">
        {!! Helper::attachment(array("colspan"=>12,"label"=>"Attachment","id"=>$results['id'],"module"=>"DOCUMENTS","value"=>$results['attachment'])) !!}
    </div>
    <br/>
    {!!Helper::display(array("colspan"=>12,"label"=>"Summary","name"=>"summary","value"=>$results['summary'],"required"=>"Y","class"=>"validate[required]"))!!}
    <legend>Locations</legend>
    <?php echo ApolloHelpers::locationTree(array("name"=>"locations","mode"=>"VIEW","selLocations"=>$lstLocations,"selRoles"=>$lstRoles)); ?>
    {!!Helper::close("form")!!}
   
    {!! Helper::closePage()!!}
@endsection
@section('myscript')
  <script>
       var url = "{{url('admin/documents/')}}";
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



