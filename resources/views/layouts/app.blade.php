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

    {{-- Multi Select Picker --}}
    <link href="{{ asset('css/bootstrap-select.min.css') }}" rel="stylesheet">

    {{-- Alerts --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert2.min.css') }}">

    {{-- Icon --}}
    {{-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css')}}">

    {{-- TimePicker --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/timingfield.css')}}">

    {{-- DateTimePicker --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-datetimepicker.min.css')}}">

    {{-- SummerNote --}}
    {{-- <link href="{{ asset('css/bootstrap.3.3.5.css') }}" rel="stylesheet">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet"> --}}

    {{-- CKEditor --}}
    <script type="text/javascript" src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>

    {{-- PleaseWait.js Preloader  --}}
    {{-- <link href="{{ asset('css/please-wait.css') }}" rel="stylesheet"> --}}

    {{-- Custom --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/loading.css')}}"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css')}}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/all.css')}}">
    
    @yield('css')
</head>
<body>
    <div class="loading">
        <div class="spinner">
          <div class="rect1"></div>
          <div class="rect2"></div>
          <div class="rect3"></div>
          <div class="rect4"></div>
          <div class="rect5"></div>
        </div>
    </div>
    
    <a href="#" class=" scroll-up">
    <div id="scroll-up">
      <center><span class="fa fa-chevron-up"></span></center>
    </div>
    </a>

@if(Auth::check())
    @if(Auth::user()->hak_akses == 'siswa')
    <div class="container-fluid">
            
        <!-- Fixed navbar -->
        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <div id="navbar">
              <ul class="nav navbar-nav">
                {{-- <li><a href="#menu-toggle" id="menu-toggle"><span class="fa fa-list" style="font-size: 17px;"></span></a></li> --}}
                <li><a><span class="fa fa-graduation-cap"></span> U-LAH</a></li>

                {{-- <li><ul class="breadcrumb list-inline">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li class="active">US</li>
                </ul></li> --}}

                {{ Breadcrumbs::render() }}
              </ul>
              <ul class="nav navbar-nav navbar-right">
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
              </ul>
            </div><!--/.nav-collapse -->
          </div>
        </nav>
            
        <div class="content">
            @yield('content')
        </div>
    </div>

    {{-- End Siswa --}}

    @elseif(Auth::user()->hak_akses == 'guru')
    <div class="container-fluid">
            
        <!-- Fixed navbar -->
        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <div id="navbar">
              <ul class="nav navbar-nav">
                <li><a href="#menu-toggle" id="menu-toggle"><span class="fa fa-list" style="font-size: 17px;"></span></a></li>
                <li><a href="#"><span class="fa fa-graduation-cap"></span> U-LAH</a></li>

                {{-- <li><ul class="breadcrumb list-inline">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li class="active">US</li>
                </ul></li> --}}

                {{ Breadcrumbs::render() }}
              </ul>
              <ul class="nav navbar-nav navbar-right">
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
              </ul>
            </div><!--/.nav-collapse -->
          </div>
        </nav>
            
        <div class="content">
            @yield('content')
        </div>
    </div>
    {{-- End Guru --}}

    @else
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
                    <a href="{{ route('home') }}">Dashboard</a>
                </li>
                <hr>
                <li><small>Menu Guru</small></li>
                <li>
                    <a href="{{ route('guru') }}">Guru</a>
                </li>
                <li>
                    <a href="{{ route('bidang') }}">Bidang Keahlian</a>
                </li>
                <li>
                    <a href="{{ route('mapel') }}">Mata Pelajaran</a>
                </li>
                <li>
                    <a href="{{ route('ujian') }}">Ujian</a>
                </li>
                <hr>
                <li><small>Menu Siswa</small></li>
                <li>
                    <a href="{{ route('siswa') }}">Siswa</a>
                </li>
                <li>
                    <a href="{{ route('kelas') }}">Kelas</a>
                </li>
                <li>
                    <a href="{{ route('jurusan') }}">Jurusan</a>
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

                    {{-- <li><ul class="breadcrumb list-inline">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About</a></li>
                        <li class="active">US</li>
                    </ul></li> --}}

                    {{ Breadcrumbs::render() }}
                  </ul>
                  <ul class="nav navbar-nav navbar-right">
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
                  </ul>
                </div><!--/.nav-collapse -->
              </div>
            </nav>
                
            <div class="content">
                @yield('content')
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
    
    {{-- Content --}}
    @endif
@else
    <div class="container">
        @yield('content')
    </div>
@endif

    {{-- JQuery --}}
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script> --}}

    {{-- <script src="{{ asset('js/bootstrap-3.3.5.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/summernote-0.8.9.js') }}"></script> --}}

    {{-- Fallback (Local) --}}
    {{-- <script>window.jQuery || document.write('<script src="{{ asset('js/jquery-3.1.1.min.js') }}">\x3C/script>')</script> --}}

    {{-- Fadeout Loading Screen --}}
    <script type="text/javascript">
        $(window).on('load', function() {
            $(".loading").fadeOut("slow", function() {
                $("#app").css('visibility', 'visible');
            });
        });
    </script>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}

    <!-- DataTables -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#tableGuru").DataTable(); // Menambahkan pencarian ke table guru di menu kelola-guru (admin)
            $("#tableSiswa").DataTable(); // Menambahkan pencarian ke table siswa di menu kelola-siswa (admin)
            $("#tableSoal").DataTable(); // Menambahkan pencarian ke table soal di menu edit-ujian (admin)
            $('#tableDaftarBidangKeahlian').DataTable();
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

    {{-- TimePicker --}}
    <script src="{{ asset('js/timingfield.min.js')}}"></script>
    <script>
        $(".timing").timingfield({
            maxHour: 23,
            width: 263,
            hoursText: 'H',
            minutesText: 'M',
            secondsText: 'S'
        });
    </script>

    {{-- Moment buat DateTimePicker --}}
    <script src="{{ asset('js/moment.js')}}"></script>

    {{-- DateTimePicker --}}
    <script src="{{ asset('js/bootstrap-datetimepicker.min.js')}}"></script>
    <script>
        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-M-DD'
        });
    </script>

    {{-- Multi Select Picker --}}
    <script type="text/javascript" src="{{ asset('js/bootstrap-select.min.js') }}"></script>

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
                menu.addClass('navbar-fixed-top');
                brand.show();
                $('.content').addClass('menu-padding');
            } else {
                menu.removeClass('navbar-fixed-top');
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

    
    {{-- Toggle Select Bikin Soal --}}
    <script type="text/javascript">
        $('#tipe').on('change', function(){
           var $value = $('#tipe option:selected').attr('value');
           if($value == 'BS'){
               $('.PG').slideUp(500, function(){
                   $('.MC').slideUp(500, function (){
                      $('.BS').slideDown(500);
                   });
               });
           }else if($value == "PG"){
               $('.MC').slideUp(500, function(){
                  $('.BS').slideUp(500, function(){
                     $('.PG').slideDown(500);
                  });
               });
           }else if($value == "MC"){
               $('.PG').slideUp(500, function(){
                   $('.BS').slideUp(500, function(){
                       $('.MC').slideDown(500);
                   })
               })
           }
        });

        $('#coba').on('click', function(){
           var $isi = $('.panel-body').attr('id');
           $('#'+$isi).slideToggle();
        });

        $('.nextSoal').on('click', function(){
            var $index = $(this).attr('data-panel');
            var $nowIndex = $index.split('_', 3);
            var $nextIndex = parseInt($nowIndex['1'])+1;
            $('#Soal_'+$nowIndex['1']).slideUp(1000, function(){
                $('#Soal_'+$nextIndex).slideDown(1000);
            });
        });

        $('.btnPindah').on('click', function(){
            var $nowIndex = $('.panel-body:visible').attr('id');
            var $index = $(this).attr('data-panel');
            $('#'+$nowIndex).slideUp(1000, function(){
                $('#'+$index).slideDown(1000);
            });
        });

        $('.block').on('click', function(){
            var $index  = $(this).attr('data-panel');
            $('#'+$index).slideToggle(1000);
        });

        $('.remove').on('click', function(e){
            e.preventDefault();
            var url = $(this).attr('href');
            swal({
                title: 'Hapus data?',
                text: 'Data yang dihapus tidak bisa dikembalikan! Data ujian guru ini juga akan ikut terhapus!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Tetap hapus'
            }).then((result) =>{
                window.location.replace(url);
            });
        });

        $('.removeSiswa').on('click', function(){
            var url = $(this).attr('href');
            swal({
                title: 'Hapus data?',
                text: 'Data yang dihapus tidak bisa dikembalikan! Data nilai siswa ini juga akan ikut terhapus!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Tetap hapus'
            }).then((result) =>{
                window.location.replace(url);
            });
        });

        $('.removeUjian').on('click', function(){
            var url = $(this).attr('href');
            swal({
                title: 'Hapus data?',
                text: 'Data yang dihapus tidak bisa dikembalikan! Data nilai siswa yang sudah mengikuti ujian ini juga akan ikut terhapus!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Tetap hapus'
            }).then((result) =>{
                window.location.replace(url);
            });
        });
    </script>

    @yield('js')
</body>
</html>
