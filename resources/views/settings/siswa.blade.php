<form class="form-horizontal" method="POST" action="{{ route('edit-siswa', base64_encode($data->nis)) }}" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('nis') ? ' has-error' : '' }}">
        <label for="nis" class="col-md-4 control-label">Nomor Induk Siswa</label>

        <div class="col-md-6">
            <input id="nis" type="text" class="form-control" name="nis" value="{{ $data->nis }}" required autofocus>

            @if ($errors->has('nis'))
                <span class="help-block">
                    <strong>{{ $errors->first('nis') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
        <label for="nama" class="col-md-4 control-label">Nama</label>

        <div class="col-md-6">
            <input id="nama" type="text" class="form-control" name="nama" value="{{ $data->nama }}" required>

            @if ($errors->has('nama'))
                <span class="help-block">
                    <strong>{{ $errors->first('nama') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('kelas') ? ' has-error' : '' }}">
        <label for="kelas" class="col-md-4 control-label">Kelas</label>

        <div class="col-md-6">
            <select name="kelas" id="kelas" class="form-control">
                @foreach($kelas as $k)
                    <option @if(old('kelas') == $k->nama_kelas || $data->kelas->nama_kelas == $k->nama_kelas) {{ 'selected' }} @endif>{{ $k->nama_kelas }}</option>
                @endforeach
            </select>

            @if ($errors->has('kelas'))
                <span class="help-block">
                    <strong>{{ $errors->first('kelas') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <!-- Jurusan dipindah ke tablenya sendiri, dengan relasi melalui kelas -->
    <!-- <div class="form-group{{ $errors->has('jurusan') ? ' has-error' : '' }}">
        <label for="jurusan" class="col-md-4 control-label">Jurusan</label>

        <div class="col-md-6">
            <input id="jurusan" type="text" class="form-control" name="jurusan" value="{{ $data->jurusan }}" required>

            @if ($errors->has('jurusan'))
                <span class="help-block">
                    <strong>{{ $errors->first('jurusan') }}</strong>
                </span>
            @endif
        </div>
    </div> -->

    <div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
        <label for="alamat" class="col-md-4 control-label">Alamat</label>

        <div class="col-md-6">
            <textarea name="alamat" id="alamat" class="form-control" required>{{ $data->alamat }}</textarea>

            @if ($errors->has('alamat'))
                <span class="help-block">
                    <strong>{{ $errors->first('alamat') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('jenisKelamin') ? ' has-error' : '' }}">
        <label for="jenisKelamin" class="col-md-4 control-label">Jenis Kelamin</label>

        <div class="col-md-6">
            <select name="jenisKelamin" id="jenisKelamin" class="form-control">
                <option value='L' {{ $data->jenis_kelamin == 'L' ? 'selected' : '' }} >Laki-laki</option>
                <option value='P' {{ $data->jenis_kelamin == 'P' ? 'selected' : '' }} >Perempuan</option>
            </select>

            @if ($errors->has('jenisKelamin'))
                <span class="help-block">
                    <strong>{{ $errors->first('jenisKelamin') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <!-- Untuk Foto, sementara dikomentar. Menunggu keputusan lebih lanjut, -->
    <!-- Upload Foto saat register, atau nanti pas edit data. -->
    <div class="form-group{{ $errors->has('foto') ? ' has-error' : '' }}">
        <label for="foto" class="col-md-4 control-label">Foto</label>

        <div class="col-md-6">
            <?php if(empty($data->foto) == false){?>
            <img src="{{asset('storage/foto-profil/'.$data->foto)}}" width="250px" alt="foto" />
            <?php }else{ ?>
            <img src="{{asset('image/nophoto.jpg')}}" width="250px" alt="foto" />
            <?php } ?>
            <input id="foto" type="file" name="foto" value="{{ $data->foto }}">

            @if ($errors->has('foto'))
                <span class="help-block">
                    <strong>{{ $errors->first('foto') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="col-md-4 control-label">E-Mail</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control" name="email" value="{{ $data->user->email }}" required>

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
        <label for="username" class="col-md-4 control-label">Username</label>

        <div class="col-md-6">
            <input id="username" type="text" class="form-control" name="username" value="{{ $data->user->username }}" required>

            @if ($errors->has('username'))
                <span class="help-block">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary pull right">
                Save
            </button>
        </div>
    </div>
</form>