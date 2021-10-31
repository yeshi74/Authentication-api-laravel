@extends('layouts/contentLayoutMaster')
@section('title', 'Pincode')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>""))!!}

<form method="post" action="{{ route('pincode.update', $vaccinations->id) }}" ENCTYPE="multipart/form-data">
          <div class="form-group">
          {{ csrf_field() }}
              <label for="pincode">Pincode</label>
              <input type="number" class="form-control" name="pincode" value="{{ $vaccinations->pincode }}"/>
          </div>
          <div class="form-group">
              <label for="location">Location</label>
              <input type="text" class="form-control" name="place" value="{{ $vaccinations->place }}"/>
          </div>
            {!! Helper::button(array("colspan"=>12,"name"=>"btnUpdate","label"=>"Update","type"=>"submit")) !!}
        </form>
@endsection