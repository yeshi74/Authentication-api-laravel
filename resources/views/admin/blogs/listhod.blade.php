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
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped dataex-html5-selectors">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Submitted by</th>
                                <th>Category</th>
                                <th>Approvals</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            foreach($results as $row):
                                $alink='';
                                $_id=$row['id'];
                                $subject=str_limit($row['subject'],200);
                                $url = "<a href='".url('admin/blogs/view/'.$row['id'])."'>".$subject."</a>";
                            ?>
                            <tr>
                                <td>{!! $url!!}</td>
                                <td>{!! $row['authorname'] !!}</td>
                                <td>{!! $row['categoryname'] !!}</td>
                                <td>
                                    <ul>
                                        @foreach($row['lstApprovals'] as $arow)
                                            <li>
                                                <div class="badge badge-primary">{{$arow['statusName']}}</div>&nbsp;
                                                {{$arow['assignName']}} on {{$arow['assign_date']}}.
                                                @if($arow['status'] == 20)
                                                    {{$arow['statusName']}} on {{$arow['approved_date'] }}
                                                    @endif
                                            </li>
                                        @endforeach
                                    </ul>
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
    {!!Helper::close("form")!!}
    {!! Helper::closePage()!!}
@endsection

