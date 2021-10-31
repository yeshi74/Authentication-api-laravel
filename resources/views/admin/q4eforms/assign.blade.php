@extends('layouts/contentLayoutMaster')
@section('title', 'Q4E Forms')
@section('content')
    {!!Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
     {!!Helper::form(array("name"=>"frm","action"=>"admin/q4eforms/".$ftype."/update-assign","validate"=>"Yes"))!!}
    {!!Helper::hidden(array("name"=>"id","value"=>$id))!!}
    {!!Helper::hidden(array("name"=>"ftype","value"=>$ftype))!!}
    <section id="column-selectors">
        <h4>{{$results->name}}</h4>
        <div class="row">
            <div class="col-md-12">
                <button type="submit" name="btnSubmit" class="btn btn-primary">Update</button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Center</th>
                            <th>User</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($lstResults as $row):
                        ?>
                            <tr>
                                <td>{{$row['center_name']}}</td>
                                <td>
                                    <select name="s{{$row['center_id']}}" class="form-control">
                                        <option value="0"></option>
                                        <?php foreach($row['list_users'] as $r){
                                                $sel = $r['id'] == $row['defuser'] ? "selected" : ""; ?>
                                                <option <?php echo $sel ?> value="<?php echo $r['id'] ?>"><?php echo $r['name'] ?></option> 
                                        <?php } ?>
                                    </select>
                                </td>
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
    {!! Helper::close("form")!!}
    {!! Helper::closePage()!!}
@endsection
