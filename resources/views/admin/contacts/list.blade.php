@extends('layouts/contentLayoutMaster')
@section('title', 'Contacts')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    {!!Helper::form(array("name"=>"frm","action"=>"admin/contacts/view"))!!}
    {!!Helper::hidden(array("name"=>"action","value"=>"view"))!!}
    {!!Helper::hidden(array("name"=>"id","value"=>""))!!}
    {!! Helper::linkButton(array("colspan"=>12,"url"=>url('admin/contacts/add'),"label"=>"Add New Contact","class"=>"btn-primary")) !!}
 <div class="row">
    <div class="col-12">
        <div class="table-responsive">
            <table class="table table-striped dataex-html5-selectors">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Designation</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($results as $row):
                        $alink='';
                        $status=($row['status'] == 0 ? "Active" : "Suspend");
                        $_id=$row['id'];
                        $cname=str_limit($row['contactname'],30);
                        $url = "<a href='".url('admin/contacts/view/'.$row['id'])."'>".$row['name']."</a>";
                     ?>
                    <tr>
                        <td>{!! $url !!}</td>
                        <td>{!! $row['email'] !!}</td>
                        <td>{!! $row['mobile'] !!}</td>
                        <td>{!! $row['designation'] !!}</td>
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
