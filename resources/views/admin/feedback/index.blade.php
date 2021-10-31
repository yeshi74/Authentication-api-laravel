@extends('layouts/contentLayoutMaster')
@section('title', 'Feedbacks')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
  {!! Helper::form(array("name"=>"frm","action"=>"admin/faq/view")) !!}
  {!! Helper::hidden(array("name"=>"action","value"=>"view"))!!}
  {!! Helper::hidden(array("name"=>"id","value"=>""))!!}
  <div class="row">
    <div class="col-md-12">
      @if($data['new'] != 0) 
        {!! Helper::linkButton(array("url"=>url('admin/feedback/list/new'),"label"=>$data['new']. " New Feedbacks","class"=>"btn-primary")) !!} 
      @endif
      @if($data['replied'] != 0) 
        {!! Helper::linkButton(array("url"=>url('admin/feedback/list/replied'),"label"=>$data['replied']. " Replied Feedbacks","class"=>"btn-danger")) !!} 
      @endif
    </div>
  </div>
  {!! Helper::responsiveTableEx(array("Submitted On","Submitted By","Message","Replied On","Replied By","Status"))!!}
  <?php
    foreach($results as $row):
      $_id = $row['id'];
      $status = "";
      if($row['status'] == 0) $status= "New";
      if($row['status'] == 10) $status= "Replied";
      if($row['status']==20) $status = "Closed";
      $message=str_limit(strip_tags($row['message']),200);
      $url = "<a href='".url('admin/feedback/view/'.$row['id'])."'>".$message."</a>";
      ?>
      <tr>
        <td data-sort="{{ strtotime($row['created_at'])}}">{{ date('d/m/Y',strtotime($row['created_at'])) }}</td>
        <td>{!! $row['authorname'] !!}</td>
        <td>{!! $url !!}</td>
        @if($row['status'] != 0)
          <td data-sort="{{ strtotime($row['replied_on'])}}">{{ date('d/m/Y',strtotime($row['replied_on'])) }}</td>
          <td>{!! $row['repliedby'] !!}</td>
        @else
          <td></td>
          <td></td>
        @endif
        <td>{!! $status !!}</td>
      </tr>
      <?php
        endforeach;
      ?>
  {!! Helper::closeResponsiveTable()!!}
  {!! Helper::close("form")!!}
  {!! Helper::closePage() !!} 
@endsection

{{-- @section('myscript')
<script>
  $(".lnkView").on('click',function(){
    $("#id").val($(this).data("id"));
    $("#action").val("view");
    $('#frm').attr('action', "{{url('admin/feedback/view')}}").submit();
  });
</script>
@endsection --}}
