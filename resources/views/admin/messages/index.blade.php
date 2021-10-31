@extends('layouts/contentLayoutMaster')
@section('title', 'Messages')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
 <div class="row">
    <div class="col-12">
        <div class="table-responsive">
            <table class="table table-striped dataex-html5-selectors">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Caption</th>
                        <th>Message</th>
                        <th>Icon</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($results as $row):
                        $url = "<a href='".url('admin/messages/edit/'.$row['id'])."'>".$row['code']."</a>";
                     ?>
                    <tr>
                        <td>{!! $url !!}</td>
                        <td>{!! $row['caption'] !!}</td>
                        <td>{!! $row['message'] !!}</td>
                        <td>{!! $row['icon'] !!}</td>
                    </tr>
                    <?php
                        endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    {!! Helper::closePage()!!}
@endsection
