@extends('layouts/contentLayoutMaster')
@section('title', 'Locations')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>"Locations")) !!}
    <div class="row">
        @foreach($lstBU as $row)
            <div class="col-md-3 btn @if($bu == $row['id']) btn-warning @else btn-primary @endif" style="margin-right:3px;margin-bottom:3px;">
                <a href="{{url('admin/locations/region/'.$row['id'])}}"><h4>{{$row['name']}}</h4></a>
                {{$row['count']}} Centers
            </div>
        @endforeach
    </div>
    <hr/>
    {!! Helper::form(array("name"=>"frm","action"=>"admin/locations/centers"))!!}
    {!! Helper::hidden(array("name"=>"bu","value"=>$bu))!!}
    <div class="row">
        {!! Helper::selectList(array("colspan"=>4,"label"=>"Select Region","name"=>"region","options"=>$lstRegions,"value"=>$region,"key"=>"id","val"=>"name"))!!}
        {!! Helper::button(array("colspan"=>8,"name"=>"btnFilter","label"=>"Filter","type"=>"submit","class"=>"btn btn-primary formButton "))!!} 
    </div>
    {!! Helper::close("form")!!}
    <hr/>
    {!! Helper::responsiveTable(array("Clinic Code","Name","Center Head","BU Head","COO","CEO","HOQ","Status",""))!!}
    @foreach($lstCenter as $row)
        <tr>
            <td>{{$row['clinic_code']}}</td>
            <td><a href="{{url('admin/locations/centers/forms/'.$row['id'])}}">{{$row['name']}}</a></td>
            <td>{{$row['centerHead']}}</td>
            <td>{{$row['buHead']}}</td>
            <td>{{$row['cooName']}}</td>
            <td>{{$row['ceoName']}}</td>
            <td>{{$row['hoqName']}}</td>
            <td>{{$row['statusName']}}</td>
            <td><a href="{{url('admin/locations/users/'.$row['id'])}}"><i class="fa fa-users"></i></a></td>
        </tr>
    @endforeach
    {!! Helper::closeResponsiveTable()!!}
    {!! Helper::closePage() !!}
</section>
@endsection
@section('myscript')
<script>

</script>
@endsection

 