@extends('layouts/contentLayoutMaster')
@section('title', 'Menus')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>""))!!}
{!! Helper::form(array("name"=>"frm","action"=>"admin/menus/update","validate"=>"Yes"))!!}
{!! Helper::hidden(array("name"=>"action","value"=>"update"))!!}
{!! Helper::hidden(array("name"=>"id","value"=>$id))!!}
{!! Helper::button(array("colspan"=>12,"name"=>"btnUpdate","label"=>"Update","type"=>"submit")) !!}
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div><br/>
    @endif
    <div class="row">
        {!! Helper::textbox(array("colspan"=>4,"label"=>"Name","name"=>"name","placeholder"=>"Enter Name","required"=>"Yes","class"=>"validate[required]","max"=>50,"value"=>$results['name'])) !!}
        {!! Helper::textbox(array("colspan"=>4,"label"=>"Icon","name"=>"icon","class"=>"validate[required]","required"=>"Y","max"=>150,"value"=>$results['icon']))!!}
        {!! Helper::display(array("colspan"=>4,"label"=>"Route","name"=>"route","class"=>"validate[required]","required"=>"Y","max"=>150,"value"=>$results['route']))!!}
    </div>

    <div class="row">
        {!! Helper::textbox(array("colspan"=>3,"label"=>"Ord","name"=>"ord","placeholder"=>"Enter Order","required"=>"Yes","class"=>"validate[required,custom[number]]","value"=>$results['ord'])) !!}
        {!! Helper::selectStatus(array("colspan"=>3,"label"=>"Status","name"=>"status","value"=>$results['status']))!!}
        {!! Helper::select(array("colspan"=>3,"label"=>"Display in Footer","name"=>"footer","value"=>$results['footer'],"options"=>array("0"=>"No","1"=>"Yes")))!!}
        {!! Helper::select(array("colspan"=>3,"label"=>"Default Show to Users","name"=>"def","value"=>$results['def'],"options"=>array("0"=>"No","1"=>"Yes")))!!}
    </div>
{!! Helper::textbox(array("colspan"=>12,"label"=>"Summary","name"=>"summary","placeholder"=>"Enter Summary","typ"=>"TEXTAREA","value"=>$results['summary'])) !!}
    {!! Helper::close("form")!!}
    {!! Helper::closePage()!!}
@endsection
