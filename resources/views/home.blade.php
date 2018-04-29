@extends('layouts/app')
@section('css')
    <style>
        .absolute-bottom{
            position: absolute;
            bottom: 0;
            left: 25%;
        }
        .mb-12{
            margin-bottom: 300px;
        }
    </style>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row fit-height">
        <div class="col-12 col-lg-4 bg-green min-h-100">
            <a href="{{ url('/') }}">
                <img src="{{ asset('image/logo.png') }}" alt="Logo U-LAH" class="float-top-left" width="30px">  
                <h1 class="brand-top-left">U-Lah</h1>
            </a>

            <div class="loginBox p-3" id="login">
                <h2 class="text-center">Sign in</h2>
                
                <form action="{{ url('login') }}" method="post" class="pr-5 pl-5">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label class="col-form-label" for="usernameLogin">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-user"></i></div>
                            </div>
                            <input type="text" class="form-control" id="usernameLogin" name="usernameLogin" placeholder="Masukkan username anda" value="{{ old('usernameLogin') }}"/>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-form-label" for="passwordLogin">Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-lock"></i></div>
                            </div>
                            <input type="password" class="form-control" id="passwordLogin" name="passwordLogin" />
                        </div>
                    </div>
                    
                    <div class="btn-group btn-block" role="group">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i></button>
                    </div>
                    <hr>
                    <!-- <button type="button" class="btn btn-outline-light btn-block">Lupa password?</button> -->
                    <button type="button" class="btn btn-outline-primary btn-block" id="pindahDaftar" data-box="daftar">Pendaftaran Siswa</button>
                </form>
            </div>

            <div class="loginBox p-3" id="daftar" style="display:none">
                <h2 class="text-center"> Pendaftaran Siswa </h2>

                <form action="{{ url('registerSiswa') }}" method="post" class="pr-4 pl-4" id="siswaRegisterForm">
                    {{ csrf_field() }}
                    <div id="daftar_1">
                        <div class="form-group">
                            <label class="col-form-label" for="nis">Nomor Induk Siswa</label>
                            <div class="input-group" id="nis_nest">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-id-card"></i></div>
                                </div>
                                <input type="text" class="form-control" id="nis" name="nis" placeholder="contoh:1502011462" value="{{ old('nis') }}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label" for="nama">Nama</label>
                            <div class="input-group" id="nama_nest">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-id-badge"></i></div>
                                </div>
                                <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label" for="jenisKelamin">Jenis Kelamin</label>
                            <select name="jenisKelamin" id="jenisKelamin" class="custom-select">
                                <option value='L' {{ old('jenisKelamin') == 'L' ? 'selected' : '' }} >Laki-laki</option>
                                <option value='P' {{ old('jenisKelamin') == 'P' ? 'selected' : '' }} >Perempuan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label" for="kelas">Kelas</label>
                            <select name="kelas" id="kelas" class="custom-select">
                                @foreach($kelas as $k)
                                    <option @if(old('kelas') == $k->nama_kelas) {{ 'selected' }} @endif>{{ $k->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="btn-group btn-block" role="group">
                            <button type="button" class="btn btn-primary btn-block" onclick="nextDaftar();">Next</button>
                            <button type="button" class="btn btn-primary" onclick="nextDaftar();"><i class="fas fa-arrow-right"></i></button>
                        </div>
                    </div>

                    <div id="daftar_2" style="display:none">
                        <div class="form-group">
                            <label class="col-form-label" for="email">E-Mail</label>
                            <div class="input-group" id="email_nest">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                                </div>
                                <input type="email" class="form-control" id="email" name="email" placeholder="contoh:yanuar.wanda2@gmail.com" value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label" for="username">Username</label>
                            <div class="input-group" id="username_nest">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-user"></i></div>
                                </div>
                                <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}"/>
                            </div>
                       </div>

                        <div class="form-group">
                            <label class="col-form-label" for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password"/>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label" for="password_confirmation">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="btn-group btn-block" role="group">
                                    <button type="button" class="btn btn-secondary" onclick="previousDaftar();"><i class="fas fa-arrow-left"></i></button>    
                                    <button type="button" class="btn btn-secondary btn-block" onclick="previousDaftar();">Back</button>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="btn-group btn-block" role="group">
                                    <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button type="button" class="btn btn-outline-primary btn-block" id="pindahLogin" data-box="login">Login</button>
                </form>
            </div>
        </div>
        
        <div class="col-12 col-lg-8 bg-image-2">
            <div class="rightBox">
                <h1 class="text-center text-light">Features</h1>
                <div class="row">
                    <div class="col-4">
                        <div class="informationBox p-3 mb-12 mt-3 ml-3 mr-3">
                            <h2>Remedial Ujian</h2>
                            <hr>
                            <p>Dengan fitur ini, siswa yang mendapat nilai di bawah kkm dapat memperbaiki nilainya.</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="informationBox p-3 mb-12 mt-3 ml-3 mr-3">
                            <h2>Random Soal</h2>
                            <hr>
                            <p>Saat mengerjakan ujian, soal dan pilihan jawaban diacak agar mengurangi kecurangan.</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="informationBox p-3 mb-12 mt-3 ml-3 mr-3">
                            <h2>Export Data</h2>
                            <hr>
                            <p>Dengan fitur ini data data yang ada pada aplikasi dapat dijadikan file excel untuk pengarsipan.</p>
                        </div>
                    </div>
                </div>
                
                <!-- <div class="informationBox p-3 mb-3 mt-3">
                    <h1>Acak Soal dan Pilihan Jawaban</h1>
                    <p>Saat mengerjakan ujian, soal dan pilihan jawaban diacak agar mengurangi kecurangan.</p>
                </div> -->

                <!-- <div class="informationBox p-3 mb-3 mt-3">
                    <h1>Export Data</h1>
                    <p>Dengan fitur ini data data yang ada pada aplikasi dapat dijadikan file excel untuk pengarsipan</p>
                </div> -->
            
                <div class="contactBox text-light absolute-bottom">
                    <h1 class="text-center">Kontak Kami</h1>             
                    <p>Email : yanuar.wanda2@gmail.com | No HP : 087825418390</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#pindahDaftar').on('click', function(){
                $('#login').fadeOut(500, function(){
                    $('#daftar').fadeIn(500);
                });
            });

            $('#pindahLogin').on('click', function(){
                $('#daftar').fadeOut(500, function(){
                    $('#login').fadeIn(500);
                })
            })

            $('#siswaRegisterForm').on('submit', function(e){
                e.preventDefault();
                
                axios.post(this.action,{
                    'nis': $('#nis').val(),
                    'nama': $('#nama').val(),
                    'jenisKelamin': $('#jenisKelamin').val(),
                    'kelas': $('#kelas').val(),
                    'email': $('#email').val(),
                    'username': $('#username').val(),
                    'password': $('#password').val(),
                    'password_confirmation': $('#password_confirmation').val()
                })
                .then((response) => {
                    const errorMessages = document.querySelectorAll('.text-danger');
                    const formControls = document.querySelectorAll('.form-control');
                    if(errorMessages){
                        errorMessages.forEach((element) => element.textContent = '');
                        formControls.forEach((element) => element.classList.remove('border', 'border-danger'));
                    }

                    this.reset();
                    swal('Success', 'Data berhasil terdaftar!', 'success');
                })
                .catch((error) => {
                    const errors = error.response.data.errors;
                    const firstItem = Object.keys(errors)[0];
                    const firstItemDOM = document.getElementById(firstItem+'_nest');
                    const firstErrorMessage = errors[firstItem][0];
                    
                    // scroll ke error
                    if(firstItem == 'nama' || firstItem == 'nis' || firstItem == 'jenisKelamin' || firstItem == 'kelas'){
                        previousDaftar();
                    }else{
                        nextDaftar();
                    }
                    firstItemDOM.scrollIntoView();

                    // hapus error sebelumnya
                    const errorMessages = document.querySelectorAll('.text-danger');
                    const formControls = document.querySelectorAll('.form-control');
                    errorMessages.forEach((element) => element.textContent = '');
                    formControls.forEach((element) => element.classList.remove('border', 'border-danger'));
                   
                    // menampilkan error
                    firstItemDOM.insertAdjacentHTML('afterend', '<div class="text-danger">'+firstErrorMessage+'</div>');
                
                    // highlight input jadi merah
                    firstItemDOM.classList.add('border', 'border-danger');
                })
            });
        }); 
        
        function nextDaftar(){
            $('#daftar_1').fadeOut(500, function(){
                $('#daftar_2').fadeIn(500);
            });
        }

        function previousDaftar(){
            $('#daftar_2').fadeOut(500, function(){
                $('#daftar_1').fadeIn(500);
            });
        }

    </script>
@endsection