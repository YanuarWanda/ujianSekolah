{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body" id="chart-table">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You're logged in
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('image/tercyduk.png')}}" type="image/x-icon">
    <link rel="icon" href="{{asset('image/tercyduk.png')}}" type="image/x-icon">

    <title>{{ config('app.name', 'U-LAH') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- Icon --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css')}}">

    <style type="text/css">

    body {
      overflow-x: hidden;
    }

    #wrapper {
      padding-left: 0;
      -webkit-transition: all 0.5s ease;
      -moz-transition: all 0.5s ease;
      -o-transition: all 0.5s ease;
      transition: all 0.5s ease;
    }

    #wrapper.toggled {
      padding-left: 250px;
    }

    #sidebar-wrapper {
      z-index: 1000;
      position: fixed;
      left: 250px;
      width: 0;
      height: 100%;
      margin-left: -250px;
      overflow-y: auto;
      background: #000;
      -webkit-transition: all 0.5s ease;
      -moz-transition: all 0.5s ease;
      -o-transition: all 0.5s ease;
      transition: all 0.5s ease;
    }

    #wrapper.toggled #sidebar-wrapper {
      width: 250px;
    }

    #page-content-wrapper {
      width: 100%;
      position: absolute;
      padding: 15px;
    }

    #wrapper.toggled #page-content-wrapper {
      position: absolute;
      margin-right: -250px;
    }


    /* Sidebar Styles */

    .sidebar-nav {
      position: absolute;
      top: 0;
      width: 250px;
      margin: 0;
      padding: 0;
      list-style: none;
    }

    .sidebar-nav li {
      text-indent: 20px;
      line-height: 40px;
    }

    .sidebar-nav li a {
      display: block;
      text-decoration: none;
      color: #999999;
    }

    .sidebar-nav li a:hover {
      text-decoration: none;
      color: #fff;
      background: rgba(255, 255, 255, 0.2);
    }

    .sidebar-nav li a:active, .sidebar-nav li a:focus {
      text-decoration: none;
    }

    .sidebar-nav>.sidebar-brand {
      height: 65px;
      font-size: 18px;
      line-height: 60px;
    }

    .sidebar-nav>.sidebar-brand a {
      color: #999999;
    }

    .sidebar-nav>.sidebar-brand a:hover {
      color: #fff;
      background: none;
    }

    @media(min-width:768px) {
      #wrapper {
        padding-left: 0;
      }
      #wrapper.toggled {
        padding-left: 250px;
      }
      #sidebar-wrapper {
        width: 0;
      }
      #wrapper.toggled #sidebar-wrapper {
        width: 250px;
      }
      #page-content-wrapper {
        padding: 20px;
        position: relative;
      }
      #wrapper.toggled #page-content-wrapper {
        position: relative;
        margin-right: 0;
      }
    }

    .nav .breadcrumb {
        margin: 0 7px;
    }
    @media (min-width: 768px) {
        .nav .breadcrumb {
            float: left;
            margin: 7px 10px;
        }
    }

    /* Fixed nav, but free content below it */
    .menu-padding {
        padding-top:40px;
    }

    </style>
</head>
<body>
    {{-- Content --}}

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        <span class="fa fa-graduation-cap"></span> U-LAH
                    </a>
                </li>
                <li>
                    <a href="#">Dashboard</a>
                </li>
                <li>
                    <a href="#">Shortcuts</a>
                </li>
                <li>
                    <a href="#">Overview</a>
                </li>
                <li>
                    <a href="#">Events</a>
                </li>
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
            
            <!-- Fixed navbar -->
            <nav class="navbar navbar-default">
              <div class="container-fluid">
                <div id="navbar">
                  <ul class="nav navbar-nav">
                    <li id="brand"><a href="#"><span class="fa fa-graduation-cap"></span> U-LAH</a></li>
                    <li><a href="#menu-toggle" class="" id="menu-toggle"><span class="fa fa-list"></span> Menu</a></li>

                    <li><ul class="breadcrumb list-inline">
                        <li class="active">Home</li>
                    </ul></li>
                  </ul>
                  <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="#">Settings</a></li>
                        <li><a href="#">Logout</a></li>
                      </ul>
                    </li>
                  </ul>
                </div><!--/.nav-collapse -->
              </div>
            </nav>
                
            <div class="content">
                <h1>HEHEHE</h1>
                @for($a = 1; $a<15;$a++)
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                @endfor
            </div>

            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
    
    {{-- Content --}}



    {{-- JQuery --}}
    <script src="{{ asset('js/app.js') }}"></script>

    {{-- Chart.js --}}
    <script type="text/javascript" src="{{ asset('js/Chart.bundle.min.js') }}"></script>

    <script>
    // static-to-fix navbar
    $(document).ready(function () {

        var brand = $('#brand');
        brand.hide();

        var menu = $('.navbar');
        var origOffsetY = menu.offset().top;

        function scroll() {
            if ($(window).scrollTop() >= origOffsetY) {
                $('.navbar').addClass('navbar-fixed-top');
                brand.show();
                $('.content').addClass('menu-padding');
            } else {
                $('.navbar').removeClass('navbar-fixed-top');
                brand.hide();
                $('.content').removeClass('menu-padding');
            }


        }

        document.onscroll = scroll;

    });

    // Toggle Menu
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
</body>
</html>
