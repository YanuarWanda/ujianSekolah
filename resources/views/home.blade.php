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
      background: #1ABC9C;
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
      color: #ECF0F1;
    }

    .sidebar-nav li a:hover {
      text-decoration: none;
      color: #2EEC31;
      /*background: rgba(255, 255, 255, 0.2);*/
      /*background: rgba(46, 204, 113, 1.0);*/
      background: rgba(52, 152, 219, 1.0);
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
      color: #ECF0F1;
    }

    .sidebar-nav>.sidebar-brand a:hover {
      color: #3498DB;
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
        /*background-color: #2EEC31;*/
    }

    .nav .breadcrumb a {
        color: #2EEC31;
        text-decoration: none;
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

    /* Scroll Up */
    #scroll-up {
      position: fixed;
      bottom: 35px;
      right: 35px;
      z-index: 9999999;
      display: none;
      padding: 7px;
      background-color: #2EEC31;
      width: 41px;
    }

    </style>
</head>
<body>

  <a href="#" class=" scroll-up">
  <div id="scroll-up">
    <center><span class="fa fa-chevron-up"></span></center>
  </div>
  </a>

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
                <hr>
                <li><small>Menu Guru</small></li>
                <li>
                    <a href="#">Guru</a>
                </li>
                <li>
                    <a href="#">Bidang Keahlian</a>
                </li>
                <li>
                    <a href="#">Ujian</a>
                </li>
                <hr>
                <li><small>Menu Siswa</small></li>
                <li>
                    <a href="#">Siswa</a>
                </li>
                <li>
                    <a href="#">Kelas</a>
                </li>
                <li>
                    <a href="#">Jurusan</a>
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
                    <li><a href="#menu-toggle" id="menu-toggle"><span class="fa fa-list" style="font-size: 17px;"></span></a></li>
                    <li id="brand"><a href="#"><span class="fa fa-graduation-cap"></span> U-LAH</a></li>

                    <li><ul class="breadcrumb list-inline">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About</a></li>
                        <li class="active">US</li>
                    </ul></li>
                  </ul>
                  <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">UserName <span class="caret"></span></a>
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
                {{-- Chart --}}
                <div class="panel panel-default">
                    <div class="panel-heading">Contoh STATISTIK</div>

                    <div class="panel-body">
                        <div class="row">
                          <div class="col-md-6">
                            <canvas id="ujian1"></canvas>
                          </div>
                          <div class="col-md-6">
                            <canvas id="ujian2"></canvas>
                          </div>
                        </div>
                    </div>
                </div>
                {{-- Chart --}}
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

        // Ubah Icon
        var icon = $("#menu-toggle span");
        if(icon.hasClass("fa-list")) {
          icon.removeClass("fa-list").addClass("fa-arrow-left");
        }else{
          icon.removeClass("fa-arrow-left").addClass("fa-list");
        }

        // Toggle menu
        $("#wrapper").toggleClass("toggled");
    });

    // Scroll Up
    $(document).ready(function() {
      var fixed = false;
      $(document).scroll(function() {
        if($(this).scrollTop() > 251) {
          if(!fixed) {
            fixed = true;
            $('#scroll-up').show('fast', function() {
              $('#scroll-up').css({
                position: 'fixed', 
                display: 'block'
              });
            });
          }
        }else { 
          if(fixed) {
            fixed = false;
            $('#scroll-up').hide('fast', function() {
              $('#scroll-up').css({
                display: 'none'
              });
            });
          }
        }
      });

      $('#scroll-up').on('click', function() {
        $('html, body').animate({ scrollTop : 0 }, 755);
      });
    });
    </script>

    {{-- Chart --}}
    <script type="text/javascript">
      $(document).ready(function(){
        var url = "{{ route('data-nilai') }}";
        var label;
        var daftarChart = ['ujian1', 'ujian2', 'ujian3'];
        // console.log(daftarChart);
        $.get(url, function(response){
          // console.log(response);
          // response.forEach(function(data){
            for(var i=0, len = response.length; i<len;i++) {
            // Chart 1
            var nama_kelas = [];
            
            var nilai = [];

            // console.log(data);

            response[i].forEach(function(realData){
              // console.log(realData);
              nama_kelas.push(realData.nama_kelas);
              label = realData.judul_ujian;
              nilai.push(realData.nilai_rata_rata);
            });

            var ctx = document.getElementById(daftarChart[i]).getContext('2d');
            var myChart = new Chart(ctx, {
              type: 'bar',
              data: {
                  labels:nama_kelas,
                  datasets: [{
                    label: label,
                    data: nilai,
                    borderWidth: 1,
                    backgroundColor: 'lightblue'
                  }]
              },
              options: {
                  scales: {
                      yAxes: [{
                          ticks: {
                              beginAtZero:true
                          }
                      }]
                  }
              }
            });
            // console.log('judul-ujian-'+i);
          }

        });
      });
    </script>
</body>
</html>
