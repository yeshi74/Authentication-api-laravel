@extends('layouts/contentLayoutMaster')
@section('title', 'User Activities')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    {!! Helper::form(array("name"=>"frm","action"=>"admin/users/filter"))!!}
    {!! Helper::hidden(array("name"=>"action","value"=>$action))!!}
    <div class="row">
        <div class="col-md-2">
            <label>Select Period</label>
            <select name="period" id="period" class="form-control">
                @foreach($lstPeriods as $row)
                <?php $sel = $per == $row->val ? "selected" : ""; ?>
                    <option {{$sel}} value="{{$row->val}}">{{$row->label}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button type="button" id="btnFilter" class="btn btn-primary" style="margin-top:20px;">Filter</button>
        </div>
        
        @if($pg=="FILTER" || $pg=="LIST" || $pg=="REPORT")
            <div class="col-md-2">
                <label>Select Date</label>
                <select name="pdate" id="pdate" class="form-control">
                    @foreach($results as $row)
                    <?php $sel = $pdate == $row->ld ? "selected" : ""; ?>
                        <option {{$sel}} value="{{$row->ld}}">{{$row->ld}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <button type="button" id="btnList" class="btn btn-primary" style="margin-top:20px;">List</button>
                <button type="button" id="btnReport" class="btn btn-warning" style="margin-top:20px;">Activity Report</button>
            </div>
        @endif
    </div>
    
    @if($pg=="FILTER")
        <canvas id="canvas"></canvas>
    @endif
    @if($pg=="LIST")
        {!! Helper::responsiveTable(array("User Name"))!!}
        @foreach($lstRecords as $row)
            <tr><td>{{$row->name}}</td></tr>
        @endforeach
        {!! Helper::closeResponsiveTable() !!}
    @endif
    @if($pg=="REPORT")
        {!! Helper::responsiveTable(array("User Name","Menu","Date"))!!}
        @foreach($lstRecords as $row)
            <tr>
                <td>{{$row->username}}</td>
                <td>{{$row->menu}}</td>
                <td>{{$row->logdate}}</td>
            </tr>
        @endforeach
        {!! Helper::closeResponsiveTable() !!}
    @endif
    {!!Helper::close("form")!!}
    {!! Helper::closePage()!!}

@endsection
@section('myscript')
<script>
    $("#btnList").on('click',function()
    {
        $("#action").val("DATE");
        $("#frm").submit();
    });
    $("#btnReport").on('click',function()
    {
        $("#action").val("REPORT");
        $("#frm").submit();
    });
    $("#btnFilter").on('click',function()
    {
        $("#action").val("");
        $("#frm").submit();
    });
    @if($pg=="FILTER")
        var color = Chart.helpers.color;
        var barChartData = {
            labels: [
                @foreach($results as $row)
                    '{{$row->ld}}',
                @endforeach
                ],
            datasets: [{
                label: 'Users',
                backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                borderColor: window.chartColors.red,
                borderWidth: 1,
                data: [
                    @foreach($results as $row)
                        {{$row->c}},
                    @endforeach
                ]
            }]

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
                        display: false
                    }
                }
            });

        };
    @endif
</script>
@endsection