@extends('layouts/contentLayoutMaster')
@section('title', 'Q4e Forms')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    <section id="column-selectors">
        <div class="d-flex justify-content-start flex-wrap">
            @foreach($output as $row)
                <div class="text-center bg-primary colors-container rounded text-white col-md-3 height-100 d-flex align-items-center justify-content-center mr-1 ml-50 my-1 shadow">
                    <span class="align-middle">
                        <a style="color:white;" href="{{url('admin/q4eforms/list/'.$row['code'])}}"><strong>{{$row['name']}}</strong></a>
                        <br>{{$row['cnt']}} Forms
                    </span>
                </div>
            @endforeach
        </div>
    </section>
    {!! Helper::closePage()!!}
@endsection
@section('myscript')
    </script>
@endsection
