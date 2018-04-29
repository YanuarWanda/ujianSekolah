@extends('layouts/app')

@section('content')
@include('layouts/navbar/navbar_admin')
            <div class="content p-4">
                <h1 class="text-center">Form Ganti Password</h1>
                <form action="{{ url('settings') }}" method="POST" id="gantiPassword">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="password" class="col-form-label">Password</label>
                        <div class="input-group" id="password_nest">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-lock"></i></div>
                            </div>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password baru">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="col-form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="password_confirmation" placeholder="Masukkan konfirmasi password">
                    </div>

                    <div class="btn-group btn-block">
                        <a href="{{ url('/') }}" class="btn btn-membesar btn-danger" data-toggle="tooltip" data-placement="bottom" title="Kembali"><i class="fas fa-arrow-left"></i></a>
                        <button type="submit" class="btn btn-membesar btn-primary" data-toggle="tooltip" data-placement="bottom" title="Ganti Password"><i class="fas fa-edit"></i></button>
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

</script>
@endsection