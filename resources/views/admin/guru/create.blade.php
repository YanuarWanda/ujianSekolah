@extends('layouts/app')

@section('content')
@include('layouts/navbar/navbar_admin')
            <div class="content p-4">
                <h1 class="text-center">Form Tambah Data Guru</h1>
                <form action="{{ url('guru/add') }}" method="post" enctype="multipart/form-data" id="formTambahGuru">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="nip" class="col-form-label">NIP</label>
                        <div class="input-group" id="nip_nest">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-id-card"></i></div>
                            </div>
                            <input type="text" class="form-control" id="nip" name="nip" placeholder="18 digit tanpa spasi" value="{{ old('nip') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nama" class="col-form-label">Nama</label>
                        <div class="input-group" id="nama_nest">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-id-badge"></i></div>
                            </div>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama" value="{{ old('nama') }}">
                        </div>
                    </div>

                    <div class="form-group" id="alamat_nest">
                        <label for="alamat" class="col-form-label">Alamat</label>
                        <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control">{{ old('alamat') }}</textarea>
                    </div>

                    <div class="form-group" id="jenisKelamin_nest">
                        <label for="jenisKelamin" class="col-form-label">Jenis Kelamin</label>
                        <select name="jenisKelamin" id="jenisKelamin" class="custom-select">
                            <option value='L' {{ old('jenisKelamin') == 'L' ? 'selected' : '' }} >Laki-laki</option>
                            <option value='P' {{ old('jenisKelamin') == 'P' ? 'selected' : '' }} >Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group" id="bidangKeahlian_nest">
                        <label for="bidangKeahlian" class="col-form-label">Bidang Keahlian</label>
                        <select name="bidangKeahlian[]" id="bidangKeahlian" class="form-control selectpicker show-tick" title="Silakan pilih keahlian..." data-live-search="true" data-selected-text-format="values" data-size="5" data-style="form-control" multiple>
                            @foreach($bidangKeahlian as $bk)
                                <option @if(old('bidangKeahlian') == $bk->bidang_keahlian) selected @endif>
                                    {{ $bk->bidang_keahlian }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <hr>
                    <label for="foto" class="col-form-label">Foto</label>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <img src="{{ asset('image/nophoto.jpg') }}" id="profile-img-tag" alt="nophoto" class="img-thumbnail" width="220px">
                        </div>
                        <div class="custom-file col-md-9">
                            <input id="foto" type="file" name="foto" value="{{ old('foto') }}" class="custom-file-input">
                            <label for="foto" class="custom-file-label">Pilih foto</label>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="username" class="col-form-label">Username</label>
                        <div class="input-group" id="username_nest">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-user"></i></div>
                            </div>
                            <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" placeholder="Masukkan username">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-form-label">Email</label>
                        <div class="input-group" id="email_nest">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                            </div>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-form-label">Password</label>
                        <div class="input-group" id="password_nest">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-lock"></i></div>
                            </div>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="col-form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>

                    <div class="btn-group btn-block">
                        <a href="{{ url('guru') }}" class="btn btn-membesar btn-danger" data-toggle="tooltip" data-placement="bottom" title="Kembali"><i class="fas fa-arrow-left"></i></a>
                        <button type="submit" class="btn btn-membesar btn-primary" data-toggle="tooltip" data-placement="bottom" title="Tambah Data Guru"><i class="fas fa-plus"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@include('layouts/navbar/navbar_admin_footer')
<script type="text/javascript">
    $(window).on('load', function(){
        $('#sidebar-menu-guru').addClass('active');
    });

    $(document).ready(function(){
        $('#formTambahGuru').on('submit', function(e){
            e.preventDefault();
            // alert(document.querySelector('#foto').files[0]);
            var $bidangKeAh = [];
            $('#bidangKeahlian').each(function(i, sel){
                var $selectedBidang = $(sel).val();
                $bidangKeAh.push($selectedBidang);
            })

            var formData = new FormData();
            formData.set('nip', $('#nip').val());
            formData.set('nama', $('#nama').val());
            formData.set('alamat', $('#alamat').val());
            formData.set('jenisKelamin', $('#jenisKelamin').val());
            formData.set('bidangKeahlian', $bidangKeAh);
            if(document.querySelector('#foto').files[0]){
                formData.set('foto', document.querySelector('#foto').files[0]);
            }
            formData.set('email', $('#email').val());
            formData.set('username', $('#username').val());
            formData.set('password', $('#password').val());
            formData.set('password_confirmation', $('#password_confirmation').val());
            
            axios({
                method: 'post',
                url: this.action,
                data: formData,
                config: { headers: {'Content-Type': 'multipart/form-data'}}
            })
            .then(function(response) {
                console.log('this is response : ');
                console.log(response);
                const errorMessages = document.querySelectorAll('.text-danger');
                const formControls = document.querySelectorAll('.border-danger');
                if(errorMessages){
                    errorMessages.forEach((element) => element.textContent = '');
                    formControls.forEach((element) => element.classList.remove('border', 'border-danger'));
                }

                $('#formTambahGuru').trigger('reset');
                swal('Success', 'Data berhasil ditambahkan!', 'success');
            })
            .catch((error) => {
                console.log('This is error : ');
                console.log(error);
                const errors = error.response.data.errors;
                const firstItem = Object.keys(errors)[0];
                const firstItemDOM = document.getElementById(firstItem+'_nest');
                const firstErrorMessage = errors[firstItem][0];

                firstItemDOM.scrollIntoView();

                // hapus error sebelumnya
                const errorMessages = document.querySelectorAll('.text-danger');
                const formControls = document.querySelectorAll('.border-danger');
                errorMessages.forEach((element) => element.textContent = '');
                formControls.forEach((element) => element.classList.remove('border', 'border-danger'));
                
                // menampilkan error
                firstItemDOM.insertAdjacentHTML('afterend', '<div class="text-danger">'+firstErrorMessage+'</div>');
            
                // highlight input jadi merah
                firstItemDOM.classList.add('border', 'border-danger');
            });
        });
    });
</script>
@endsection