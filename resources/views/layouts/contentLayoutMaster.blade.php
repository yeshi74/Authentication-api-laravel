<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>
        <link rel="shortcut icon" type="image/x-icon" href="images/logo/favicon.ico">
        <script src="{{ asset('public/vendors/js/vendors.min.js') }}"></script>
        @include('panels/styles')
        @yield('mystyle')
    </head>
    @php
        $configData = Helper::applClasses();
    @endphp
    @extends('layouts.verticalLayoutMaster')
