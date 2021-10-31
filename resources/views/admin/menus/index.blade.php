@extends('layouts/contentLayoutMaster')
@section('title', 'Menus')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
{!! Helper::form(array("name"=>"frm","action"=>"admin/menus/add"))!!}
{!! Helper::hidden(array("name"=>"action","value"=>"view"))!!}
{!! Helper::hidden(array("name"=>"id","value"=>""))!!}
{!!Helper::close("form")!!}
<section id="column-selectors">
    {!! Helper::responsiveTable(array("Ord","Name","Icon","Route","Status","Action"))!!}
    @foreach($results as $row)
        <?php
            $status = $row['status'] == 0 ? "Active" : "Suspend";
        ?>
        <tr>
            <td>{{$row->ord}}</td>
            <td>{{$row->name}}</td>
            <td>{{$row->icon}}</td>
            <td>{{$row->route}}</td>
            <td>{{$status}}</td>
            <td>
                <a href="{{url('/admin/menus/edit/'.$row->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>&nbsp;
                <a href="Javascript:void(0)" class="lnkDelete" title="Delete" data-id="{{$row->id}}"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
    @endforeach
    {!! Helper::closeResponsiveTable()!!}
</section>
{!! Helper::closePage()!!}
@endsection
@section('myscript')
    <script>
        $("#btnAdd").on('click',function(){
            $("#action").val("add");
            $('#frm').attr('action', "{{url('admin/menus/add')}}").submit();
        });
        $(".lnkEdit").on('click',function(){
            $('#id').val($(this).data("id"));
            $("#action").val("edit");
            $('#frm').attr('action', "{{url('admin/menus/edit')}}").submit();
        });
        $(".lnkDelete").on('click',function(){
            $("#id").val($(this).data("id"));
            $("#action").val("delete");
            if(confirm("Are you sure you want to perform this action?"))
            {
                $('#frm').attr('action', "{{url('admin/menus/delete')}}").submit();
            }
        });
    </script>
@endsection
