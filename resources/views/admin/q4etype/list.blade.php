@extends('layouts/contentLayoutMaster')
@section('title', 'Q4e Type')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
        {!!Helper::form(array("name"=>"frm","action"=>"admin/q4etype/add"))!!}
        {!!Helper::hidden(array("name"=>"action","value"=>"view"))!!}
        {!!Helper::hidden(array("name"=>"id","value"=>""))!!}
            <section id="column-selectors">
                <div class="row">
                    <div class="col-md-12">
                        {!!Helper::linkButton(array("url"=>url('admin/q4etype/add'),"name"=>"btnAdd","label"=>"Add  Q4e Type","class"=>"btn-primary btnAdd"))!!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-striped dataex-html5-selectors">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($results as $row)
                                        <?php
                                            
                                            $alink='';
                                            $_id=$row['id'];
                                        ?>
                                    <tr>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->code}}</td>
                                        <td>{{$row->typ}}</td>
                                        <td>
                                            <a href="{{url('/admin/q4etype/edit/'.$row->id)}}"><i class="fa fa-pencil"></i></a>&nbsp;
                                            <a href="Javascript:void(0)" class="lnkDelete" data-id="{{$row->id}}"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        {!!Helper::close("form")!!}
    {!! Helper::closePage()!!}
@endsection
@section('myscript')
    <script>
        $("#btnAdd").on('click',function(){
            $("#action").val("add");
            $('#frm').attr('action', "{{url('admin/q4etype/add')}}").submit();
        });
        $(".lnkEdit").on('click',function(){
            $('#id').val($(this).data("id"));
            $("#action").val("edit");
        $('#frm').attr('action', "{{url('admin/q4etype/edit')}}").submit();
        });
        $(".lnkDelete").on('click',function(){
            $("#id").val($(this).data("id"));
            $("#action").val("delete");
            if(confirm("Are you sure you want to perform this action?"))
            {
                $('#frm').attr('action', "{{url('admin/q4etype/delete')}}").submit();
            }
        });
    </script>
@endsection
