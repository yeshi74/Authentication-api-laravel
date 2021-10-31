@extends('layouts/contentLayoutMaster')
@section('title', 'Vaccination Dosage')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>""))!!}

<form method="post" action="{{ route('vaccinationDosage.update', $vaccinations->id) }}" ENCTYPE="multipart/form-data">
          <div class="form-group">
          {{ csrf_field() }}
              <label for="vaccineId">Vaccine Id</label>
              <input type="text" class="form-control" name="vaccine_id" value="{{ $vaccinations->vaccine_id }}"/>
          </div>
          <div class="form-group">
              <label for="dosageNo">Dosage No</label>
              <input type="number" class="form-control" name="dosage_num" value="{{ $vaccinations->dosage_num }}"/>
          </div>
          <div class="form-group">
              <label for="daysAfter">Days after</label>
              <input type="number" class="form-control" name="days_after" value="{{ $vaccinations->days_after }}"/>
          </div>
            {!! Helper::button(array("colspan"=>12,"name"=>"btnUpdate","label"=>"Update","type"=>"submit")) !!}
        </form>
@endsection