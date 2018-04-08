@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Import data Siswa</div>

                <div class="panel-body">
                    <span class="help-block">
                        Untuk menambahkan data siswa dari file excel, silahkan upload.
                    </span>
                    
                    <form action="{{ url('/kelola-siswa/import') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('fileExcel') ? ' has-error' : '' }}">
                            <label for="fileExcel" class="col-md-2 control-label">File Excel</label>

                            <div class="col-md-8">
                                <input id="fileExcel" type="file" name="fileExcel" value="{{ old('fileExcel') }}" >

                                @if ($errors->has('fileExcel'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fileExcel') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">Import File</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
