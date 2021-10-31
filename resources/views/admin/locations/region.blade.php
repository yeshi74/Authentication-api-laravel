@extends('layouts/contentLayoutMaster')
@section('title', 'Locations')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>"Locations")) !!}
    <div class="row">
        @foreach($lstBU as $row)
            <div class="col-md-3 btn @if($id == $row['id']) btn-warning @else btn-primary @endif" style="margin-right:3px;margin-bottom:3px;">
                <a href="{{url('admin/locations/region/'.$row['id'])}}"><h4>{{$row['name']}}</h4></a>
                {{$row['count']}} Centers
            </div>
        @endforeach
    </div>
    <hr/>
    {!! Helper::form(array("name"=>"frm","action"=>"admin/locations/centers"))!!}
    {!! Helper::hidden(array("name"=>"bu","value"=>$id))!!}
    <div class="row">
        {!! Helper::selectList(array("colspan"=>4,"label"=>"Select Region","name"=>"region","options"=>$lstRegions,"key"=>"id","val"=>"name"))!!}
        {!! Helper::button(array("colspan"=>8,"name"=>"btnFilter","label"=>"Filter","type"=>"submit","class"=>"btn btn-primary formButton "))!!} 
    </div>
    {!! Helper::close("form")!!}
    {!! Helper::closePage() !!}
</section>
@endsection
@section('myscript')
<script>

</script>
@endsection

 