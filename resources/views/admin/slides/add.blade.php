@extends('layouts/contentLayoutMaster')
@section('title', 'Slides')
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
    {!! Helper::form(array("name"=>"frm","action"=>"admin/slides/save","validate"=>"Yes")) !!}
    {!! Helper::button(array("colspan"=>12,"name"=>"btnUpdate","label"=>"Save","type"=>"submit")) !!}
    {!! Helper::textbox(array("colspan"=>12,"label"=>"Title","name"=>"title","max"=>50,"placeholder"=>"Enter Title","value"=>old('title'),"class"=>"validate[required]","required"=>"Yes")) !!}
    <div class="row">
        {!! Helper::textbox(array("colspan"=>3,"label"=>"Display Order","name"=>"ord","typ"=>"number","value"=>old('author')))!!}
        {!! Helper::selectStatus(array("colspan"=>3,"label"=>"Status","name"=>"status","value"=>old('status')))!!}
        {!! Helper::select(array("colspan"=>3,"label"=>"Type","name"=>"typ","value"=>old('typ'),"options"=>array("WELCOME"=>"WELCOME","CONGRATS"=>"CONGRATS","BANNER"=>"BANNER","VIDEO"=>"VIDEO")))!!}
    </div>
    <div id="divWelcome">
        {!! Helper::textbox(array("colspan"=>12,"label"=>"Caption","name"=>"caption","max"=>50,"placeholder"=>"Enter Caption","value"=>old('caption'))) !!}
        {!! Helper::textbox(array("colspan"=>12,"label"=>"Message","name"=>"body","typ"=>"TEXTAREA","placeholder"=>"Enter Message","value"=>old('message'))) !!}
    </div>
    <div id="divCongrats" style="display:none">
        {!! Helper::textbox(array("colspan"=>12,"label"=>"Caption","name"=>"caption","max"=>50,"placeholder"=>"Enter Caption","value"=>old('caption'))) !!}
        {!! Helper::textbox(array("colspan"=>12,"label"=>"Message","name"=>"body","typ"=>"TEXTAREA","placeholder"=>"Enter Message","value"=>old('message'))) !!}
    </div>
    <div id="divBanner" style="display:none">
        {!! Helper::textbox(array("colspan"=>12,"label"=>"Image","name"=>"img","typ"=>"FILE","placeholder"=>"Select Image","value"=>old('img'))) !!}
    </div>
    <div id="divVideo" style="display:none">
        {!! Helper::textbox(array("colspan"=>12,"label"=>"Video URL (Embed Code)","name"=>"video","placeholder"=>"https://youtube.com/embed","value"=>old('video'))) !!}
    </div>
    {!! Helper::close("form")!!}
    {!! Helper::closePage()!!}
@endsection
@section('myscript')
<script>
    $("#typ").on('change',function(){
        var t = $(this).val();
        $("#divWelcome").hide();
        $("#divCongrats").hide();
        $("#divBanner").hide();
        $("#divVideo").hide();
        if(t=="WELCOME") $("#divWelcome").show();
        if(t=="CONGRATS") $("#divCongrats").show();
        if(t=="BANNER") $("#divBanner").show();
        if(t=="VIDEO") $("#divVideo").show();
    });
</script>
@endsection
