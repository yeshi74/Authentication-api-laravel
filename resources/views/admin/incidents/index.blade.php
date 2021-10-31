@extends('layouts/contentLayoutMaster')
@section('title', 'Incidents')
@section('content')

    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
   
    <div class="d-flex justify-content-start flex-wrap">
      <div class="text-center bg-primary colors-container rounded text-white width-100 height-100 d-flex align-items-center justify-content-center mr-1 ml-50 my-1 shadow">
        <span class="align-middle">
          @if($data['new'] != 0)
            <a style="color:white;" href="{{url('admin/incidents/filter/new')}}"><strong>{{$data['new']}}</strong><br>New</a>
          @else
            <strong>{{$data['new']}}</strong><br>New
          @endif
        </span>
      </div>
      <div class="text-center bg-info colors-container rounded text-white width-100 height-100 d-flex align-items-center justify-content-center mr-1 ml-50 my-1 shadow">
        <span class="align-middle">
          @if($data['assign'] != 0)
            <a style="color:white;" href="{{url('admin/incidents/filter/assign')}}"><strong>{{$data['assign']}}</strong><br>Assign</a>
          @else
            <strong>{{$data['assign']}}</strong><br>Assign
          @endif
        </span>
      </div>
      <div class="text-center bg-success colors-container rounded text-white width-100 height-100 d-flex align-items-center justify-content-center mr-1 ml-50  my-1 shadow">
        <span class="align-middle">
          @if($data['inprogress'] != 0)
            <a style="color:white;" href="{{url('admin/incidents/filter/inprogress')}}"><strong>{{$data['inprogress']}}</strong><br>In Progress</a>
          @else
            <strong>{{$data['inprogress']}}</strong><br>In Progress
          @endif
        </span>
      </div>
      <div class="text-center bg-danger colors-container rounded text-white width-100 height-100 d-flex align-items-center justify-content-center mr-1 ml-50  my-1 shadow">
        <span class="align-middle">
          @if($data['completed'] != 0)
            <a style="color:white;" href="{{url('admin/incidents/filter/completed')}}"><strong>{{$data['completed']}}</strong><br>Completed</a>
          @else
            <strong>{{$data['completed']}}</strong><br>Completed
          @endif
        </span>
      </div>
      <div class="text-center bg-warning colors-container rounded text-white width-100 height-100 d-flex align-items-center justify-content-center mr-1 ml-50  my-1 shadow">
        <span class="align-middle">
          @if($data['declined'] != 0)
            <a style="color:white;" href="{{url('admin/incidents/filter/aborted')}}"><strong>{{$data['declined']}}</strong><br>Declined</a>
          @else
            <strong>{{$data['declined']}}</strong><br>Declined
          @endif
        </span>
      </div>
  </div>
 @include('admin/incidents/search')
 {!! Helper::responsiveTableEx(array("Reported On","Incident Date","Employee ID","Party Name","Category","Grade","Location","Status","HOD Status"))!!}
   
  <?php
    foreach($results as $row):
    $url = "<a href='".url('admin/incidents/view/'.$row['id'])."'>".$row['uhid']."</a>";
    $style="";
    if($row['grade'] == "Grade 1") $style="#c80000";
    if($row['grade'] == "Grade 2") $style="#ff9f43";
    if($row['grade'] == "Grade 1") $style="#7367f0";
  ?>
  <tr  style="color:{{$style}};">
    <td data-sort="{{ strtotime($row['created_at'])}}">
      <a href="{{url('admin/incidents/view/'.$row['id'])}}">{{ $row['created'] }}</a></td>
      <td>{{$row['incident_date']}}</td>
    <td>{{$row['uhid']}}</td>
    <td>{!! $row['party_name'] !!}</td>
    <td>{!! $row['category'] !!}</td>
    <td>{!! $row['grade'] !!}</td>
    <td>{!! $row['locname'] !!}</td>
    <td>{!! $row['statusname'] !!}</td>
    <td>{{ $row['hod']}}</td>
  </tr>
  <?php
    endforeach;
  ?>
{!! Helper::closeResponsiveTable()!!}
{!! Helper::closePage() !!}
@endsection
@section('myscript')
<script>
    $("#btnExport").on('click',function(){
      $("#report_from_date").val($("#search_from_date").val());
      $("#report_to_date").val($("#search_to_date").val());
      $("#report_category").val($("#search_category").val());
      $("#report_grade").val($("#search_grade").val());
      $("#report_status").val($("#search_status").val());
      $("#frmReport").submit();
    });
</script>
@endsection