@extends('layouts/contentLayoutMaster')
@section('title', 'Vaccination')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
  {!! Helper::form(array("name"=>"frm","action"=>"admin/faq/view")) !!}
  {!! Helper::hidden(array("name"=>"action","value"=>"view"))!!}
  {!! Helper::hidden(array("name"=>"id","value"=>""))!!}
  <a class="btn btn-primary" href="{{ route('review.add')}}" role="button">Add</a>
  
  {!! Helper::responsiveTableEx(array("Subject", "Message", "Action"))!!}
  <?php
    foreach($reviews as $row):
      ?>
      <tr>
        <td>{{ $row->subject }}</td>
        <td>{{ $row->message }}</td>
        <td>
            <a class="btn btn-info" href="#" role="button">Edit</a>
        </td>
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