<?php
    use App\Helpers\ApolloHelpers;
?>
@extends('layouts/contentLayoutMaster')
@section('title', 'Q4e Forms')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
{!!Helper::form(array("name"=>"frm","action"=>"admin/q4eforms/reports/bi-standing/filter","validate"=>"Yes"))!!}
{!!Helper::hidden(array("name"=>"id","value"=>$id))!!}
<div class="row">
	{!! Helper::selectList(array("colspan"=>4,"label"=>"Select Period","name"=>"period","options"=>$lstPeriods,"key"=>"id","val"=>"name","value"=>$data['period'])) !!}
	{!! Helper::button(array("colspan"=>8,"label"=>"Filter","name"=>"btnFilter","type"=>"submit","class"=>"btn btn-primary formButton"))!!}

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
   		var barChartData = {
			labels: <?php echo json_encode($chart['labels']); ?>,
			datasets:<?php echo json_encode($chart['data']); ?>

		};

		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myBar = new Chart(ctx, {
				type: 'bar',
				data: barChartData,
				options: {
					responsive: true,
					legend: {
						position: 'top',
					},
					title: {
						display: false,
						text: 'Chart.js Bar Chart'
					},
					scales: {
						xAxes: [{barPercentage: 0.4,ticks: {padding: 20}}],
				        yAxes: [{
				            display: true,
				            ticks: {
				                suggestedMin: 0, 
				                beginAtZero: true  
				            }
				        }]
				    }
				}
			});

		};
   @endif
</script>
@endsection