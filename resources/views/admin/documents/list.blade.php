@extends('layouts/contentLayoutMaster')
@section('title', 'Documents')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    {!! Helper::form(array("name"=>"frm","action"=>"admin/documents/view"))!!}
    {!! Helper::hidden(array("name"=>"action","value"=>"view"))!!}
    {!! Helper::hidden(array("name"=>"id","value"=>""))!!}
    {!! Helper::linkButton(array("colspan"=>12,"url"=>url('admin/documents/add'),"label"=>"Add New Document","class"=>"btn-primary btnAdd")) !!}
     <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped dataex-html5-selectors">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($results as $row):
                            $alink='';
                            $_id=$row['id'];
                            $_status = ($row['status'] == 0 ? "Active" : "Suspend");
                            $subject=str_limit($row['subject']);
                            $url = "<a href='Javascript:void(0)' class='lnkView' data-id='".$row['id']."'>".$subject."</a>";
                            $url = "<a href='".url('admin/documents/view/'.$row['id'])."'>".$row['subject']."</a>";                        
                        ?>
                        <tr>
                            <td>{!! $url !!}</td>
                            <td>{!! $row['categoryName'] !!}</td>
                            <td>{!! $row['authorname'] !!}</td>
                            <td>{!! date('d/m/Y',strtotime($row['doc_date'])) !!}</td>
                            <td>{!! $_status !!}</td>
                        </tr>
                        <?php
                            endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
       </div>
    {!! Helper::close("form")!!}
    {!! Helper::closePage()!!}
@endsection

{{-- @section('myscript')
   <script>
        $("#btnAdd").on('click',function()
        {
            $("#action").val("add");
            location.href = "{{url('admin/documents/add')}}";
            //$('#frm').attr('action', "{{url('admin/documents/add')}}").submit();
        });

        $(".lnkView").on('click',function(){
            $("#id").val($(this).data("id"));
            $("#action").val("view");
            $('#frm').attr('action', "{{url('admin/documents/view')}}").submit();
        });
    </script>
@endsection --}}
