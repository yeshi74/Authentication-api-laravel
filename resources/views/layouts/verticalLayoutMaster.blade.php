<body class="vertical-layout vertical-menu-modern 2-columns    light  navbar-floating menu-expanded footer-static" data-menu="vertical-menu-modern" data-col="2-columns"  data-layout="light">
    @include('panels.sidebar')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        @include('panels.navbar')
        <div class="content-wrapper">
            @yield('content')
            </div>
        </div>
    </div>
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
    @include('panels/footer')
    @include('panels/scripts')
    @yield('myscript')
    <script>
    $(document).ready(function(){
        if($('[data-attach]').length>0) {
            $('#'+$('[data-attach]').data('attach')).val('');
            $('#'+$('[data-attach]').data('attach')+' option').attr('disabled',true);
        }
        $('[data-attach]').on('select2:select', function (e) { 
            $('#'+$(this).data('attach')+' option').attr('disabled',true);
            $('#'+$(this).data('attach')+' option[data-ref="'+$(this).val()+'"]').removeAttr('disabled');
        });
    });
    </script>
</body>
</html>
