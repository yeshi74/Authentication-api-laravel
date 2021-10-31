
@extends('layouts/contentLayoutMaster')
@section('title', 'Q4e Type')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
        {!!Helper::form(array("name"=>"frm","action"=>"admin/q4etype/update","validate"=>"Yes"))!!}
        {!!Helper::hidden(array("name"=>"action","value"=>"update"))!!}
        {!!Helper::hidden(array("name"=>"id","value"=>$id))!!}
        {!!Helper::button(array("colspan"=>10,"name"=>"btnUpdate","label"=>"Update","type"=>"button"))!!}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br />
        @endif
            <section id="column-selectors">
                <div class="row">
                    {!!Helper::textbox(array("colspan"=>4,"label"=>"Name","name"=>"name","value"=>$results['name'],"class"=>"validate[required]","max"=>50))!!}
                    {!!Helper::textbox(array("colspan"=>4,"label"=>"Code","name"=>"code","class"=>"validate[required]","required"=>"Y","value"=>$results['code'],"max"=>150))!!}
                   {!! Helper::select(array("name"=>"typ","colspan"=>4,"label"=>"Type","value"=>$results['typ'],"required"=>"Yes","class"=>"validate[required]",
                                        "options"=>array("Form"=>"Form","Rating"=>"Rating"))) !!}
                </div>
            </section>
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
