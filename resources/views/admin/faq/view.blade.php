@extends('layouts/contentLayoutMaster')
@section('title', 'FAQ')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>"")) !!}
    {!! Helper::form(array("name"=>"frm","action"=>"admin/faq/edit","validate"=>"Yes"))!!}
    {!! Helper::hidden(array("name"=>"action","value"=>"edit")) !!}
    {!! Helper::hidden(array("name"=>"id","value"=>$id))!!}

    <div class="row">
        {!! Helper::linkButton(array("colspan"=>2,"url"=>url('admin/faq/edit/'.$id),"btnEdit","label"=>"Edit","type"=>"submit","class"=>"btn btn-primary","data"=>array("action"=>"edit"))) !!}
        {!! Helper::button(array("colspan"=>2,"name"=>"btnDelete","label"=>"Delete","type"=>"button","class"=>"btnAction btn btn-danger","data"=>array("action"=>"delete"))) !!}
    </div>

    {!! Helper::display(array("colspan"=>12,"label"=>"Question","name"=>"question","value"=>$results['question'])) !!}
    {!! Helper::display(array("colspan"=>12,"label"=>"Answer","name"=>"answer","value"=>$results['answer'])) !!}

    <div class="row">
        {!! Helper::display(array("colspan"=>4,"label"=>"Category","name"=>"category","value"=>$results['categoryname'])) !!}
        {!! Helper::display(array("colspan"=>4,"label"=>"Author","name"=>"author","value"=>$results['authorname'])) !!}
            <?php  $status = $results['status'] == 0 ? "Active" : "Suspend"; ?>
        {!! Helper::display(array("colspan"=>4,"label"=>"Status","value"=>$status)) !!}
    </div>
    {!! Helper::close("form")!!}
    {!! Helper::gallery(array("module"=>"FAQ","id"=>$id,"mode"=>"VIEW"))!!}
    {!! Helper::closePage() !!}
@endsection

@section('myscript')
<script>
    var url = "{{url('admin/faq/')}}";
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