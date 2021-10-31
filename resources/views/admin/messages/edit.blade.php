@extends('layouts/contentLayoutMaster')
@section('title', 'Messages')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>""))!!}
    {!!Helper::form(array("name"=>"frm","action"=>"admin/messages/update","validate"=>"Yes"))!!}
    {!!Helper::hidden(array("name"=>"id","value"=>$id))!!}
    {!!Helper::button(array("colspan"=>12,"name"=>"btnUpdate","label"=>"Update","type"=>"submit"))!!}

    <div class="row">
        {!!Helper::display(array("colspan"=>3,"label"=>"Code","value"=>$results['code']))!!}
        {!!Helper::select(array("colspan"=>3,"label"=>"Icon","name"=>"icon","value"=>$results['icon'],"options"=>$icons,"class"=>"validate[required]"))!!}
        {!!Helper::select(array("colspan"=>3,"label"=>"Type","name"=>"typ","value"=>$results['typ'],"options"=>$typ,"class"=>"validate[required]"))!!}
        {!!Helper::textbox(array("colspan"=>3,"label"=>"Route","name"=>"route","value"=>$results['route']))!!}
    </div>
    {!!Helper::textbox(array("colspan"=>12,"label"=>"Caption","name"=>"caption","max"=>150,"value"=>$results['caption'],"class"=>"validate[required]"))!!}
        
    {!!Helper::textbox(array("colspan"=>12,"label"=>"Message","name"=>"message","typ"=>"TEXTAREA","value"=>$results['message'],"class"=>"validate[required]"))!!}
    </div>

    <div class="row">
        <div class="col-md-12">
            Tips: Use [NAME] to replace the logged user name
        </div>
    </div>
    {!!Helper::close("form")!!}
    {!! Helper::closePage()!!}
@endsection
@section('myscript')

@endsection

