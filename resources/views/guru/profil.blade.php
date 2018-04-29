@extends('layouts.app')

@section('content')
@include('layouts/navbar/navbar_guru')
<div class="container text-dark mt-2 mb-2">
    <div class="row">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header text-center">{{ $guru->nama }}</div>
                <div class="card-body">
                    <img @if($guru->foto != 'nophoto.jpg') src="{{ asset('storage/foto-profil/'.$guru->foto) }}" @else src="{{ asset('image/nophoto.jpg') }}" @endif alt="{{ $guru->nama }}" class="img-thumbnail" id="profile-img-tag">
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header text-center">Detail Data Guru</div>
                <div class="card-body">
                    <form action="{{ url('guru/profil') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nip">NIP</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-id-card fa-fw"></i></div>
                                        </div>
                                        <input type="text" class="form-control" id="nip" name="nip" placeholder="Masukkan NIP tanpa spasi" value="{{ $guru->nip }}" autocomplete="off">
                                    </div>
                                </div>                
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-id-badge fa-fw"></i></div>
                                        </div>
                                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama guru" value="{{ $guru->nama }}" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-user-circle fa-fw"></i></div>
                                        </div>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username anda" value="{{ $user->username }}" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">E-Mail</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-envelope fa-fw"></i></div>
                                        </div>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="contoh:yanuar.wanda2@gmail.com" value="{{ $user->email }}" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-home fa-fw"></i></div>
                                </div>
                                <textarea name="alamat" id="alamat" class="form-control" autocomplete="off">{{ $guru->alamat }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="jenisKelamin">Jenis Kelamin</label>
                                    <select name="jenisKelamin" id="jenisKelamin" class="form-control" autocomplete="off">
                                        <option value="L" @if($guru->jenis_kelamin == 'L') selected="" @endif>Laki-laki</option>
                                        <option value="P" @if($guru->jenis_kelamin == 'P') selected="" @endif>Perempuan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="bidangKeahlian">Bidang Keahlian</label>
                                    <select name="bidangKeahlian[]" id="bidangKeahlian" class="form-control selectpicker show-tick" autocomplete="off" title="Silakan pilih keahlian..." data-live-search="true" data-selected-text-format="values" data-size="5" data-style="form-control" multiple="">
                                        @foreach($daftarBK as $kamu)
                                            <option
                                                @foreach($bkGuru as $dia)
                                                    @if($kamu->id_daftar_bidang == $dia->id_daftar_bidang)
                                                        selected=""
                                                    @endif
                                                @endforeach
                                                >
                                                {{ $kamu->bidang_keahlian }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <div class="custom-file">
                                <input id="foto" type="file" name="foto" value="{{ old('foto') }}" class="custom-file-input" autocomplete="off">
                                <label for="foto" class="custom-file-label">Pilih foto</label>
                            </div>
                        </div>

                        <div class="btn-group btn-block">
                            <button type="submit" class="btn btn-primary btn-membesar" data-toggle="tooltip" data-placement="top" title="Edit Data"><i class="fas fa-edit"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
