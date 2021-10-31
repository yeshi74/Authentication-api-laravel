@extends('layouts/contentLayoutMaster')
@section('title', 'Events')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
    {!! Helper::form(array("name"=>"frm","action"=>"admin/events/view")) !!}
    {!! Helper::hidden(array("name"=>"action","value"=>"view"))!!}
    {!! Helper::hidden(array("name"=>"id","value"=>""))!!}
    {!! Helper::linkButton(array("colspan"=>12,"url"=>url('admin/events/add'),"label"=>"Add New Event","class"=>"btn-primary btnAdd")) !!}

  <div class="row">
      <div class="col-md-12">
          <div class="table responsive">
              <table class="table table-striped dataex-html5-selectors">
                <thead>
                  <tr>
                    <th>Event Name</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>Location</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    foreach($results as $row):
                    $_status = ($row['status'] == 0 ? "Active" : "Suspend");
                    //$_id = $row['id'];
                    // $fromdate=date('d/m/Y',strtotime($row['from_date']));
                    // $todate=date('d/m/Y',strtotime($row['to_date']));
                   // $name=str_limit($row['name'],100);
                   // $url = "<a href='Javascript:void(0)' class='lnkView' data-id='".$row['id']."'>".$name."</a>";
                    $url = "<a href='".url('admin/events/view/'.$row['id'])."'>".$row['name']."</a>";
                  ?>
                  <tr>
                    <td>{!! $url !!}</td>
                    <td>{!! $row['categoryname'] !!}</td>
                    <td>{!! $row['authorname'] !!}</td>
                    <td>{!! $row['fromdate'] !!}</td>
                    <td>{!! $row['todate'] !!}</td>
                    <td>{!! $row['locname'] !!}</td>
                    <td>{!! $_status !!}</td>
                  </tr>
                  <?php
                    endforeach;
                  ?>
                </tbody>
           </table>
      </div>
  </div>
    {!! Helper::close("form")!!}
    {!! Helper::closePage() !!}
@endsection
{{-- @section('myscript')
  <script>
    // $(".lnkView").on('click',function(){
    //   $("#id").val($(this).data("id"));
    //   $("#action").val("view");
    //   $('#frm').attr('action', "{{url('admin/events/view')}}").submit();
    // });
  
    // $("#btnAdd").on('click',function(){
    //   $("#action").val("add");
    //   location.href = "{{url('admin/events/add')}}";
    //   // $('#frm').attr('action', "{{url('admin/events/add')}}").submit();
    // });
  </script>
@endsection --}}
