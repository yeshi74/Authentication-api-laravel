@extends('layouts/contentLayoutMaster')
@section('title','Learning')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    {!! Helper::form(array("name"=>"frm","action"=>"admin/blogs/view"))!!}
    {!! Helper::hidden(array("name"=>"action","value"=>"view"))!!}
    {!! Helper::hidden(array("name"=>"id","value"=>""))!!}
    <section id="column-selectors">
        <div class="row">
            <div class="col-md-12">
                {!! Helper::linkButton(array("url"=>url('admin/blogs/add'),"label"=>"Add New Learning","class"=>"btn-primary")) !!}
                @if($data['new'] != 0)
                    {!! Helper::linkButton(array("url"=>url('admin/blogs/for-approval'),"label"=>$data['new']." Learnings for Approval","class"=>"btn-primary")) !!}
                @endif
                @if($data['hod'] != 0)
                    {!! Helper::linkButton(array("url"=>url('admin/blogs/for-hod-approval'),"label"=>$data['hod']." Learnings for HOD Approval","class"=>"btn-primary")) !!}
                @endif
                 @if($data['publish'] != 0)
                    {!! Helper::linkButton(array("url"=>url('admin/blogs/for-publish'),"label"=>$data['publish']." Learnings for Publishing","class"=>"btn-warning")) !!}
                @endif
            </div>
        </div>
        {!! Helper::responsiveTableEx(array("Date","Subject","Submitted By","Category","Status"))!!}
        <?php
            foreach($results as $row):
                $alink='';
                $_id=$row['id'];
                $subject=str_limit($row['subject'],200);
                $url = "<a href='".url('admin/blogs/view/'.$row['id'])."'>".$subject."</a>";
            ?>
            <tr>
                <td data-sort="{{ strtotime($row['created_at'])}}">{{ $row['cdate'] }}</td>
                <td>{!! $url!!}</td>
                <td>{!! $row['authorname'] !!}</td>
                <td>{!! $row['categoryname'] !!}</td>
                <td>{!! $row['statusname']  !!}</td>
            </tr>
            <?php
                endforeach;
            ?>
            {!! Helper::closeResponsiveTable()!!}
    </section>
    {!!Helper::close("form")!!}
    {!! Helper::closePage()!!}
@endsection

