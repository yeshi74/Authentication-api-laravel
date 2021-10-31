<?php
    use App\Helpers\ApolloHelpers;
    $ctr=1;
?>
@extends('layouts/contentLayoutMaster')
@section('title', 'Q4E Forms')
@section('content')
	{!!Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    <div class="row">
        <div class="col-md-12">
            {!! Helper::linkButton(array("url"=>url('admin/q4eforms/'.$ftype.'/outcome/editresults/'.$id),"label"=>"Edit","class"=>"btn btn-primary"))!!}
             {!! Helper::linkButton(array("url"=>url('admin/q4eforms/'.$ftype.'/outcome/detailresults/'.$id),"label"=>"Detailed Results","class"=>"btn btn-primary"))!!}
            {!! Helper::linkButton(array("url"=>url('admin/q4eforms/'.$ftype.'/outcome/exportresults/'.$id),"target"=>"_new","label"=>"Export Results","class"=>"btn btn-primary"))!!}
        </div>
    </div>
    <div class="row">
        {!!Helper::display(array("colspan"=>3,"label"=>"User","value"=>$results['username']))!!}
        {!!Helper::display(array("colspan"=>3,"label"=>"Location","value"=>$results['locname']))!!}
    </div>
    @foreach($data as $ky=>$val)
        <h4>{{$val['label']}}</h4>
        <canvas id="can{{$ky}}" height="100px;"></canvas>
        <p>
            <strong>Parameter: </strong>{{$val['footer']['parameter']}}<br/>
            <strong>Numerator: </strong>{{$val['footer']['numerator']}}<br/>
            <strong>Denominator: </strong>{{$val['footer']['denominator']}}<br/>
            <strong>Formula: </strong>{{$val['footer']['formula']}}<br/>
            <strong>BenchMark: </strong>{{$val['footer']['bench_ref']}} {{$val['footer']['bench_val']}}
        </p>
        <hr/>
    @endforeach
  
    {!! Helper::closePage()!!}
@endsection
@section('myscript')
<script>
        @foreach($data as $ky=>$val)
            var config{{$ky}} = {
                type: 'line',
                data: {
                    labels: [@foreach($lstPeriod as $row)  '{{$row["name"]}}', @endforeach],
                    datasets: <?php echo json_encode($val['data']); ?>
                },
                options: {
                    responsive: true, 
                    title: { display: false },
                    tooltips: { mode: 'index', intersect: false,},
                    hover: {mode: 'nearest',intersect: true},
                    scales: {
                        xAxes: [{display: true,scaleLabel: {display: true,labelString: 'Month'}}],
                        yAxes: [{display: true, ticks:{ min:0, steps:5}, scaleLabel: {display: true,labelString: 'Value'}}]
                    }
                }
            };
        @endforeach
         window.onload = function() {
        @foreach($data as $ky=>$val)
           
              var ctxOutcome{{$ky}} = document.getElementById('can{{$ky}}').getContext('2d');
              window.myLine{{$ky}} = new Chart(ctxOutcome{{$ky}}, config{{$ky}});
            
        @endforeach
        };
</script>
@endsection