@extends('layouts/app')

@section('content')
@include('layouts/navbar/navbar_admin')
            <div class="content p-4">
                <h1 class="text-center">Import Data Guru</h1>
                <form action="{{ url('guru/import') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="fileExcel" class="col-form-label">File Excel</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="fileExcel" name="fileExcel" value="{{ old('fileExcel') }}">
                            <label for="fileExcel" class="custom-file-label">Pilih file excel ...</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Import File</button>
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
</script>
@endsection