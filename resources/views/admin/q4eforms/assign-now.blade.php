<?php
    use App\Helpers\ApolloHelpers;
?>
@extends('layouts/contentLayoutMaster')
@section('title', 'Q4e Forms')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    {!!Helper::form(array("name"=>"frm","action"=>"admin/q4eforms/".$ftype."/assign-now/update","validate"=>"Yes"))!!}
    {!!Helper::hidden(array("name"=>"id","value"=>$id))!!}
    {!!Helper::hidden(array("name"=>"ftype","value"=>$ftype))!!}
    <div class="row">
        {!!Helper::button(array("name"=>"btnUpdate","label"=>"Assign to Users","type"=>"submit"))!!}
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br/>
    @endif
    <section id="column-selectors">
        
        <div class="row">
            {!! Helper::display(array("colspan"=>6,"label"=>"Name","value"=>$results['formname'])) !!}
            {!! Helper::display(array("colspan"=>6,"label"=>"Type","value"=>$results['typname'])) !!}
            
        </div>
        <div class="row">
            {!! Helper::textbox(array("name"=>"assign_date","placeholder"=>"Date to Assign","colspan"=>4,"label"=>"Assign Date","typ"=>"DATE")) !!}
            {!! Helper::textbox(array("name"=>"days_submit","placeholder"=>"Enter Days to Submit","colspan"=>2,"label"=>"Days to Submit","typ"=>"NUMBER","value"=>$results['days_submit'])) !!}
            {!! Helper::selectList(array("name"=>"period","colspan"=>4,"label"=>"Select Period","options"=>$lstPeriods,"key"=>"id","val"=>"name"))!!}
        </div>
        <div class="row">
            <div class="col-12">
                <button type="button" class="btn btn-primary" id="btnSelectAll">Select All</button>
                <button type="button" class="btn btn-primary" id="btnUnSelectAll">Unselect All</button>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Center</th>
                            <th>User</th>
                            <th>Assign</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lstUsers as $row)
                            <tr>
                                <td>{{$row['centername']}}</td>
                                <td>{{$row['username']}}</td>
                                <td><input type="checkbox" class="chkAssign" value="1" name="s{{$row['id']}}"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- <strong>Locations/Roles</strong> -->
        <?php #echo ApolloHelpers::locationTree(array("name"=>"locations","mode"=>"EDIT","selLocations"=>$lstLocations,"selRoles"=>$lstRoles)); ?>
    </section>
    {!!Helper::close("form")!!}
    {!! Helper::closePage()!!}
@endsection
@section('myscript')
    <script>
        $("#btnSelectAll").on('click',function(){
            $(".chkAssign").attr('checked',true);
        });
        $("#btnUnSelectAll").on('click',function(){
            $(".chkAssign").attr('checked',false);
        });
    </script>
@endsection
