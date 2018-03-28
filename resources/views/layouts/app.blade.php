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
    <link rel="stylesheet" type="text/css" href="{{ asset('css/loading.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css')}}">
    
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

    {{-- JQuery --}}
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>

    <script src="{{ asset('js/bootstrap-3.3.5.js') }}"></script>
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
                    backgroundColor: '#3498DB'
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

      $(document).ready(function() {
        var url = "{{route('pie-chart')}}";
        $.get(url, function(response){

          var hak_akses = [];
          var jumlah_data = [];

          console.log(response);
          response.forEach(function(data){
            hak_akses.push(data.hak_akses);
            jumlah_data.push(data.jumlah_data);
          });

          var canvas = document.getElementById('pie').getContext('2d');
          var chart = new Chart(canvas, {
            type: 'pie',
            data: {
              labels: hak_akses,
              datasets: [{
                // label: ,
                data: jumlah_data,
                backgroundColor: ['red', 'green', 'yellow']
              }]
            }
          });

        });

      });

      $(document).ready(function() {
        var response =  [
          {'status': 'draft',   'jumlah': 15 },
          {'status': 'posted',  'jumlah': 27 }
        ];

        var status = [];
        var jumlah = [];

        response.forEach(function(data){
          status.push(data.status);
          jumlah.push(data.jumlah);
        });

        var canvas = document.getElementById('pie-2').getContext('2d');
        var chart = new Chart(canvas, {
          type: 'pie',
          data: {
            labels: status,
            datasets: [{
              // label: ,
              data: jumlah,
              backgroundColor: ['red', 'green']
            }]
          }
        });

      });

      $(document).ready(function() {
        var response =  [
          {'status': 'L',   'jumlah': 18 },
          {'status': 'P',  'jumlah': 11 }
        ];

        var status = [];
        var jumlah = [];

        response.forEach(function(data){
          status.push(data.status);
          jumlah.push(data.jumlah);
        });

        var canvas = document.getElementById('pie-3').getContext('2d');
        var chart = new Chart(canvas, {
          type: 'pie',
          data: {
            labels: status,
            datasets: [{
              // label: ,
              data: jumlah,
              backgroundColor: ['purple', 'orange']
            }]
          }
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

        $('.remove').on('click', function(){
            var url = $(this).attr('href');
            swal({
                title: 'Hapus data?',
                text: 'Data yang dihapus tidak bisa dikembalikan! Data ujian guru ini juga akan ikut terhapus!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Okelah, hapus aja!'
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
                confirmButtonText: 'Okelah, hapus aja!'
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
                confirmButtonText: 'Okelah, hapus aja!'
            }).then((result) =>{
                window.location.replace(url);
            });
        });

        // $('.editor').summernote();
    </script>

    @yield('js')
</body>
</html>
