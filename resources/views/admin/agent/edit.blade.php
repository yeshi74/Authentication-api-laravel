@extends('layouts/contentLayoutMaster')
@section('title', 'Contents')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>""))!!}

<form method="post" action="{{ route('agent.update', $agent->id) }}" ENCTYPE="multipart/form-data">
          <div class="form-group">
          {{ csrf_field() }}
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name" value="{{ $agent->name }}"/>
          </div>
          <div class="form-group">
              <label for="details">Email</label>
              <input type="text" class="form-control" name="email" value="{{ $agent->email }}"/>
          </div>
          <div class="form-group">
              <label for="consent_details">City</label>
              <input type="text" class="form-control" name="city" value="{{ $agent->city }}"/>
          </div>
          <div class="form-group">
            <label for="consent_details">State</label>
            <input type="text" class="form-control" name="state" value="{{ $agent->state }}"/>
        </div>
        <div class="form-group">
            <label for="details">Pincodes</label>
              <select class="form-control" name="pincodes[]" multiple>
                  @foreach ($pincodes as $row)
                  <option <?php if($row->pincode == "{{ $row->pincode }}"){echo "selected";}?>>{{ $row->pincode }}</option>
                  @endforeach
              </select>
          </div>
        <div class="form-group">
            <label for="consent_details">Password</label>
            <input type="password" class="form-control" name="password" value="{{ $agent->password }}"/>
        </div>
            <div class="row">
            {!!Helper::selectStatus(array("colspan"=>4,"label"=>"Status","name"=>"status","value"=>$agent['status'])) !!}
            </div>
            {!! Helper::button(array("colspan"=>12,"name"=>"btnUpdate","label"=>"Update","type"=>"submit")) !!}
            <!-- <button type="submit" class="btn btn-block btn-danger">Update</button> -->
        </form>
@endsection