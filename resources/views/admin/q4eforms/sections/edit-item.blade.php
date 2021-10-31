@extends('layouts/contentLayoutMaster')
@section('title', 'Q4e Forms')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    {!!Helper::form(array("name"=>"frm","action"=>"admin/q4eforms/".$ftype."/section/items/update","validate"=>"Yes"))!!}
    {!!Helper::hidden(array("name"=>"id","value"=>$id))!!}
    {!!Helper::hidden(array("name"=>"ftype","value"=>$ftype))!!}
    {!!Helper::hidden(array("name"=>"sectionid","value"=>$sectionID))!!}
    {!!Helper::hidden(array("name"=>"itemid","value"=>$itemID))!!}
    <div class="row">
        <div class="col-md-12">
            {!! Helper::button(array("name"=>"btnSubmit","label"=>"Update Item","type"=>"submit"))!!}
            {!!Helper::linkButton(array("url"=>url('admin/q4eforms/'.$ftype.'/section/view/'.$id."/".$sectionID),"label"=>"Back to Sections","class"=>"btn-primary"))!!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h4>{{ $results['formname'] }} > {{$results['name']}}</h4>
        </div>
    </div>
    <div class="row">
        {!! Helper::textbox(array("colspan"=>10,"label"=>"Title","name"=>"name","placeholder"=>"Enter Title","class"=>" validate[required]","required"=>"Yes","value"=>$rsItem->name))!!}
        {!! Helper::checkbox(array("colspan"=>2,"label"=>"Display","name"=>"name_show","value"=>"Y","selected"=>$rsItem->name_show))!!}
    </div>
    <div class="row">
        {!! Helper::textbox(array("colspan"=>10,"label"=>"Caption","name"=>"header","placeholder"=>"Enter Optional Header","value"=>$rsItem->header))!!}
        {!! Helper::checkbox(array("colspan"=>2,"label"=>"Display","name"=>"header_show","value"=>"Y","selected"=>$rsItem->header_show))!!}
    </div>
    <div class="row">
        {!! Helper::select(array("colspan"=>3,"label"=>"Type","name"=>"typ","options"=>$lstInputType,"value"=>$rsItem->typ))!!}
        {!! Helper::textbox(array("colspan"=>2,"label"=>"Display Order","name"=>"ord","placeholder"=>"Enter Display Order","typ"=>"NUMBER","class"=>" validate[required]","required"=>"Yes","value"=>$rsItem->ord))!!}
        {!!Helper::selectStatus(array("name"=>"status","placeholder"=>"Enter Status","colspan"=>3,"label"=>"Status","class"=>"textarea validate[required]","value"=>$rsItem->status))!!}
        {!! Helper::select(array("colspan"=>2,"label"=>"No. of Results","name"=>"no_results","value"=>$rsItem->no_results,"options"=>array("1"=>1,"2"=>2)))!!}
         {!! Helper::textbox(array("colspan"=>2,"label"=>"Max. Val","name"=>"max_val","placeholder"=>"Enter Maximum Value","typ"=>"NUMBER","value"=>$rsItem->max_val))!!}
    </div>
     
    <div class="row">
        {!! Helper::textbox(array("colspan"=>10,"label"=>"Remarks Caption","name"=>"remarks","placeholder"=>"Enter Remarks Caption","value"=>$rsItem->remarks))!!}
        {!! Helper::checkbox(array("colspan"=>2,"label"=>"Display","name"=>"remarks_show","value"=>$rsItem->remarks_show,"selected"=>"Y"))!!}
    </div>
    <div class="row">
        {!! Helper::textbox(array("colspan"=>10,"label"=>"Results Caption","name"=>"results_caption","placeholder"=>"Enter Remarks Caption","value"=>$rsItem->results_caption))!!}
        {!! Helper::checkbox(array("colspan"=>2,"label"=>"Display","name"=>"caption_show","value"=>"Y","selected"=>$rsItem->caption_show))!!}
    </div>
    <div id="divRes2" style="display:none">
        <div class="row">
            {!! Helper::textbox(array("colspan"=>10,"label"=>"Results 2 Caption","name"=>"caption2","placeholder"=>"Enter Remarks Caption","value"=>$rsItem->caption2))!!}
            {!! Helper::checkbox(array("colspan"=>2,"label"=>"Display","name"=>"caption2_show","value"=>"Y","selected"=>$rsItem->caption2_show))!!}
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
        <?php $xctr=1; ?>
        @foreach($rsItemChoice as $row)
            <div class="row">
                <div class="col-md-1">{{$xctr}}</div>
                {!! Helper::textbox(array("colspan"=>3,"name"=>"label".$xctr,"value"=>$row->label))!!}
                {!! Helper::textbox(array("colspan"=>2,"name"=>"val".$xctr,"typ"=>"NUMBER","value"=>$row->val))!!}
                {!! Helper::checkbox(array("colspan"=>2,"name"=>"include".$xctr,"value"=>"1","selected"=>$row->include))!!}
                {!!Helper::selectStatus(array("name"=>"status".$xctr,"value"=>$row->status,"colspan"=>3))!!}
            </div>
            <?php $xctr++; ?>
        @endforeach
        @if($xctr < 10)
            <?php for($ctr=$xctr;$ctr<=10;$ctr++) { ?>
                <div class="row">
                    <div class="col-md-1">{{$ctr}}</div>
                    {!! Helper::textbox(array("colspan"=>3,"name"=>"label".$ctr,"placeholder"=>"Label"))!!}
                    {!! Helper::textbox(array("colspan"=>2,"name"=>"val".$ctr,"typ"=>"NUMBER","placeholder"=>"Value"))!!}
                    {!! Helper::checkbox(array("colspan"=>2,"name"=>"include".$ctr,"value"=>"1","selected"=>"1"))!!}
                    {!!Helper::selectStatus(array("name"=>"status".$ctr,"placeholder"=>"Enter Status","colspan"=>3))!!}
                </div>
            <?php } ?>
        @endif
    </div>
    {!! Helper::close("form") !!}
    {!! Helper::closePage() !!}
@endsection
@section('myscript')
<script>
    var n = '{{$rsItem->no_results}}';
    var t = '{{$rsItem->typ}}';
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
    if(n == 2){
        $("#divRes2").show();
    }
    if(t == "SELECT"){
        $("#divChoice").show();
    }
</script>
@endsection