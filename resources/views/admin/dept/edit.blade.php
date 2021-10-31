@extends('layouts/contentLayoutMaster')
@section('title', 'Departments')
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
    {!! Helper::form(array("name"=>"frm","action"=>"admin/dept/update","validate"=>"Yes")) !!}
    {!! Helper::hidden(array("name"=>"id","value"=>$id)) !!}
    {!! Helper::button(array("colspan"=>12,"name"=>"btnUpdate","label"=>"Update","type"=>"submit")) !!}
    <div class="row">
        {!! Helper::textbox(array("colspan"=>6,"label"=>"Name","name"=>"name","max"=>50,"placeholder"=>"Enter Dept. Name","value"=>$results['name'],"class"=>"validate[required]","required"=>"Yes")) !!}
        {!! Helper::selectList(array("colspan"=>3,"label"=>"Parent Department","name"=>"parent","options"=>$lstDept,"key"=>"id","val"=>"name","blanks"=>"Yes","value"=>$results['parent']))!!}
        {!! Helper::selectStatus(array("colspan"=>3,"label"=>"Status","name"=>"status","value"=>$results['status']))!!}
    </div>
    {!! Helper::close("form")!!}
    {!! Helper::closePage()!!}
@endsection
