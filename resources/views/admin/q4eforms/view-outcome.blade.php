<?php
    use App\Helpers\ApolloHelpers;
?>
@extends('layouts/contentLayoutMaster')
@section('title', 'Q4E Forms')
@section('content')
	{!!Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    {!! Helper::linkButton(array("url"=>url('admin/q4eforms/'.$ftype.'/outcome/edit/'.$id."/".$results->id),"label"=>"Edit","class"=>"btn btn-primary"))!!}
    <section id="column-selectors">
        {!! Helper::display(array("colspan"=>12,"label"=>"Parameter","value"=>$results['parameter']))!!}
        {!! Helper::display(array("colspan"=>12,"label"=>"Numerator","value"=>$results['numerator']))!!}
        {!! Helper::display(array("colspan"=>12,"label"=>"Denominator","value"=>$results['denominator']))!!}
        <div class="row">
            {!! Helper::display(array("colspan"=>3,"label"=>"Type","value"=>$results['typ']))!!}
            {!! Helper::display(array("colspan"=>3,"label"=>"Display Order","value"=>$results['ord']))!!}
            {!!Helper::display(array("colspan"=>3,"label"=>"Status","value"=>$results['status'] == 0 ? "Active" : "Suspended"))!!}
            {!! Helper::display(array("colspan"=>3,"label"=>"Adbhutham Code","name"=>"api_code","value"=>$results['api_code']))!!}
        </div>
        @if($results['typ'] == "INPUT" || $results['typ'] == "OP_INPUT")
            <div class="row">
                {!! Helper::display(array("colspan"=>3,"label"=>"Formula","value"=>$results['formulaName'])) !!}
                {!! Helper::display(array("colspan"=>3,"label"=>"Unit of Measurement","value"=>$results['uomName']))!!}
                {!! Helper::display(array("colspan"=>3,"label"=>"Benchmark Reference","value"=>$results["bench_ref"]))!!}
                {!! Helper::display(array("colspan"=>3,"label"=>"Benchmark Value","value"=>$results["bench_val"]))!!}
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
                        <?php echo $results['score_'.$ctr.'_min'] ?>
                    </div>
                    <div class="col-md-2">
                        <?php echo $results['score_'.$ctr.'_max'] ?>
                    </div>
                    <div class="col-md-3"><?php echo $results['score_'.$ctr] ?></div>
                    <div class="col-md-4"></div>
                </div>
            <?php } ?>
            
        @endif
    </section>
    {!! Helper::closePage()!!}
@endsection
@section('myscript')
<script>
   
</script>
@endsection