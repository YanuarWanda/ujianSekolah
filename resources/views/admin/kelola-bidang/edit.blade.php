@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Edit data Bidang Keahlian</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('/kelola-bidang/update', base64_encode($data->id_daftar_bidang)) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('bidang_keahlian') ? ' has-error' : '' }}">
                            <label for="bidang_keahlian" class="col-md-4 control-label">Bidang Keahlian</label>

                            <div class="col-md-6">
                                <input id="bidang_keahlian" type="text" class="form-control" name="bidang_keahlian" value="{{ $data->bidang_keahlian }}" required autofocus>

                                @if ($errors->has('bidang_keahlian'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('bidang_keahlian') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="/kelola-bidang" class="btn btn-danger">Cancel</a>
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
    $('#kelola').addClass('active open');
  $('#bidang').addClass('active');
</script>
@endsection