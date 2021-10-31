@extends('layouts/contentLayoutMaster')
@section('title', 'Dashboard')

 
@section('mystyle')
        <link rel="stylesheet" href="{{ asset('public/css/pages/dashboard-ecommerce.css') }}">
        <link rel="stylesheet" href="{{ asset('public/css/pages/card-analytics.css') }}">
@endsection
@section('content')
{!! Helper::form(array("name"=>"frm","action"=>"admin/dashboard/filter"))!!}
{!! Helper::hidden(array("name"=>"action","value"=>""))!!}
<?php 
  $nextDate = date('Y-m-01',strtotime('first day of +1 month'));
  $bgColors = array("","primary","success","danger","warning","info");
  $dCtr=1;
  ?>
  <section id="dashboard-ecommerce">
    <div class="row">
      @foreach($lstDashboard as $row)
        <div class="col-lg-3 col-sm-4 col-12">
          <div class="card">
            <div class="card-header d-flex flex-column align-items-start pb-0">
              <div class="row">
                <div class="col-lg-4 col-md-4 col-xs-4">
                  <div class="avatar bg-rgba-{{$bgColors[$dCtr]}} p-50 m-0">
                    <div class="avatar-content">
                      <a href="{{url($row['desturl'])}}"><i class="fa {{$row['icon'] }} text-{{$bgColors[$dCtr]}} font-medium-5"></i></a> 
                    </div>
                  </div>
                </div>
                <div class="col-lg-8 col-md-8 col-xs-8">
                  <h5 class="mb-0" style="margin-top:15px;">{{$row['caption']}}</h5>
                </div>
              </div>
              <h2 class="text-bold-700 mt-1">{{$row['value']}}</h2> 
            </div>
          </div>
        </div> 
        <?php
          $dCtr++;
          if($dCtr >= count($bgColors)) $dCtr=1;
        ?>
      @endforeach
    </div>
    <div class="card">
      <div class="card-body">
         <h4>Incidents</h4>
    <div class="row">
      <div class="col-md-4">
       
        <canvas id="canIncidents" height="200px"></canvas>
      </div>
      <div class="col-md-8">
        <canvas id="canIncidentsBar" height="150px"></canvas>
      </div>
    </div>
  </div></div>
    <div class="card">
      <div class="card-body">
     
          
          </div>
         
       </div>
  </section>
  {!! Helper::close("form") !!}
@endsection
@section('vendor-script')
         
@endsection
@section('myscript')
<script>
  var lstLocations = <?php echo json_encode($lstOutcomeLocs) ?>;
  $("#oForm").on('change',function(){
    var i = $(this).val();
    fillRegions(i);
    
  });
  function fillRegions(form){
    var html = '<option></option>';
    for(var k=0;k <= lstLocations.length - 1;k++){
      if(lstLocations[k].form_id == form){
        html = html + '<option value="' + lstLocations[k].region + '">' + lstLocations[k].regionname + '</option>';
      }
    }
    $("#region").html(html);
  }
  var selForm = '<?php echo $outcome["oForm"] ?>';
  var selRegion = '<?php echo $outcome["oRegion"] ?>';
  fillRegions(selForm);
  $("#region").val(selRegion);
  $("#btnOFilter").on('click',function(){
    $("#action").val('OUTCOME');
    var region = $("#region").val();
    if(region == ""){
      alert("Select Region");
    }
    else {
      $("#frm").submit();
    }
  });
      
    window.onload = function() {
      var ctxOutcome = document.getElementById('canOutcome').getContext('2d');
      window.myLine = new Chart(ctxOutcome, configOutcome);
      var ctxIncidents = document.getElementById('canIncidents').getContext('2d');
      window.myDoughnut = new Chart(ctxIncidents, configIncidents);
      var ctxIncidentsBar = document.getElementById('canIncidentsBar').getContext('2d');
      window.myBar = new Chart(ctxIncidentsBar, {
        type: 'bar',
        data: configIncidentsBar,
        options: {
          responsive: true,
          legend: {
            display: false,
            position: 'top',
          },
          scales: {
            yAxes: [{display: true, ticks: {suggestedMin: 0, beginAtZero: true}}]
          },
          title: {
            display: false,
            text: 'Chart.js Bar Chart'
          }
        }
      });
    };
  </script>
@endsection

