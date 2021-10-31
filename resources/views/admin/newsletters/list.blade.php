@extends('layouts/contentLayoutMaster')
@section('title', 'Communications')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    {!! Helper::form(array("name"=>"frm","action"=>"admin/newsletters/view"))!!}
    {!! Helper::hidden(array("name"=>"action","value"=>"view"))!!}
    {!! Helper::hidden(array("name"=>"id","value"=>""))!!}
    {!! Helper::linkButton(array("colspan"=>12,"url"=>url('admin/newsletters/add'),"label"=>"Add  New  Communication","class"=>"btn-primary btnAdd")) !!}
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped dataex-html5-selectors">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Period</th>
                            <th>Type</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($results as $row):
                            $alink='';
                            $status=($row['status'] == 0 ? "Active" : "Suspend");
                            $_id=$row['id'];
                            $subject=str_limit($row['subject'],100);
                           // $url = "<a href='Javascript:void(0)' class='lnkView' data-id='".$row['id']."'>".$subject."</a>";
                            $url = "<a href='".url('admin/newsletters/view/'.$row['id'])."'>".$row['subject']."</a>";
                        ?>
                        <tr>
                            <td>{!! $url!!}</td>
                            <td>{!! date('d/m/Y',strtotime($row['period'])) !!}</td>
                            <td>{{$row['typ']}}</td>
                            <td>{!! $status !!}</td>
                        </tr>
                        <?php
                            endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        {!!Helper::close("form")!!}
        {!! Helper::closePage()!!}
@endsection
