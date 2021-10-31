@extends('layouts/loginMaster')
@section('title', 'Login Page')
@section('mystyle')
  <link rel="stylesheet" href="{{ asset('public/css/pages/authentication.css') }}">
@endsection
@section('content')
<section class="row flexbox-container">
  <div class="col-xl-8 col-11 d-flex justify-content-center">
    <div class="card bg-authentication rounded-0 mb-0">
      <div class="row m-0">
        <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
          <img src="{{ asset('public/images/pages/login.png') }}" alt="branding logo">
        </div>
        <div class="col-lg-6 col-12 p-0">
          <div class="card rounded-0 mb-0 px-2">
            <div class="card-header pb-1">
              <div class="card-title"><h4 class="mb-0">Login</h4></div>
            </div>
            <p class="px-2">Welcome back, please login to your account.</p>
            @if ($message = Session::get('error'))
              <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
              </div>
            @endif
            <div class="card-content">
              <div class="card-body pt-1">
                <form method="POST" action="{{ route('adminLogin') }}">
                  @csrf
                  <fieldset class="form-label-group form-group position-relative has-icon-left">
                    <input id="empcode" type="text" class="form-control @error('email') is-invalid @enderror" name="empcode" placeholder="Employee Code" value="admin" required autofocus>
                    <div class="form-control-position"><i class="feather icon-user"></i></div>
                    <label for="email">E-Mail</label>
                    
                  </fieldset>
                  <fieldset class="form-label-group position-relative has-icon-left">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" value="Slip#960" required autocomplete="current-password">
                    <div class="form-control-position"><i class="feather icon-lock"></i></div>
                    <label for="password">Password</label>
                   
                  </fieldset>
                  <button type="submit" class="btn btn-primary float-right btn-inline">Login</button>
                </form>
              </div>
            </div>
            <div class="login-footer">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
