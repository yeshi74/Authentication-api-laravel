@extends('layouts/contentLayoutMaster')
@section('title','Q4e Answer Type')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    {!! Helper::form(array("name"=>"frm","action"=>"admin/hod/view"))!!}
    {!! Helper::hidden(array("name"=>"action","value"=>"view"))!!}
    {!! Helper::hidden(array("name"=>"id","value"=>""))!!}
    <section id="column-selectors">
        <div class="row">
            <div class="col-md-12">
                {!! Helper::linkButton(array("url"=>url('admin/q4eanswertype/add'),"label"=>"Add Q4e Answer Type","class"=>"btn-primary")) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped dataex-html5-selectors">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Options</th>
                                <th>Code</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php
                                foreach($results as $row):
                                $id = $row['id'];
                            ?>
                            <tr>
                                <td>{!! $row['name'] !!}</td>
                                <td>{!! $row['options'] !!}</td>
                                <td>{!! $row['code'] !!}</td>
                                <td>
                                    <a href="{{url('/admin/q4eanswertype/edit/'.$id)}}" class="lnkEdit"><i class="fa fa-pencil"></i></a>
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
    $('#frm').attr('action', "{{url('admin/q4eanswertype/edit')}}").submit();
    });
</script>
@endsection

