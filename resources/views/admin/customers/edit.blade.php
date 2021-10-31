@extends('layouts/contentLayoutMaster')
@section('title', 'Edit Customer')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
<?php
// Helper::form(array("name"=>"frm","action"=>"admin/customers/update","class"=>"editForm frmvalidate", "enctype"=>"multipart/form-data"));
// Helper::hidden(array("name"=>"action","value"=>"update"));
// Helper::hidden(array("name"=>"id","value"=>$id));
?>


@if(session('added'))
<div class="alert alert-success">
  {{ session('added') }}
</div>
@endif
@if(session('updated'))
<div class="alert alert-info">
  {{ session('updated') }}
</div>
@endif
<legend>Edit Customer</legend>
<div id="form_error" class="form_error"></div>  
<form method="post" action="{{ route('update-customer', $customer->id) }}" ENCTYPE="multipart/form-data">
    {{ csrf_field() }}
<div class="row">
  <div class="col-md-4">
    <label>Name</label>
    <input id="name" name="name" class="form-control name" value="{{ $customer['name'] }}" type="text">
    <div id="name_error"  class="name_error"></div>  
  </div>
  <div class="col-md-4">
    <label>Gender</label>
    <input id="contact_name" name="nationality" class="form-control contact_name" value="{{ $customer['nationality'] }}" type="text">
  </div>

  <div class="col-lg-4">
    <label>Mobile</label>
    <input id="mobile" name="mobile" class="form-control mobile txtMob validate[required]" value="{{ $customer['mobile'] }}" type="text">
  </div>
  <div id="name_error" class="name_error"></div>  
</div>

<div class="row" style="margin-top:10px;">
  <div class="col-lg-4">
    <label>Email</label>
    <input id="email" name="email" class="form-control email validate[required]" value="{{ $customer['email'] }}" type="text">
  </div>
  <div class="col-lg-4">
    <label>Living Country</label>
    <input id="password" name="living_country" class="form-control validate[required]" type="text" value="{{ $customer['living_country'] }}">
  </div>
  <div class="col-lg-4">
    <label>Source</label>
    <input id="email" name="source" class="form-control validate[required]" value="{{ $customer['source'] }}" type="text">
  </div>
</div>

<div class="row" style="margin-top:10px;">
    <div class="col-lg-4">
      <label>Department</label> 
      <input type="text" value="{{$customer['department']}}" class="form-control" name="department" id="valid_from">
    </div>
    
    <div class="col-lg-4">
      <label>Doctor</label> 
      <input type="text" value="{{$customer['doctor']}}" name="doctor" class="form-control">
    </div>
    <div class="col-md-4">
      <label>Receptionist</label>
      <input id="footer_msg" name="receptionist" class="form-control footer_msg" type="text" value="{{$customer['receptionist']}}">
    </div>
  
  </div>

<div class="row" style="margin-top:10px;">
    <div class="col-lg-4">
        <label>Call center agent</label>
        <input id="email" name="call_center_agent" class="form-control" value="{{ $customer['call_center_agent'] }}" type="text">
    </div>
    <div class="col-lg-4">
      <label>Date</label> 
      <input type="date"  class="form-control tagline" id="tagline" name="date" value="{{$customer['date']}}">
    </div>
    <div class="col-md-4">
      <label>Sales Man</label>
      <input id="footer_msg" name="sales_man" class="form-control footer_msg" type="text" value="{{$customer['sales_man']}}">
    </div>
</div>
<div class="row" style="margin-top:10px;">
  <div class="col-lg-4">
    <label>Sales Team</label>
    <input id="footer_msg" name="sales_team" class="form-control footer_msg" type="text" value="{{$customer['sales_team']}}"> 
  </div>
  <div class="col-lg-4">
    <label>Password</label>
    <input id="footer_msg" name="password" class="form-control footer_msg" type="password" value="{{$customer['password']}}"> 
  </div>
  <div class="col-lg-4">
    <label>Confirm Password</label>
    <input id="footer_msg" name="password_confirmation" class="form-control footer_msg" type="password" value="{{$customer['password_confirmation']}}"> 
  </div>
</div>
<br>

    {!! Helper::button(array("colspan"=>12,"name"=>"btnUpdate","label"=>"Update","type"=>"submit")) !!}

</form>

</div>

<?php
Helper::closePage();
?>
@endsection
