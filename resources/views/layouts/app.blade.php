<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Styles -->
    <link href="{{ asset('MDB/css/compiled.min.css') }}" rel="stylesheet">
    <style>
        .table-wrapper-2 {
    display: block;
    max-height: 300px;
    overflow-y: auto;
    -ms-overflow-style: -ms-autohiding-scrollbar;
}
.scroll-box {
            overflow-y: scroll;
            height: 450px;
            padding: 1rem
        }

    </style>
</head>
<body class="fixed-sn light-blue-skin pace-done"> 
<?php
$owners = DB::table('staff')
                        ->join('companies', 'staff.company_id', '=', 'companies.id')
                        ->select('staff.*', 'companies.name as companyname', 'companies.logo as companylogo', 'companies.user_id as owner')
                        ->where('staff.user_id', Auth::user()->id)
                        ->where('companies.user_id', Auth::user()->id)
                        ->get();
$employees = DB::table('staff')
                        ->join('companies', 'staff.company_id', '=', 'companies.id')
                        ->select('staff.*', 'companies.name as companyname', 'companies.logo as companylogo', 'companies.user_id as owner')
                        ->where('staff.user_id', Auth::user()->id)
                        ->where('companies.user_id', '!=',Auth::user()->id)
                        ->get();
?>
    <div id="app">
        <header>
        <!-- Sidebar navigation -->
        <ul id="slide-out" class="side-nav fixed sn-bg-1 custom-scrollbar">
            <!-- Logo -->
            <li>
                <div class="logo-wrapper waves-light">
                    <a href="{{ route('home') }}"><img src="{{ asset('images/kofix/Kofix_logo-03.png') }}" class="img-fluid flex-center"></a>
                </div>
            </li>
            <!--/. Logo -->
            <!--Social-->
            <li>
                <ul class="social">
                    <li><a class="icons-sm fb-ic"><i class="fa fa-facebook"> </i></a></li>
                    <li><a class="icons-sm pin-ic"><i class="fa fa-pinterest"> </i></a></li>
                    <li><a class="icons-sm gplus-ic"><i class="fa fa-google-plus"> </i></a></li>
                    <li><a class="icons-sm tw-ic"><i class="fa fa-twitter"> </i></a></li>
                </ul>
            </li>
            <!--/Social-->
            <!--Search Form-->
            <li>
                <form class="search-form" role="search">
                    <div class="form-group waves-light">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                </form>
            </li>
            <!--/.Search Form-->
            <!-- Side navigation links -->
            <li>
                <ul class="collapsible collapsible-accordion">
                    <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-chevron-right"></i> Employee<i class="fa fa-angle-down rotate-icon"></i></a>
                        <div class="collapsible-body">
                            <ul>
                                @foreach($employees as $employee)
                                    <li><a href="{{ route('stall.show', ['company' => $employee->company_id ])}}" class="waves-effect">{{$employee->companyname}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                    <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-hand-pointer-o"></i> Owner<i class="fa fa-angle-down rotate-icon"></i></a>
                        <div class="collapsible-body">
                            <ul>
                                @foreach($owners as $owner)
                                    <li><a href="{{ route('stall.show', ['company' => $owner->company_id ])}}" class="waves-effect">{{$owner->companyname}}</a></li>
                                    
                                @endforeach
                            </ul>
                        </div>
                    </li>
                    <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-eye"></i> About<i class="fa fa-angle-down rotate-icon"></i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="{{ route('subscription.index') }}" class="waves-effect">Subscription</a>
                                </li>
                                <li><a href="#" class="waves-effect">Monthly meetings</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-envelope-o"></i> Contact me<i class="fa fa-angle-down rotate-icon"></i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="#" class="waves-effect">FAQ</a>
                                </li>
                                <li><a href="#" class="waves-effect">Write a message</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
            <!--/. Side navigation links -->
            <div class="sidenav-bg mask-strong"></div>
        </ul>
        <!--/. Sidebar navigation -->
        <!-- Navbar -->
        <nav class="navbar fixed-top navbar-toggleable-md navbar-expand-lg scrolling-navbar double-nav">
            <!-- SideNav slide-out button -->
            <div class="float-left">
                <a href="#" data-activates="slide-out" class="button-collapse"><i class="fa fa-bars"></i></a>
            </div>
            <!-- Breadcrumb-->
            <div class="breadcrumb-dn mr-auto">
                <p>Your Order</p>
            </div>
            <ul class="nav navbar-nav nav-flex-icons ml-auto">
                <li class="nav-item">
                    <a class="nav-link"><i class="fa fa-envelope"></i> <span class="clearfix d-none d-sm-inline-block">Contact</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"><i class="fa fa-comments-o"></i> <span class="clearfix d-none d-sm-inline-block">Support</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user"></i> <span class="clearfix d-none d-sm-inline-block">@if (Auth::guest()) Login/Register @else {{ Auth::user()->name }} @endif
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.Navbar -->
    </header>
        {{-- <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav> --}}

        @yield('content')
    </div>
    <!-- Scripts -->
    <script src="{{ asset('MDB/js/compiled.min.js') }}"></script>
    <script>
        $(".button-collapse").sideNav();
        $('.mdb-select').material_select();
        
        $(document).ready(function () {
            @if(session('status'))
                toastr.info("{{ session('status') }}");
            @endif

            // counting checkbox realtime
            
            $('#cashmenulist').change(function(){
                updatecounter();
            });
            function updatecounter(){
                var totalcashprice = $('#cashmenulist input:checkbox:checked').map(function() {
                    return $(this).attr( "price" );
                }).get();
                var cashordermenuid = 'none';
                var partialsum = 0;
                if (totalcashprice.length != 0) {
                    cashordermenuid = $('#cashmenulist input:checkbox:checked').map(function() {
                        return $(this).attr( "value" );
                    }).get();
                    partialsum = totalcashprice.reduce(function(prev, cur) {
                        return Number(prev)+Number(cur);
                    });    
                }
                
                
               $('#cashpartialsum').empty().append(partialsum);
               $('#modalcashoutvalue').empty().append('RM '+partialsum);
               $('#cashtotalamountpaid').val(partialsum);
               $('#paidordermenuid').val(cashordermenuid);
               $('#cashoutmodalform').attr('action', '/cashing/');
            }

            // end of counting checkbox realtime
        });
    </script>
</body>
</html>