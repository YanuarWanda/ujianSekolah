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

    <!-- DataTable Plugin -->
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">

    {{-- Alerts --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert2.min.css') }}">

    {{-- PleaseWait.js Preloader  --}}
    <link href="{{ asset('css/please-wait.css') }}" rel="stylesheet">
    <style type="text/css">
        body > .inner {
          display: none;
        }

        body.pg-loaded > .inner {
          display: block;
        }

        .spinner {
              margin: 100px auto;
              width: 40px;
              height: 40px;
              position: relative;
              text-align: center;
              
              -webkit-animation: sk-rotate 2.0s infinite linear;
              animation: sk-rotate 2.0s infinite linear;
            }

            .dot1, .dot2 {
              width: 60%;
              height: 60%;
              display: inline-block;
              position: absolute;
              top: 0;
              background-color: #333;
              border-radius: 100%;
              
              -webkit-animation: sk-bounce 2.0s infinite ease-in-out;
              animation: sk-bounce 2.0s infinite ease-in-out;
            }

            .dot2 {
              top: auto;
              bottom: 0;
              -webkit-animation-delay: -1.0s;
              animation-delay: -1.0s;
            }

            @-webkit-keyframes sk-rotate { 100% { -webkit-transform: rotate(360deg) }}
            @keyframes sk-rotate { 100% { transform: rotate(360deg); -webkit-transform: rotate(360deg) }}

            @-webkit-keyframes sk-bounce {
              0%, 100% { -webkit-transform: scale(0.0) }
              50% { -webkit-transform: scale(1.0) }
            }

            @keyframes sk-bounce {
              0%, 100% { 
                transform: scale(0.0);
                -webkit-transform: scale(0.0);
              } 50% { 
                transform: scale(1.0);
                -webkit-transform: scale(1.0);
              }
            }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <span><img src="{{asset('image/Facepalm_30px.png')}}" alt="brand">
                        {{ config('app.name', 'Laravel') }}</span>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->username }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('settings') }}">Settings</a>
                                    </li>
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
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Custom -->
    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>

    {{-- PleaseWait.js Preloader  --}}
    <script type="text/javascript" src="{{ asset('js/please-wait.min.js') }}"></script>
    <script type="text/javascript">
        window.loading_screen = pleaseWait({
          logo: "",
          backgroundColor: '#f46d3b',
          loadingHtml: "<p class='loading-message'>Please Wait</p><br><div class='spinner'><div class='dot1'></div><div class='dot2'></div></div>"
        });

        $(window).on('load', function() {
            window.loading_screen.finish();
        });
    </script>

    

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- DataTables -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.js') }}"></script>

    <script>
        $(document).ready(function() {
            $("#tableGuru").DataTable(); // Menambahkan pencarian ke table guru di menu kelola-guru (admin)
            $("#tableSiswa").DataTable(); // Menambahkan pencarian ke table siswa di menu kelola-siswa (admin)
        });

        // Preview gambar dari file chooser.
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#profile-img-tag').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#foto").change(function(){
            readURL(this);
        });
    </script>

    {{-- Alert --}}
    <script src="{{ asset('js/sweetalert2.js') }}"></script>
    @include('layouts.messages')
    
</body>
</html>
