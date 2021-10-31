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
        {{-- Include core + vendor Styles --}}
        @include('panels/styles')
        {{-- Include page Style --}}
        @yield('mystyle')

    </head>

    

    <body class="vertical-layout vertical-menu-modern 1-column  navbar-floating footer-static bg-full-screen-image  blank-page blank-page" data-menu="vertical-menu-modern" data-col="1-column"  data-layout="light">

        <!-- BEGIN: Content-->
        <div class="app-content content">
            <div class="content-wrapper">
                <div class="content-body">

                    {{-- Include Startkit Content --}}
                    @yield('content')

                </div>
            </div>
        </div>
        <!-- End: Content-->

        {{-- include default scripts --}}
        @include('panels/scripts')

        {{-- Include page script --}}
        @yield('myscript')
    </body>
</html>