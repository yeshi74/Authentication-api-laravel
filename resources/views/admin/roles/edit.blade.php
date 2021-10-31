@extends('layouts/contentLayoutMaster')
@section('title', 'Roles')
@section('content')

    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>""))!!}
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div><br />
    @endif
    {!!Helper::form(array("name"=>"frm","action"=>"admin/roles/update","validate"=>"Yes"))!!}
    {!!Helper::hidden(array("name"=>"action","value"=>"update"))!!}
    {!!Helper::hidden(array("name"=>"id","value"=>$id))!!}
    {!!Helper::button(array("colspan"=>12,"name"=>"btnUpdate","label"=>"Update","type"=>"button"))!!}
        
    <div class="row">
        {!!Helper::textbox(array("colspan"=>3,"label"=>"Code","name"=>"code","max"=>45,"value"=>$results['code'],"class"=>"validate[required]"))!!}
        {!!Helper::textbox(array("colspan"=>6,"label"=>"Name","name"=>"name","max"=>150,"class"=>"validate[required]","required"=>"Y","value"=>$results['name']))!!}
        {!! Helper::select(array("colspan"=>3,"label"=>"Default Role","name"=>"def_role","value"=>$results['def_role'],"options"=>array("0"=>"No","1"=>"Yes")))!!}
    </div>
    <legend>Permissions</legend>
    <div class="row">
        @foreach($lstOpts as $row)
            <?php
                $checked="";
                foreach($lstRoles as $r){
                    if($r->menuid == $row->id) $checked="checked";
                }
            ?>
            <div class="col-md-3">
                <input {{$checked}} type="checkbox"  name="menuid[]" value="{{$row->id}}">{{$row->name}}&nbsp;
            </div>
        @endforeach
    </div>       
    {!! Helper::close("form")!!}
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


