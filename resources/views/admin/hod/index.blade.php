@extends('layouts/contentLayoutMaster')
@section('title','HOD')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    {!! Helper::form(array("name"=>"frm","action"=>"admin/hod/view"))!!}
    {!! Helper::hidden(array("name"=>"action","value"=>"view"))!!}
    {!! Helper::hidden(array("name"=>"id","value"=>""))!!}
    <section id="column-selectors">
        <div class="row">
            <div class="col-md-12">
                {!! Helper::linkButton(array("url"=>url('admin/hod/add'),"label"=>"Add HOD","class"=>"btn-primary")) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped dataex-html5-selectors">
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Title</th>
                                <th>Location</th>
                                <th>Department</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php
                                foreach($results as $row):
                                $id = $row['id'];
                                $status = $row['status'] == 0 ? "Active" : "Suspend";
                            ?>
                            <tr>
                                <td>{!! $row['username'] !!}</td>
                                <td>{!! $row['title'] !!}</td>
                                <td>{!! $row['locname'] !!}</td>
                                <td>{!! $row['deptname'] !!}</td>
                                <td>{!! $status !!}</td>
                                <td>
                                    <a href="{{url('/admin/hod/edit/'.$id)}}" class="lnkEdit"><i class="fa fa-pencil"></i></a>
                                </td>
                            </tr>
                            <?php
                                endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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

