@extends('layouts/contentLayoutMaster')
@section('title', 'Vaccination')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>""))!!}

<form method="post" action="{{ route('vaccination.update', $vaccinations->id) }}" ENCTYPE="multipart/form-data">
          <div class="form-group">
          {{ csrf_field() }}
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name" value="{{ $vaccinations->name }}"/>
          </div>
          <div class="form-group">
              <label for="details">Details</label>
              <input type="text" class="form-control" name="details" value="{{ $vaccinations->details }}"/>
          </div>
          <div class="form-group">
              <label for="consent_form">Consent Form</label>
              <input type="number" class="form-control" name="consent_form" value="{{ $vaccinations->consent_form }}"/>
          </div>
          <div class="form-group">
              <label for="consent_details">Consent Details</label>
              <input type="textarea" class="form-control" name="consent_details" value="{{ $vaccinations->details }}"/>
          </div>
          <div class="form-group">
              <label for="price">Price</label>
              <input type="number" class="form-control" name="price" value="{{ $vaccinations->price }}">
          </div>
          <div class="form-group">
              <label for="discounted_price">Discounted Price</label>
              <input type="number" class="form-control" name="discounted_price" value="{{ $vaccinations->discounted_price }}"/>
          </div>
          <div class="form-group">
				<label for="dosages">Dosages</label>
				<input type="number" class="form-control" name="dosages" value="{{ $vaccinations->dosages }}">
            </div>
            <div class="form-group">
				<label for="home_collection">Home Collection</label>
				<input type="number" class="form-control" name="home_collection" value="{{ $vaccinations->home_collection }}">
            </div>
            <div class="row">
            {!!Helper::selectStatus(array("colspan"=>4,"label"=>"Status","name"=>"status","value"=>$vaccinations['status'])) !!}
            </div>
            <div class="form-group">
				<label for="image">Image</label>
				<input type="file" class="form-control" name="img" value="{{ $vaccinations->img }}">
            </div>
             <!-- <div class="row"> 
            {!!Helper::selectStatus(array("colspan"=>4,"label"=>"Status","name"=>"status","value"=>"{{ $vaccinations->status }}")) !!}
            </div>  -->
            <div class="form-group">
              <label for="code">Code</label>
              <input type="text" class="form-control" name="code" value="{{ $vaccinations->code }}"/>
            </div>
            {!! Helper::button(array("colspan"=>12,"name"=>"btnUpdate","label"=>"Update","type"=>"submit")) !!}
            <!-- <button type="submit" class="btn btn-block btn-danger">Update</button> -->
        </form>
@endsection