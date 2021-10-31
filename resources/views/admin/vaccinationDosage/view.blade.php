@extends('layouts/contentLayoutMaster')
@section('title', 'Vaccination')
@section('content')

{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>""))!!}
  <!-- {!! Helper::form(array("name"=>"frm","action"=>"admin/vaccination/destroy","validate"=>"Yes"))!!} -->
  {!! Helper::hidden(array("name"=>"action","value"=>"edit")) !!}
  {!! Helper::hidden(array("name"=>"id","value"=>$id))!!}

<div class="row">
    <div class="col-md-12">
	    <a class="btn btn-success" href="{{ route('vaccinationDosage.edit', $vaccinations->id) }}" role="button">Edit</a>
	    <a class="btn" onclick="return confirm('Are you sure, you want to delete?')" style="margin-left: -13px;" role="button">
		<form action="{{ route('vaccinationDosage.destroy', $vaccinations->id) }}" method="post">
            <input class="btn btn-danger" style="padding:6px;" type="submit" value="Delete" />
                {!! method_field('delete') !!}
                {!! csrf_field() !!}
		</form>
	    </a>
	</div>
</div>

<div class="row">

            {!! Helper::display(array("colspan"=>4,"label"=>"Vaccine Id","name"=>"vaccine_id","value"=>$vaccinations['vaccine_id'])) !!}
            {!! Helper::display(array("colspan"=>4,"label"=>"Dosage No","name"=>"dosage_num","value"=>$vaccinations['dosage_num'])) !!}
            {!! Helper::display(array("colspan"=>4,"label"=>"Days after","name"=>"days_after","value"=>$vaccinations['days_after'])) !!}
            </div>
  
  {!! Helper::closePage() !!}
@endsection