@extends('layouts/contentLayoutMaster')
@section('title', 'Vaccination')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
  {!! Helper::form(array("name"=>"frm","action"=>"admin/faq/view")) !!}
  {!! Helper::hidden(array("name"=>"action","value"=>"view"))!!}
  {!! Helper::hidden(array("name"=>"id","value"=>""))!!}
  <a class="btn btn-primary" href="{{ route('vaccinationDosage.create')}}" role="button">Add</a>
  
  {!! Helper::responsiveTableEx(array("Vaccine ID", "Dosage number", "Days after", "Action"))!!}
  <?php
    foreach($vaccinations as $row):
      ?>
      <tr>
        <td>{{ $row->vaccine_id }}</td>
        <td>{{ $row->dosage_num }}</td>
        <td>{{ $row->days_after }}</td>
        <td>
        <a class="btn btn-success btn-sm" href="{{ route('vaccinationDosage.edit', $row->id) }}" role="button"><b>Edit</b></a>
        
        <a class="btn" onclick="return confirm('Are you sure, you want to delete?')" style="margin-left: -13px;" role="button">
		<form action="{{ route('vaccinationDosage.destroy', $row->id) }}" method="post">
            <input class="btn btn-danger btn-sm" style="padding:6px;" type="submit" value="Delete" />
                {!! method_field('delete') !!}
                {!! csrf_field() !!}
		</form>
	    </a>
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