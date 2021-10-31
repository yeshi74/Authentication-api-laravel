@extends('layouts/contentLayoutMaster')
@section('title', 'Admin Users')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
  {!! Helper::form(array("name"=>"frm","action"=>"admin/adminusers/refreshall")) !!}
  <div class="row">
    <div class="col-md-12">
      {!! Helper::button(array("label"=>"Refresh All Users","type"=>"button","name"=>"btnRefreshAll")) !!}
      {!! Helper::button(array("label"=>"List HOD","type"=>"button","name"=>"btnHOD")) !!}
    </div>
  </div>
  {!! Helper::close("form")!!}
   {{--{!! Helper::button(array("colspan"=>12,"name"=>"btnAdd","label"=>"Add New User","class"=>"btn-primary btnAdd")) !!} --}}
  {{-- {!! Helper::linkButton(array("colspan"=>12,"url"=>url('admin/adminusers/addnew'),"label"=>"Add New User","class"=>"btn-primary btnAdd")) !!} --}}
  <div class="row">
    <div class="col-md-12">
      <div class="table responsive">
        <table class="table table-striped dataex-html5-selectors">
          <thead>
            <tr>
              <th>Name</th>
              <th>Emp. Code</th>
              <th>E-Mail</th>
              <th>Location</th>
              <th>Last Logged</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach($lstUsers as $row):
              $isadmin = ($row['is_admin'] == 0 ? "Normal" : "Admin");
              
              //   $url = "<a href='".url('admin/adminuses/view/'.$row['id'])."'>".$row['name']."</a>";
            ?>
            <tr>
            <td>
              <a href="{{url('admin/adminusers/view/'.$row['id'])}}">{{$row->name}}</a>
              <?php 
              if($row['is_admin']==1){
                ?><i class="fa fa-user"></i>&nbsp;<?php
              }
              ?></td>
              <td>{!!$row['emp_code']!!}</td>
              <td>{{$row['email']}}</td>
              <td>{{$row['locname']}}</td>
              <td>{{$row['lastLogged']}}</td>
              <td>{{$row['statusname']}}</td>
            </tr>
            <?php
              endforeach;
            ?>
          </tbody>
        </table>
      </div>
    </div>
</div>
  
  {!! Helper::closePage() !!}
  {!! Helper::form(array("name"=>"frmHOD","action"=>"admin/adminusers/hod")) !!}
  {!! Helper::close("form")!!}
@endsection
  
@section('myscript')
<script>
    $("#btnRefreshAll").on('click',function(){
      if(confirm("Are you sure you want to refresh all users from API?")){
        $("#frm").submit();
      }
  });
 $("#btnHOD").on('click',function(){
        $("#frmHOD").submit();
      
  });
</script>
@endsection 
