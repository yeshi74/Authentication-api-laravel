@extends('layouts/contentLayoutMaster')
@section('title', 'Vaccination')
@section('content')

{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>""))!!}
  <!-- {!! Helper::form(array("name"=>"frm","action"=>"admin/vaccination/destroy","validate"=>"Yes"))!!} -->
  {!! Helper::hidden(array("name"=>"action","value"=>"edit")) !!}
  {!! Helper::hidden(array("name"=>"id","value"=>$id))!!}

<div class="row">
    <div class="col-md-12">
	    <a class="btn btn-success" href="{{ route('vaccination.edit', $vaccinations->id) }}" role="button">Edit</a>
	    <a class="btn" onclick="return confirm('Are you sure, you want to delete?')" style="margin-left: -13px;" role="button">
		<form action="{{ route('vaccination.destroy', $vaccinations->id) }}" method="post">
            <input class="btn btn-danger" style="padding:6px;" type="submit" value="Delete" />
                {!! method_field('delete') !!}
                {!! csrf_field() !!}
		</form>
	    </a>
	</div>
</div>

<div class="row">
<div>
<img src="{{ asset('public/vaccinations/'.$vaccinations->img)}}" class="img-responsive" style="margin-right:10px; width:45%;">
</div>

            {!! Helper::display(array("colspan"=>4,"label"=>"Name","name"=>"name","value"=>$vaccinations['name'])) !!}
            {!! Helper::display(array("colspan"=>4,"label"=>"Details","name"=>"details","value"=>$vaccinations['details'])) !!}
            {!! Helper::display(array("colspan"=>4,"label"=>"Consent Form","name"=>"consent_form","value"=>$vaccinations['consent_form'])) !!}
            {!! Helper::display(array("colspan"=>4,"label"=>"Consent Details","name"=>"consent_details","value"=>$vaccinations['consent_details']))!!}
            {!! Helper::display(array("colspan"=>4,"label"=>"Price","name"=>"price","value"=>$vaccinations['price']))!!}
            {!! Helper::display(array("colspan"=>4,"label"=>"Discounted Price","name"=>"discounted_price","value"=>$vaccinations['discounted_price']))!!}
            {!! Helper::display(array("colspan"=>4,"label"=>"Dosages","name"=>"dosages","value"=>$vaccinations['dosages']))!!}
            {!! Helper::display(array("colspan"=>4,"label"=>"Home Collectioin","name"=>"home_collection","value"=>$vaccinations['home_collection']))!!}
            {!! Helper::display(array("colspan"=>4,"label"=>"Status","name"=>"status","value"=>$vaccinations['status']))!!}
            {!! Helper::display(array("colspan"=>4,"label"=>"Code","name"=>"code","value"=>$vaccinations['code']))!!}
            </div>
  
  {!! Helper::closePage() !!}


  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
  <a class="btn btn-primary" href="{{ route('vaccinationDosage.create')}}" role="button">Add</a>

  {!! Helper::responsiveTableEx(array("Dosage number","Days after", "Action"))!!}
  <?php
    foreach($lstDosage as $row):
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