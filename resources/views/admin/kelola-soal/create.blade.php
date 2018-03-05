@extends('layouts.app')

@section('content')
    {{-- <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinyMCE.init({ mode:'specific_textareas', editor_selector:'editor' });</script> --}}

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Form Tambah Soal | {{ $ujian->judul_ujian }}</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{url('/kelola-soal/create', base64_encode($ujian->id_ujian))}}">
                            {{csrf_field()}}

                            <div class="form-group{{ $errors->has('tipe') ? ' has-error' : '' }}">
                                 <label for="tipe" class="col-md-2 control-label">Tipe</label>

                                 <div class="col-md-9">
                                     <select name="tipe" id="tipe" class="form-control">
                                         <option value="PG">Pilihan Ganda</option>
                                         <option value="BS">Benar / Salah</option>
                                     </select>

                                     @if ($errors->has('tipe'))
                                         <span class="help-block">
                                             <strong>{{ $errors->first('tipe') }}</strong>
                                         </span>
                                     @endif
                                 </div>
                             </div>

                             <div class="form-group{{ $errors->has('point') ? ' has-error' : '' }}">
                                 <label for="point" class="col-md-2 control-label">Point</label>

                                 <div class="col-md-9">
                                     <input class="form-control" type="number" name="point" value=""/>

                                     @if($errors->has('point'))
                                         <span class="help-block">
                                             <strong>{{ $errors->first('point') }}</strong>
                                         </span>
                                     @endif
                                 </div>
                             </div>

                             <div class="form-group{{ $errors->has('soal') ? ' has-error' : '' }}">
                                 <label for="soal" class="col-md-2 control-label">Soal</label>

                                 <div class="col-md-9">
                                     <textarea name="soal" id="soal" class="form-control editor" rows="10" cols="120">{{ old('soal') }}</textarea>

                                     @if ($errors->has('soal'))
                                         <span class="help-block">
                                             <strong>{{ $errors->first('soal') }}</strong>
                                         </span>
                                     @endif
                                 </div>
                             </div>

                             <div class="form-group{{ $errors->has('pilihanA') ? ' has-error' : '' }} PG">
                                 <label for="pilihanA" class="col-md-2 control-label">Pilihan A</label>

                                 <div class="col-md-9">
                                     <textarea id="pilihanA" type="text" class="form-control editor" name="pilihanA" value="{{ old('pilihanA') }}" rows="1"></textarea>

                                     @if ($errors->has('pilihanA'))
                                         <span class="help-block">
                                             <strong>{{ $errors->first('pilihanA')}} </strong>
                                         </span>
                                     @endif
                                 </div>
                             </div>

                             <div class="form-group{{ $errors->has('pilihanB') ? ' has-error' : '' }} PG">
                                 <label for="pilihanB" class="col-md-2 control-label">Pilihan B</label>

                                 <div class="col-md-9">
                                     <textarea id="pilihanB" type="text" class="form-control editor" name="pilihanB" value="{{ old('pilihanB') }}" rows="1"></textarea>

                                     @if ($errors->has('pilihanB'))
                                         <span class="help-block">
                                             <strong>{{ $errors->first('pilihanB')}} </strong>
                                         </span>
                                     @endif
                                 </div>
                             </div>

                             <div class="form-group{{ $errors->has('pilihanC') ? ' has-error' : '' }} PG">
                                 <label for="pilihanC" class="col-md-2 control-label">Pilihan C</label>

                                 <div class="col-md-9">
                                     <textarea id="pilihanC" type="text" class="form-control editor" name="pilihanC" value="{{ old('pilihanC') }}" rows="1"></textarea>

                                     @if ($errors->has('pilihanC'))
                                         <span class="help-block">
                                             <strong>{{ $errors->first('pilihanC')}} </strong>
                                         </span>
                                     @endif
                                 </div>
                             </div>

                             <div class="form-group{{ $errors->has('pilihanD') ? ' has-error' : '' }} PG">
                                 <label for="pilihanD" class="col-md-2 control-label">Pilihan D</label>

                                 <div class="col-md-9">
                                     <textarea id="pilihanD" type="text" class="form-control editor" name="pilihanD" value="{{ old('pilihanD') }}" rows="1"></textarea>

                                     @if ($errors->has('pilihanD'))
                                         <span class="help-block">
                                             <strong>{{ $errors->first('pilihanD')}} </strong>
                                         </span>
                                     @endif
                                 </div>
                             </div>

                             <div class="form-group{{ $errors->has('pilihanE') ? ' has-error' : '' }} PG">
                                 <label for="pilihanE" class="col-md-2 control-label">Pilihan E</label>

                                 <div class="col-md-9">
                                     <textarea id="pilihanE" type="text" class="form-control editor" name="pilihanE" value="{{ old('pilihanE') }}" rows="1"></textarea>

                                     @if ($errors->has('pilihanE'))
                                         <span class="help-block">
                                             <strong>{{ $errors->first('pilihanE')}} </strong>
                                         </span>
                                     @endif
                                 </div>
                             </div>

                             <div class="form-group{{ $errors->has('jawaban') ? ' has-error' : '' }}">
                                 <label for="jawaban" class="col-md-2 control-label">Jawaban</label>

                                 <div class="col-md-9" style="margin-top:1rem">
                                     <span class="PG">A<input type="radio" name="jawaban" value="A" style="margin-right:1rem"></span>
                                     <span class="PG">B<input type="radio" name="jawaban" value="B" style="margin-right:1rem"></span>
                                     <span class="PG">C<input type="radio" name="jawaban" value="C" style="margin-right:1rem"></span>
                                     <span class="PG">D<input type="radio" name="jawaban" value="D" style="margin-right:1rem"></span>
                                     <span class="PG">E<input type="radio" name="jawaban" value="E" style="margin-right:1rem"></span>
                                     <span class="BS" style="display:none">Benar<input type="radio" name="jawaban" value="Benar" style="margin-right:1rem"></span>
                                     <span class="BS" style="display:none">Salah<input type="radio" name="jawaban" value="Salah" style="margin-right:1rem"></span>
                                 </div>

                             </div>

                             <div class="form-group">
                                 <div class="col-md-6 col-md-offset-4">
                                     <a href="{{ url('/kelola-ujian/edit', base64_encode($ujian->id_ujian))}}" class="btn btn-danger">Cancel</a>
                                     <button type="submit" class="btn btn-primary">
                                         Add
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
        $(document).ready(function(){
           // $('.editor').summernote({
           //     tabsize: 2,
           //     height: 300
           // });
           CKEDITOR.replace( 'soal',{
                filebrowserBrowseUrl: "{{ asset('vendor/ckfinder/ckfinder.html?Type=Files') }}",
                filebrowserImageBrowseUrl: "{{ asset('vendor/ckfinder/ckfinder.html?Type=Images') }}",
                filebrowserFlashBrowseUrl: "{{ asset('vendor/ckfinder/ckfinder.html?Type=Flash') }}",
                filebrowserUploadUrl: "{{ asset('vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
                filebrowserImageUploadUrl: "{{ asset('vendor/ckfinder/core/connctor/php/connector.php?command=QuickUpload&type=Images') }}",
                filebrowserFlashUploadUrl: "{{ asset('vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}"
           });
           CKEDITOR.replace( 'pilihanA',{
                filebrowserBrowseUrl: "{{ asset('vendor/ckfinder/ckfinder.html?Type=Files') }}",
                filebrowserImageBrowseUrl: "{{ asset('vendor/ckfinder/ckfinder.html?Type=Images') }}",
                filebrowserFlashBrowseUrl: "{{ asset('vendor/ckfinder/ckfinder.html?Type=Flash') }}",
                filebrowserUploadUrl: "{{ asset('vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
                filebrowserImageUploadUrl: "{{ asset('vendor/ckfinder/core/connctor/php/connector.php?command=QuickUpload&type=Images') }}",
                filebrowserFlashUploadUrl: "{{ asset('vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}"
           });
           CKEDITOR.replace( 'pilihanB',{
                filebrowserBrowseUrl: "{{ asset('vendor/ckfinder/ckfinder.html?Type=Files') }}",
                filebrowserImageBrowseUrl: "{{ asset('vendor/ckfinder/ckfinder.html?Type=Images') }}",
                filebrowserFlashBrowseUrl: "{{ asset('vendor/ckfinder/ckfinder.html?Type=Flash') }}",
                filebrowserUploadUrl: "{{ asset('vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
                filebrowserImageUploadUrl: "{{ asset('vendor/ckfinder/core/connctor/php/connector.php?command=QuickUpload&type=Images') }}",
                filebrowserFlashUploadUrl: "{{ asset('vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}"
           });
           CKEDITOR.replace( 'pilihanC',{
                filebrowserBrowseUrl: "{{ asset('vendor/ckfinder/ckfinder.html?Type=Files') }}",
                filebrowserImageBrowseUrl: "{{ asset('vendor/ckfinder/ckfinder.html?Type=Images') }}",
                filebrowserFlashBrowseUrl: "{{ asset('vendor/ckfinder/ckfinder.html?Type=Flash') }}",
                filebrowserUploadUrl: "{{ asset('vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
                filebrowserImageUploadUrl: "{{ asset('vendor/ckfinder/core/connctor/php/connector.php?command=QuickUpload&type=Images') }}",
                filebrowserFlashUploadUrl: "{{ asset('vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}"
           });
           CKEDITOR.replace( 'pilihanD',{
                filebrowserBrowseUrl: "{{ asset('vendor/ckfinder/ckfinder.html?Type=Files') }}",
                filebrowserImageBrowseUrl: "{{ asset('vendor/ckfinder/ckfinder.html?Type=Images') }}",
                filebrowserFlashBrowseUrl: "{{ asset('vendor/ckfinder/ckfinder.html?Type=Flash') }}",
                filebrowserUploadUrl: "{{ asset('vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
                filebrowserImageUploadUrl: "{{ asset('vendor/ckfinder/core/connctor/php/connector.php?command=QuickUpload&type=Images') }}",
                filebrowserFlashUploadUrl: "{{ asset('vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}"
           });
           CKEDITOR.replace( 'pilihanE',{
                filebrowserBrowseUrl: "{{ asset('vendor/ckfinder/ckfinder.html?Type=Files') }}",
                filebrowserImageBrowseUrl: "{{ asset('vendor/ckfinder/ckfinder.html?Type=Images') }}",
                filebrowserFlashBrowseUrl: "{{ asset('vendor/ckfinder/ckfinder.html?Type=Flash') }}",
                filebrowserUploadUrl: "{{ asset('vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
                filebrowserImageUploadUrl: "{{ asset('vendor/ckfinder/core/connctor/php/connector.php?command=QuickUpload&type=Images') }}",
                filebrowserFlashUploadUrl: "{{ asset('vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}"
           });

       });
    </script>
@endsection
