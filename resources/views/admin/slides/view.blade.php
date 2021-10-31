@extends('layouts/contentLayoutMaster')
@section('title', 'Slides')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>"")) !!}
     {!! Helper::form(array("name"=>"frm","action"=>"admin/slides/delete","validate"=>"Yes")) !!}
    {!! Helper::hidden(array("name"=>"id","value"=>$results['id']))!!}
    {!! Helper::close("form")!!}
    <div class="row">
        <div class="col-md-12">
            {!! Helper::linkButton(array("url"=>url('admin/slides/edit/'.$id),"btnEdit","label"=>"Edit","type"=>"submit","class"=>"btn btn-primary","data"=>array("action"=>"edit"))) !!}
            {!! Helper::button(array("name"=>"btnDelete","label"=>"Delete","type"=>"button","class"=>" btn btn-danger","data"=>array("action"=>"delete"))) !!}
        </div>
    </div>
    {!! Helper::display(array("colspan"=>12,"label"=>"Title","name"=>"question","value"=>$results['title'])) !!}
    @if($results['typ'] == "WELCOME" || $results['typ']=="CONGRATS")
        {!! Helper::display(array("colspan"=>12,"label"=>"Caption","name"=>"answer","value"=>$results['caption'])) !!}
        {!! Helper::display(array("colspan"=>12,"label"=>"Message","name"=>"answer","value"=>$results['body'])) !!}
    @endif
     @if($results['typ'] == "BANNER")
        <div class="row">
            <div class="col-md-12">
                <img src="{{$results['imgurl']}}" class="img-fluid"/>
            </div>
        </div>
    @endif
     @if($results['typ'] == "VIDEO")
        <div class="row">
            <div class="col-md-12">
                <iframe src="{{$results['imgurl']}}" width="100%" height="350px"></iframe>
            </div>
        </div>
    @endif
    
    {!! Helper::closePage() !!}
@endsection

@section('myscript')
<script>
    var url = "{{url('admin/slides/')}}";
    $(".btnAction").on('click',function(){
        var action = $(this).data("action");
        $("#action").val(action);
        if(confirm("Are you sure you want to perform this action?"))
        {
            var pURL = url + "/" + action;
            $('#frm').attr('action', pURL).submit();
        }
    });
    $("#btnDelete").on('click',function(){
        if(confirm("Are you sure you want to delete this slide?")){
            $("#frm").submit();
        }
    })
</script>
@endsection