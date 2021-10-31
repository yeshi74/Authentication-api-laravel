@extends('layouts/contentLayoutMaster')
@section('title', 'Locations')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
{!!Helper::form(array("name"=>"frm","action"=>"admin/locations/update","validate"=>"Yes"))!!}
{!!Helper::hidden(array("name"=>"action","value"=>"update"))!!}
{!!Helper::hidden(array("name"=>"id","value"=>$id))!!}
{!!Helper::button(array("colspan"=>12,"name"=>"btnUpdate","label"=>"Update","type"=>"button"))!!}
        
<div class="row">
    {!!Helper::textbox(array("colspan"=>6,"label"=>"Name","name"=>"name","max"=>150,"class"=>"validate['required']","value"=>$results['name']))!!}
    {!!Helper::selectList(array("colspan"=>6,"label"=>"Parent","name"=>"parent","options"=>$getparentCat,"key"=>"id","val"=>"name","value"=>$results['parent']))!!}
</div>

           
{!!Helper::close("form")!!}
{!! Helper::closePage()!!}
@endsection
@section('myscript')
<script>
    $("#btnUpdate").on('click',function()
    {
    $("#frm").submit();
    });
</script>
@endsection
