@extends('layouts.app')

@section('content')
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinyMCE.init({ mode:'specific_textareas', editor_selector:'editor' });</script>
    {{-- <script type="text/javascript">
        tinymce.init({
            mode: 'specific_textareas',
            editor_selector: 'soal',
            plugins: "moxiemanager link image",
            menubar: "insert",
            toolbar: "image",
            image_caption: true,
            external_plugins: {
		              "moxiemanager": "/moxiemanager/plugin.min.js"
            }
        });
    </script> --}}
    {{-- <script>
    tinymce.init({
        imageupload_url: "../upload/",
        mode: 'specific_textareas',
        editor_selector: 'soal',
        theme: "modern",
        language: "en",
        plugins: [
             "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
             "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
             "save table contextmenu directionality emoticons template paste textcolor imageupload"
        ],
        content_css: "css/content.css",
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons imageupload",
        relative_urls: false
    });
    </script>? --}}

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Form Tambah Soal | {{ $ujian->judul_ujian }}</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{url('/kelola-soal/create', base64_encode($ujian->id_ujian))}}">
                            {{csrf_field()}}

                            <div class="form-group{{ $errors->has('tipe') ? ' has-error' : '' }}">
                                 <label for="tipe" class="col-md-2 control-label">Tipe Soal</label>

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


                             <div class="form-group{{ $errors->has('soal') ? ' has-error' : '' }}">
                                 <label for="soal" class="col-md-2 control-label">Soal</label>

                                 <div class="col-md-9">
                                     <textarea name="soal" id="soal" class="editor" rows="10" cols="120">{{ old('soal') }}</textarea>
                                     {{-- <script>
                                         if ( typeof CKEDITOR !== 'undefined' ) {
                                             CKEDITOR.addCss( 'img {max-width:100%; height: auto;}' );
                                             var editor = CKEDITOR.replace( 'soal', {
                                                 extraPlugins: 'uploadimage,image2',
                                                 removePlugins: 'image',
                                                 height:350
                                             } );
                                             CKFinder.setupCKEditor( editor );
                                         } else {
                                             document.getElementById( 'editor1' ).innerHTML = '<div class="tip-a tip-a-alert">This sample requires working Internet connection to load CKEditor from CDN.</div>'
                                         }
                                     </script> --}}

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
