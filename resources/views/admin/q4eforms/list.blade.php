@extends('layouts/contentLayoutMaster')
@section('title', 'Q4e Forms')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    <section id="column-selectors">
        <div class="row">
            <div class="col-md-12">
                {!!Helper::linkButton(array("url"=>url('admin/q4eforms/'.$ftype.'/add/'.$lstTypes->code),"name"=>"btnAdd","label"=>"Add  New ".$lstTypes->name,"class"=>"btn-primary btnAdd"))!!}
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped dataex-html5-selectors">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Frequency</th>
                                <th>In Progress</th>
                                <th>Completed</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($output as $row):
                                    $alink='';
                                    $status=($row['status'] == 0 ? "Active" : "Suspend");
                                    $_id=$row['id'];
                            ?>
                                    <tr>
                                        <td><a href="{{url('/admin/q4eforms/'.$ftype.'/view/'.$row->id)}}">{{$row['name']}}</a></td>
                                        <td>{{$row['formname']}}</td>
                                        <td>{!! $status !!}</td>
                                        <td>{{$row['frequency']}}</td>
                                        <td>{{$row['inprogress']}}</td>
                                        <td>{{$row['completed']}}</td>
                                    </tr>
                            <?php
                                endforeach
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    {!! Helper::closePage()!!}
@endsection
@section('myscript')
@endsection
