@extends('layouts/contentLayoutMaster')
@section('title', 'Pincodes')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
  {!! Helper::form(array("name"=>"frm","action"=>"admin/faq/view")) !!}
  {!! Helper::hidden(array("name"=>"action","value"=>"view"))!!}
  <a class="btn btn-primary" href="{{ route('pincode.add') }}" role="button">Add</a>
  <!-- <a class="btn btn-success" href="{{ route('vaccinationDosage.index') }}" role="button">Dosage</a> -->

  
  {!! Helper::responsiveTableEx(array("Pincode","Location", "Action"))!!}
  <?php
    foreach($vaccinations as $row):
   
      ?>
      <tr>
        <td>
          <a href="#">{{ $row->pincode }}</a>
        </td>
        <td>{{ $row->place }}</td>
        <td>
        <a class="btn btn-success" href="{{ route('pincode.edit', $row->id) }}" role="button">Edit</a>
        <a class="btn" onclick="return confirm('Are you sure, you want to delete?')" role="button">
		<form action="{{ route('pincode.destroy', $row->id) }}" method="post">
            <input class="btn btn-danger" style="padding:6px;" type="submit" value="Delete" />
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