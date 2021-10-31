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
    {!! Helper::form(array("name"=>"frm","action"=>"admin/slides/update","validate"=>"Yes")) !!}
    {!! Helper::hidden(array("name"=>"id","value"=>$results['id']))!!}
    {!! Helper::hidden(array("name"=>"typ","value"=>$results['typ']))!!}
    {!! Helper::button(array("colspan"=>12,"name"=>"btnUpdate","label"=>"Update","type"=>"submit")) !!}
    {!! Helper::textbox(array("colspan"=>12,"label"=>"Title","name"=>"title","max"=>50,"placeholder"=>"Enter Title","value"=>$results['title'],"class"=>"validate[required]","required"=>"Yes")) !!}
    <div class="row">
        {!! Helper::textbox(array("colspan"=>3,"label"=>"Display Order","name"=>"ord","typ"=>"number","value"=>$results['ord']))!!}
        {!! Helper::selectStatus(array("colspan"=>3,"label"=>"Status","name"=>"status","value"=>$results['status']))!!}
    </div>
    @if($results['typ'] =="WELCOME")
        <div id="divWelcome">
            {!! Helper::textbox(array("colspan"=>12,"label"=>"Caption","name"=>"caption","max"=>50,"placeholder"=>"Enter Caption","value"=>$results['caption'])) !!}
            {!! Helper::textbox(array("colspan"=>12,"label"=>"Message","name"=>"body","typ"=>"TEXTAREA","placeholder"=>"Enter Message","value"=>$results['body'])) !!}
        </div>
    @endif
    @if($results['typ'] =="CONGRATS")
        <div id="divCongrats">
            {!! Helper::textbox(array("colspan"=>12,"label"=>"Caption","name"=>"caption","max"=>50,"placeholder"=>"Enter Caption","value"=>$results['caption'])) !!}
            {!! Helper::textbox(array("colspan"=>12,"label"=>"Message","name"=>"body","typ"=>"TEXTAREA","placeholder"=>"Enter Message","value"=>$results['body'])) !!}
        </div>
    @endif
    @if($results['typ'] =="BANNER")
         <div class="row">
            <div class="col-md-12">
                <img src="{{$results['imgurl']}}" class="img-fluid"/>
            </div>
        </div>
        <div id="divBanner">
            {!! Helper::textbox(array("colspan"=>12,"label"=>"Image","name"=>"img","typ"=>"FILE","placeholder"=>"Select Image","value"=>$results['img'])) !!}
        </div>
    @endif
    @if($results['typ'] =="VIDEO")
        <div id="divVideo">
            {!! Helper::textbox(array("colspan"=>12,"label"=>"Video URL (Embed Code)","name"=>"video","placeholder"=>"https://youtube.com/embed","value"=>$results['video'])) !!}
        </div>
    @endif
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
