@extends('layouts/contentLayoutMaster')
@section('title', 'Q4e Forms')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    {!!Helper::form(array("name"=>"frm","action"=>"admin/q4eforms/".$ftype."/section/items/save","validate"=>"Yes"))!!}
    {!!Helper::hidden(array("name"=>"id","value"=>$id))!!}
    {!!Helper::hidden(array("name"=>"ftype","value"=>$ftype))!!}
    {!!Helper::hidden(array("name"=>"sectionid","value"=>$sectionID))!!}
    <div class="row">
        <div class="col-md-12">
            {!! Helper::button(array("name"=>"btnSubmit","label"=>"Add Item","type"=>"submit"))!!}
            {!!Helper::linkButton(array("url"=>url('admin/q4eforms/'.$ftype.'/section/view/'.$id."/".$sectionID),"label"=>"Back to Sections","class"=>"btn-primary"))!!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h4>{{ $results['formname'] }} > {{$results['name']}}</h4>
        </div>
    </div>
    <div class="row">
        {!! Helper::textbox(array("colspan"=>10,"label"=>"Title","name"=>"name","placeholder"=>"Enter Title","class"=>" validate[required]","required"=>"Yes","value"=>""))!!}
        {!! Helper::checkbox(array("colspan"=>2,"label"=>"Display","name"=>"name_show","value"=>"Y","selected"=>"Y"))!!}
    </div>
    <div class="row">
        {!! Helper::textbox(array("colspan"=>10,"label"=>"Caption","name"=>"header","placeholder"=>"Enter Optional Header","value"=>""))!!}
        {!! Helper::checkbox(array("colspan"=>2,"label"=>"Display","name"=>"header_show","value"=>"Y","selected"=>"Y"))!!}
    </div>
    <div class="row">
        {!! Helper::select(array("colspan"=>3,"label"=>"Type","name"=>"typ","options"=>$lstInputType))!!}
        {!! Helper::textbox(array("colspan"=>2,"label"=>"Display Order","name"=>"ord","placeholder"=>"Enter Display Order","typ"=>"NUMBER","class"=>" validate[required]","required"=>"Yes","value"=>""))!!}
        {!!Helper::selectStatus(array("name"=>"status","placeholder"=>"Enter Status","colspan"=>3,"label"=>"Status","class"=>"textarea validate[required]","value"=>old('status')))!!}
        {!! Helper::select(array("colspan"=>2,"label"=>"No. of Results","name"=>"no_results","options"=>array("1"=>1,"2"=>2)))!!}
         {!! Helper::textbox(array("colspan"=>2,"label"=>"Max. Val","name"=>"max_val","placeholder"=>"Enter Maximum Value","typ"=>"NUMBER","value"=>"0"))!!}
    </div>
     
    <div class="row">
        {!! Helper::textbox(array("colspan"=>10,"label"=>"Remarks Caption","name"=>"remarks","placeholder"=>"Enter Remarks Caption","value"=>""))!!}
        {!! Helper::checkbox(array("colspan"=>2,"label"=>"Display","name"=>"remarks_show","value"=>"Y","selected"=>"Y"))!!}
    </div>
    <div class="row">
        {!! Helper::textbox(array("colspan"=>10,"label"=>"Results Caption","name"=>"results_caption","placeholder"=>"Enter Remarks Caption","value"=>""))!!}
        {!! Helper::checkbox(array("colspan"=>2,"label"=>"Display","name"=>"caption_show","value"=>"Y","selected"=>"Y"))!!}
    </div>
    <div id="divRes2" style="display:none">
        <div class="row">
            {!! Helper::textbox(array("colspan"=>10,"label"=>"Results 2 Caption","name"=>"caption2","placeholder"=>"Enter Remarks Caption","value"=>""))!!}
            {!! Helper::checkbox(array("colspan"=>2,"label"=>"Display","name"=>"caption2_show","value"=>"Y","selected"=>"Y"))!!}
        </div>
    </div>
    <div id="divChoice" style="display:none">
        <div class="row">
            <div class="col-md-1">Sr #</div>
            <div class="col-md-3"><label>Label</label></div>
            <div class="col-md-2"><label>Value</label></div>
            <div class="col-md-3"><label>Inc. in Results Calc</label></div>
            <div class="col-md-3"><label>Status</label></div>
        </div>
        <?php for($ctr=1;$ctr<=10;$ctr++) { ?>
            <div class="row">
                <div class="col-md-1">{{$ctr}}</div>
                {!! Helper::textbox(array("colspan"=>3,"name"=>"label".$ctr,"placeholder"=>"Label"))!!}
                {!! Helper::textbox(array("colspan"=>2,"name"=>"val".$ctr,"typ"=>"NUMBER","placeholder"=>"Value"))!!}
                {!! Helper::checkbox(array("colspan"=>2,"name"=>"include".$ctr,"value"=>"1","selected"=>"1"))!!}
                {!!Helper::selectStatus(array("name"=>"status".$ctr,"placeholder"=>"Enter Status","colspan"=>3))!!}
            </div>
        <?php } ?>
    </div>
    {!! Helper::close("form") !!}
    {!! Helper::closePage() !!}
@endsection
@section('myscript')
<script>
    $("#typ").on('change',function(){
        var t = $(this).val();
        $("#divChoice").hide();
        if(t=="SELECT"){
            $("#divChoice").show();
        }
    });
    $("#no_results").on('change',function(){
        var t = $(this).val();
        $("#divRes2").hide();
        if(t==2){
            $("#divRes2").show();
        }
    });
</script>
@endsection