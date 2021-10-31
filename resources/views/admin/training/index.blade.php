@extends('layouts/contentLayoutMaster')
@section('title', 'Training')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
  {!! Helper::form(array("name"=>"frm","action"=>"admin/training/filter")) !!}
  {!! Helper::hidden(array("name"=>"action","value"=>"view"))!!}
  {!! Helper::hidden(array("name"=>"id","value"=>""))!!}
  {!! Helper::linkButton(array("colspan"=>12,"url"=>url('admin/training/add'),"label"=>"Add Training","class"=>"btn-primary btnAdd")) !!} 
  <div class="row">
    {!!Helper::textbox(array("colspan"=>4,"label"=>"From Date","name"=>"fdate","value"=>$data['fdate'],"typ"=>"DATE"))!!}
    {!!Helper::textbox(array("colspan"=>4,"label"=>"To Date","name"=>"tdate","value"=>$data['tdate'],"typ"=>"DATE"))!!}
    {!!Helper::button(array("colspan"=>4,"label"=>"Filter","type"=>"submit","class"=>"btn btn-danger formButton"))!!}
  </div>
  {!! Helper::responsiveTableEx(array("Start Date","Subject","Category","Status","Published","Users",""))!!}
  <?php
    foreach($results as $row):
    $_status = ($row['status'] == 0 ? "Active" : "Suspend");
    $_id = $row['id'];
    $subject=str_limit($row['subject'],100);
    $url = "<a href='".url('admin/training/view/'.$row['id'])."'>".$row['subject']."</a>";
    $publish = $row['publish'] == 1 ? "Yes" : "No";
  ?>
  <tr>
    <td data-sort="{{ strtotime($row['training_date'])}}">{!! date('d/m/Y H:i',strtotime($row['training_date'])) !!}</td>
    <td>{!! $url !!}</td>
    <td>{!! $row['categoryname'] !!}</td>
    <td>{!! $_status !!}</td>
    <td>{{$publish}}</td>
    <td>{{$row['users']}}</td>
    <td><a href="{{url('admin/training/report/view/'.$row['id'])}}" target="_new"><i class="fa fa-file-excel-o"></i></a></td>
  </tr>
  <?php
    endforeach;
  ?>
  {!! Helper::closeResponsiveTable()!!}
  {!! Helper::close("form")!!}
  {!! Helper::closePage() !!}
@endsection

