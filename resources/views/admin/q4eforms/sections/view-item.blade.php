@extends('layouts/contentLayoutMaster')
@section('title', 'Q4e Forms')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
   
    <div class="row">
        <div class="col-md-12">
            {!!Helper::linkButton(array("url"=>url('admin/q4eforms/'.$ftype.'/section/items/edit/'.$id."/".$sectionID."/".$itemID),"label"=>"Edit Item","class"=>"btn-warning"))!!}
            {!!Helper::linkButton(array("url"=>url('admin/q4eforms/'.$ftype.'/section/view/'.$id."/".$sectionID),"label"=>"Back to Sections","class"=>"btn-primary"))!!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h4>{{ $results['formname'] }} > {{$results['name']}}</h4>
        </div>
    </div>
    <div class="row">
        {!! Helper::display(array("colspan"=>10,"label"=>"Title","value"=>$rsItem->name))!!}
        {!! Helper::display(array("colspan"=>2,"label"=>"Display","value"=>$rsItem->name_show=="Y" ? "Yes" : "No"))!!}
    </div>
    <div class="row">
        {!! Helper::display(array("colspan"=>10,"label"=>"Caption","value"=>$rsItem->header))!!}
        {!! Helper::display(array("colspan"=>2,"label"=>"Display","value"=>$rsItem->header_show=="Y" ? "Yes" : "No"))!!}
    </div>
    <div class="row">
        {!! Helper::display(array("colspan"=>3,"label"=>"Type","value"=>$rsItem->typ))!!}
        {!! Helper::display(array("colspan"=>2,"label"=>"Display Order","name"=>"ord","value"=>$rsItem->ord))!!}
        {!!Helper::display(array("colspan"=>3,"label"=>"Status","value"=>$rsItem->status == "0" ? "Active" : "Suspended"))!!}
        {!! Helper::display(array("colspan"=>2,"label"=>"No. of Results","value"=>$rsItem->no_results))!!}
        {!! Helper::display(array("colspan"=>2,"label"=>"Max. Val","value"=>$rsItem->max_val))!!}
    </div>
     
    <div class="row">
        {!! Helper::display(array("colspan"=>10,"label"=>"Remarks Caption","name"=>"remarks","placeholder"=>"Enter Remarks Caption","value"=>$rsItem->remarks))!!}
        {!! Helper::display(array("colspan"=>2,"label"=>"Display","value"=>$rsItem->remarks_show=="Y" ? "Yes" : "No"))!!}
    </div>
    <div class="row">
        {!! Helper::display(array("colspan"=>10,"label"=>"Results Caption","value"=>$rsItem->results_caption))!!}
        {!! Helper::display(array("colspan"=>2,"label"=>"Display","value"=>$rsItem->caption_show=="Y" ? "Yes" : "No"))!!}
    </div>
    @if($results->no_results == 2)
        <div class="row">
            {!! Helper::display(array("colspan"=>10,"label"=>"Results 2 Caption","value"=>$rsItem->caption2))!!}
             {!! Helper::display(array("colspan"=>2,"label"=>"Display","value"=>$rsItem->caption2_show=="Y" ? "Yes" : "No"))!!}
        </div>
    @endif
    @if($rsItem->typ == "SELECT" || $rsItem->typ=="RADIO")
        <div class="row">
            <div class="col-md-1">Sr #</div>
            <div class="col-md-3"><label>Label</label></div>
            <div class="col-md-2"><label>Value</label></div>
            <div class="col-md-3"><label>Inc. in Results Calc</label></div>
            <div class="col-md-3"><label>Status</label></div>
        </div>
        <?php $ctr=1; ?>
        @foreach($rsItemChoice as $row)
            <div class="row">
                <div class="col-md-1">{{$ctr}}</div>
                {!! Helper::display(array("colspan"=>3,"value"=>$row->label))!!}
                {!! Helper::display(array("colspan"=>2,"value"=>$row->val))!!}
                {!! Helper::display(array("colspan"=>2,"value"=>$row->include == 1 ? "Yes" : "No"))!!}
                {!! Helper::display(array("colspan"=>3,"value"=>$row->status == 0 ? "Active" : "Suspended"))!!}
            </div>
            <?php $ctr++; ?>
        @endforeach
    @endif
    {!! Helper::close("form") !!}
    {!! Helper::closePage() !!}
@endsection
@section('myscript')
<script>
    var n = '{{$rsItem->no_results}}';
    var t = '{{$rsItem->typ}}';
    if(n == 2){
        $("#divRes2").show();
    }
    if(t == "SELECT"){
        $("#divChoice").show();
    }
</script>
@endsection