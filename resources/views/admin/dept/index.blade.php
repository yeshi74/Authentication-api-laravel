@extends('layouts/contentLayoutMaster')
@section('title','Departments')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    <section id="column-selectors">
        <div class="row">
            <div class="col-md-12">
                {!! Helper::linkButton(array("url"=>url('admin/dept/add'),"label"=>"Add Department","class"=>"btn-primary")) !!}
            </div>
        </div>
        {!! Helper::responsiveTable(array("Name","Parent","Status","Action"))!!}
        @foreach($results as $row)
            <tr>
                <td>{!! $row['name'] !!}</td>
                <td>{!! $row['parentName'] !!}</td>
                <td>{!! $row['status'] !!}</td>
                <td>
                    <a href="{{url('/admin/dept/edit/'.$row['id'])}}" class="lnkEdit"><i class="fa fa-pencil"></i></a>
                </td>
            </tr>
        @endforeach
        {!!Helper::closeResponsiveTable()!!}
    </section>
    {!! Helper::close("form")!!}
    {!! Helper::closePage()!!}
@endsection

@section("myscript")
<script>
    $(".lnkEdit").on('click',function(){
        $('#id').val($(this).data("id"));
        $("#action").val("edit");
    $('#frm').attr('action', "{{url('admin/hod/edit')}}").submit();
    });
</script>
@endsection

