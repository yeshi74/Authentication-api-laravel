@php
    $configData = Helper::applClasses();
    $lstMenu = Helper::adminMenu();
    $lstParentOpts = $lstMenu['lstParentOpts'];
    $lstUserOpts = $lstMenu['lstUserOpts'];
    $pg="";
    $data = config('custom.customer');
@endphp

<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" style="margin-top:0px;" href="{{url('admin/dashboard')}}">
                    <div class="brand-logo">
                        <h1>
                            PADRA
                        </h1>
                        {{-- <img src="{{asset('public/images/logo.jpg')}}"/> --}}
                    </div>
                      
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block primary collapse-toggle-icon" data-ticon="icon-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item">
                <a href="{{url('admin/dashboard')}}">
                    <i class="fa fa-home"></i><span class="menu-title">Dashboard</span>
                </a>
            </li>
        </ul>

        {{-- Customers --}}
        <div class="default-collapse collapse-bordered collapse-icon accordion-icon-rotate"   data-open-hover="true">
            <div class="card collapse-header" >
                <div id="headingCollapse" class="card-header" data-toggle="collapse" role="button" data-target="#collapse" aria-expanded="false" aria-controls="collapse1">
                    <span class="lead collapse-title"><i class="fa fa-users"></i>&nbsp; Customers</span>
                </div>
                <div id="collapse" role="tabpanel" aria-labelledby="headingCollapse" class="collapse">
                    <div class="card-content">
                        <div class="card-body">
                            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                                <li class="nav-item">
                                    <a href="{{ route('list-customer') }}">
                                            <i class="fa fa-list"></i> 
                                        <span class="menu-title">List Customers</span>
                                    </a>
                                </li><br>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class="nav-item">
            <a href="{{ route('list-pages') }}">
                <i class="fa fa-folder-open"></i><span class="menu-title">Pages</span>
            </a>
        </li>
    </ul>
        {{-- 
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item">
                <a href="{{ route('blogarticleslist') }}">
                    <i class="fa fa-list"></i><span class="menu-title">Blog Articles</span>
                </a>
            </li>
        </ul>
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item">
                <a href="{{ route('contents') }}">
                    <i class="fa fa-list"></i><span class="menu-title">Contents</span>
                </a>
            </li>
        </ul>
		<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item">
                <a href="{{ route('agent.index') }}">
                    <i class="fa fa-folder-open"></i><span class="menu-title">Agents</span>
                </a>
            </li>
        </ul>
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item">
                <a href="{{ route('agent.order') }}">
                    <i class="fa fa-folder-open"></i><span class="menu-title">Agent Orders</span>
                </a>
            </li>
        </ul>
        <div class="default-collapse collapse-bordered collapse-icon accordion-icon-rotate"   data-open-hover="true">
                <div class="card collapse-header" >
                    <div id="headingCollapse{{$ctr}}" class="card-header" data-toggle="collapse" role="button" data-target="#collapse{{$ctr}}" aria-expanded="false" aria-controls="collapse1">
                        <span class="lead collapse-title"><i class="fa fa-medkit"></i>&nbsp; Vaccinations</span>
                    </div>
                    <div id="collapse{{$ctr}}" role="tabpanel" aria-labelledby="headingCollapse{{$ctr}}" class="collapse">
                        <div class="card-content">
                            <div class="card-body">
                                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                                    
                                            <li class="nav-item">
                                                <a href="{{ route('vaccination.index') }}">
                                                     <i class="fa fa-list"></i> 
                                                    <span class="menu-title">Vaccination List</span>
                                                </a>
                                            </li><br>
                                            <li class="nav-item">
                                                <a href="{{ route('vaccinationDosage.index') }}">
                                                    <i class="fa fa-hospital-o"></i>
                                                    <span class="menu-title">Dosage</span>
                                                </a>
                                            </li><br>
                                            <li class="nav-item">
                                                <a href="{{ route('pincode.list') }}">
                                                    <i class="fa fa-thumb-tack"></i>
                                                    <span class="menu-title">Pincodes</span>
                                                </a>
                                            </li><br>
                                            <li class="nav-item">
                                                <a href="#">
                                                    <i class="fa fa-eye"></i>
                                                    <span class="menu-title">Reviews</span>
                                                </a>
                                            </li>
                                     
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
        </div> --}}
        <?php $old=1;?>
        @if($old==0)
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
             
            <?php $custom_classes = "";   ?>
            @foreach($lstParentOpts as $p)
                <?php $count=0; ?>
                @foreach($lstUserOpts as $c)
                    <?php if($c['parent'] == $p['optid']) $count=1; ?>
                @endforeach
                @if($count==1)
                    <?php 
                        $pageid = "admin.".strtolower($p['optid']);
                        
                        $translation="";
                    ?>
                    <li class="navigation-header">
                        <span><i class="fa {{$c['icon']}}"></i>{{ $p->name }}</span>
                    </li>
                    @foreach($lstUserOpts as $c)
                        @if($c['parent'] == $p['optid'])
                            <li class="nav-item {{ (request()->is($c->url)) ? 'active' : '' }} {{ $custom_classes }}">
                                <a href="{{url('admin/'.$c->url)}}">
                                    <i class="fa {{$c['icon']}}"></i>
                                    <span class="menu-title">{{ $c->name }}</span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                @else
                     <li class="nav-item {{ (request()->is($p->url)) ? 'active' : '' }} {{ $custom_classes }}">
                                <a href="{{url('admin/'.$p->url)}}">
                                    <i class="fa {{$p['icon']}}"></i>
                                    <span class="menu-title">{{ $p->name }}</span>
                                </a>
                            </li>
                @endif   
            @endforeach
        </ul>
        @endif
    </div>
</div>
