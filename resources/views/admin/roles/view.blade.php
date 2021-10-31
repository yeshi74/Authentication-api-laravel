@extends('layouts/contentLayoutMaster')
@section('title', 'Roles')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>""))!!}
    {!!Helper::form(array("name"=>"frm","action"=>"admin/roles/edit","validate"=>"Yes"))!!}
    {!!Helper::hidden(array("name"=>"action","value"=>"edit"))!!}
    {!!Helper::hidden(array("name"=>"id","value"=>$id))!!}
        
    <div class="row">
        {!! Helper::linkButton(array("colspan"=>2,"url"=>url('admin/roles/edit/'.$id),"btnEdit","label"=>"Edit","type"=>"submit","class"=>"btn btn-primary","data"=>array("action"=>"edit")))!!}
        {!!Helper::button(array("colspan"=>2,"label"=>"Delete","name"=>"btnDelete","type"=>"button","class"=>"btnAction btn-danger","data"=>array("action"=>"delete")))!!}
    </div>

    <div class="row">
        {!!Helper::display(array("colspan"=>3,"label"=>"Code","name"=>"code","value"=>$results['code']))!!}
        {!!Helper::display(array("colspan"=>6,"label"=>"Name","name"=>"name","value"=>$results['name'],"required"=>"Y","class"=>"validate[required]"))!!}
        {!!Helper::display(array("colspan"=>3,"label"=>"Default Role","name"=>"code","value"=>$results['def_role']==1 ? "Yes" : "No"))!!}
    </div>
    <legend>Permissions</legend>
    <div class="row">
        @foreach($lstOpts as $row)
            <?php
                $checked="";
                foreach($lstRoles as $r){
                    if($r->menuid == $row->id) $checked="<i class='fa fa-check'></i>";
                }
            ?>
            <div class="col-md-3">
                {!! $checked !!} {{$row->name}} 
            </div>
        @endforeach
    </div>
    {!!Helper::close("form")!!}
    {!! Helper::closePage()!!}
@endsection

@section('myscript')
  <script>
        var url = "{{url('admin/roles/')}}";
        $(".btnAction").on('click',function(){
        var action = $(this).data("action");
        $("#action").val(action);
        if(confirm("Are you sure you want to perform this action?"))
        {
            var pURL = url + "/" + action;
            $('#frm').attr('action', pURL).submit();
        }
    });
        // $("#btnEdit").on('click',function(){
        // var refid=$("#id").val();
        // location.href = url + "/edit/"+refid;
        
        // $(".btnAction").on('click',function(){
        //     var action = $(this).data("action");
        //     $("#action").val(action);
        //     if(confirm("Are you sure you want to perform this action?"))
        //    {
        //         var pURL = url + "/" + action;
        //         $('#frm').attr('action', pURL).submit();
        //    }
        // });
    </script>
@endsection



