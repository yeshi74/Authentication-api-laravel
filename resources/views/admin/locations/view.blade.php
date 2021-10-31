@extends('layouts/contentLayoutMaster')
@section('title', 'Locations')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
  {!!Helper::form(array("name"=>"frm","action"=>"admin/locations/edit","validate"=>"Yes"))!!}
        {!!Helper::hidden(array("name"=>"action","value"=>"edit"))!!}
        {!!Helper::hidden(array("name"=>"id","value"=>$id))!!}
        <div class="row">
            {!!Helper::button(array("colspan"=>2,"name"=>"btnEdit","label"=>"Edit","type"=>"button","class"=>"btnAction btn-primary","data"=>array("action"=>"edit")))!!}
            {!!Helper::button(array("colspan"=>2,"name"=>"btnDelete","label"=>"Delete","type"=>"button","class"=>"btn-danger"))!!}
        </div>
        <div class="row">
            {!!Helper::display(array("colspan"=>4,"label"=>"Type","name"=>"typ","value"=>$results['typ'],"required"=>"Y","class"=>"validate[required]"))!!}
            {!! Helper::display(array("colspan"=>4,"label"=>"Name","name"=>"category","value"=>$results['name'])) !!}
            {!! Helper::display(array("colspan"=>4,"label"=>"Parent","name"=>"parentname","value"=>$results['parentname'])) !!}
        </div>
    {!!Helper::close("form")!!}
{!! Helper::closePage()!!}
</section>
@endsection
@section('myscript')
<script>
        var url = "{{url('admin/locations/')}}";
        $(".btnAction").on('click',function(){
            var action = $(this).data("action");
            $("#action").val(action);
            var pURL = url + "/" + action;
            $('#frm').attr('action', pURL).submit();
        });
        $("#btnDelete").on('click',function(){
           // $("#id").val($(this).data("id"));
            $("#action").val("delete");
            if(confirm("Are you sure you want to perform this action?"))
            {

                $('#frm').attr('action', "{{url('admin/locations/delete')}}").submit();
            }
        });
    </script>
@endsection




