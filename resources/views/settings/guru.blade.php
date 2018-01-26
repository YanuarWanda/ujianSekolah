<form class="form-horizontal" method="POST" action="{{ route('edit-guru', base64_encode($data->nip)) }}" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('nip') ? ' has-error' : '' }}">
        <label for="nip" class="col-md-4 control-label">Nomor Induk Pegawai</label>

        <div class="col-md-6">
            <input id="nip" type="text" class="form-control" name="nip" value="{{ $data->nip }}" required autofocus>

            @if ($errors->has('nip'))
                <span class="help-block">
                    <strong>{{ $errors->first('nip') }}</strong>
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

    <div class="form-group{{ $errors->has('bidangKeahlian') ? ' has-error' : '' }}">
        <label for="bidangKeahlian" class="col-md-4 control-label">Bidang Keahlian</label>

        <div class="col-md-6">
            <input id="bidangKeahlian" type="text" class="form-control" name="bidangKeahlian" value="{{ $data->bidang_keahlian }}" required>

            @if ($errors->has('bidangKeahlian'))
                <span class="help-block">
                    <strong>{{ $errors->first('bidangKeahlian') }}</strong>
                </span>
            @endif
        </div>
    </div>

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
            <img class="img-thumbnail" src="{{asset('storage/foto-profil/'.$data->foto)}}" id="profile-img-tag" width="200px" />
            <?php }else{ ?>
            <img class="img-thumbnail" src="{{asset('image/nophoto.jpg')}}" id="profile-img-tag" width="200px" />
            <?php } ?>
            <input id="foto" type="file" name="foto" value="{{ $data->foto }}" required>

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
            <button type="submit" class="btn btn-primary pull-right">
                Save
            </button>
        </div>
    </div>
</form>