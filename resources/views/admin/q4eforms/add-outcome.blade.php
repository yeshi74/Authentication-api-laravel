<?php
    use App\Helpers\ApolloHelpers;
?>
@extends('layouts/contentLayoutMaster')
@section('title', 'Q4E Forms')
@section('content')
	{!!Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    {!!Helper::form(array("name"=>"frm","action"=>"admin/q4eforms/".$ftype."/outcome/save","validate"=>"Yes"))!!}
    {!!Helper::hidden(array("name"=>"id","value"=>$id))!!}
    {!!Helper::hidden(array("name"=>"ftype","value"=>$ftype))!!}
    {!!Helper::button(array("colspan"=>12,"name"=>"btnSave","label"=>"Save","type"=>"submit"))!!}
    <section id="column-selectors">
        {!! Helper::textbox(array("colspan"=>12,"label"=>"Parameter","name"=>"parameter","class"=>"validate[required]"))!!}
        {!! Helper::textbox(array("colspan"=>12,"label"=>"Numerator","name"=>"numerator","class"=>""))!!}
        {!! Helper::textbox(array("colspan"=>12,"label"=>"Denominator","name"=>"denominator","class"=>""))!!}
        <div class="row">
            {!! Helper::select(array("colspan"=>3,"label"=>"Type","name"=>"typ","class"=>"validate[required]","options"=>$lstType,"key"=>"id","val"=>"name"))!!}
            {!! Helper::textbox(array("colspan"=>3,"label"=>"Display Order","name"=>"ord","placeholder"=>"Enter Display Order","typ"=>"NUMBER","class"=>" validate[required]","required"=>"Yes","value"=>""))!!}
            {!!Helper::selectStatus(array("name"=>"status","placeholder"=>"Enter Status","colspan"=>3,"label"=>"Status","class"=>"textarea validate[required]","value"=>old('status')))!!}
            {!! Helper::textbox(array("colspan"=>3,"label"=>"Adbhutham Code","name"=>"api_code","class"=>""))!!}
        </div>
        <div id="divItems">
            <div class="row">
                {!! Helper::selectList(array("name"=>"formula","placeholder"=>"Formula","colspan"=>3,"label"=>"Formula","options"=>$lstResultsCalc,"key"=>"id","val"=>"typ","value"=>old('formula'))) !!}
                {!! Helper::selectList(array("colspan"=>3,"label"=>"Unit of Measurement","name"=>"uom","class"=>"","options"=>$lstCategory,"key"=>"id","val"=>"name"))!!}
                {!! Helper::textbox(array("colspan"=>3,"label"=>"Benchmark Reference","name"=>"bench_ref","class"=>""))!!}
                {!! Helper::textbox(array("colspan"=>3,"label"=>"Benchmark Value","name"=>"bench_val","class"=>""))!!}
            </div>
            <h6>Scoring Range</h6>  
            <div class="row">
                <div class="col-md-1"><label>Range</label></div>
                <div class="col-md-2"><label>Minimum Value</label></div>
                <div class="col-md-2"><label>Maximum Value</label></div>
                <div class="col-md-3"><label>Display Label</label></div>
                <div class="col-md-4"></div>
            </div>
            <?php for($ctr=5;$ctr>=1;$ctr--){ ?>
                <div class="row">
                    <div class="col-md-1"><label><?php echo $ctr ?></label></div>
                    <div class="col-md-2">
                        <input type="text" name="score_min_<?php echo $ctr ?>" id="score_min_<?php echo $ctr ?>" value="0" class="form-control validate[required,custom[number]]">
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="score_max_<?php echo $ctr ?>" id="scoremax_<?php echo $ctr ?>" value="0" class="form-control validate[required,custom[number]]">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="score_label_<?php echo $ctr ?>" id="scorelbl_<?php echo $ctr ?>" class="form-control validate[required]">
                    </div>
                    <div class="col-md-4"></div>
                </div>
            <?php } ?>
            
        </div>
    </section>
    {!!Helper::close("form")!!}
    {!! Helper::closePage()!!}
@endsection
@section('myscript')
<script>
    $("#typ").on('change',function(){
        var t = $(this).val();
        if(t=="LABEL"){
            $("#divItems").hide();
        }
        else{
            $("#divItems").show();
        }
    });
</script>
@endsection