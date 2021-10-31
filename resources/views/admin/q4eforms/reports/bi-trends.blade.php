<?php
    use App\Helpers\ApolloHelpers;
?>
@extends('layouts/contentLayoutMaster')
@section('title', 'Q4e Forms')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
{!!Helper::form(array("name"=>"frm","action"=>"admin/q4eforms/reports/bi-trends/filter","validate"=>"Yes"))!!}
{!!Helper::hidden(array("name"=>"id","value"=>$id))!!}
<div class="row">
	{!! Helper::selectList(array("colspan"=>4,"label"=>"From Period","name"=>"fromper","options"=>$lstPeriods,"key"=>"id","val"=>"name","value"=>$data['fromper'])) !!}
	{!! Helper::selectList(array("colspan"=>4,"label"=>"To Period","name"=>"toper","options"=>$lstPeriods,"key"=>"id","val"=>"name","value"=>$data['toper'])) !!}
	{!! Helper::button(array("colspan"=>4,"label"=>"Filter","name"=>"btnFilter","type"=>"submit","class"=>"btn btn-primary formButton"))!!}

</div>
{!! Helper::close("form")!!}
@if($data['display']=="Y")
	<div class="row">
		<div class="col-md-12">
			<canvas id="canvas"></canvas>
		</div>
	</div>
@endif
{!! Helper::closePage() !!}
@endsection
@section('myscript')
<script>
   @if($data['display']=="Y")
   	var configOutcome = {
      type: 'line',
      data: {
        labels: <?php echo json_encode($chart['labels']); ?>,
        datasets: <?php echo json_encode($chart['data']); ?>
      },
      options: {
        responsive: true,
        title: {
          display: false 
        },
        tooltips: {
          mode: 'index',
          intersect: false,
        },
        hover: {
          mode: 'nearest',
          intersect: true
        },
        scales: {
          xAxes: [{
            display: true,
            scaleLabel: {
              display: true,
              labelString: 'Month'
            }
          }],
          yAxes: [{
            display: true,
            ticks:{ min:0, steps:5},
            scaleLabel: {
              display: true,
              labelString: 'Value'
            }
          }]
        }
      }
    };
     window.onload = function() {
      var ctxOutcome = document.getElementById('canvas').getContext('2d');
      window.myLine = new Chart(ctxOutcome, configOutcome);
      };
   @endif
</script>
@endsection