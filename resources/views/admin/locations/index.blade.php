@extends('layouts/contentLayoutMaster')
@section('title', 'Locations')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>"Locations")) !!}
    <div class="row">
        <div class="col-md-12">
            {!! Helper::linkButton(array("url"=>url('admin/locations/refresh'),"label"=>"Refresh","class"=>"btn-warning")) !!} 
        </div>
    </div>
    <div class="row">
        @foreach($lstBU as $row)
            <div class="col-md-3 btn btn-primary" style="margin-right:3px;margin-bottom:3px;">
                <a href="{{url('admin/locations/region/'.$row['id'])}}"><h4>{{$row['name']}}</h4></a>
                {{$row['count']}} Centers
            </div>
        @endforeach
    </div>
    {!! Helper::closePage() !!}
</section>
@endsection
@section('myscript')
<script>

</script>
@endsection

 