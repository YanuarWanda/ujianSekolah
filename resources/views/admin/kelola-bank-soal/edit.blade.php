@extends('layouts.app')

@section('content')
    {{-- <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinyMCE.init({ mode:'specific_textareas', editor_selector:'editor' });</script> --}}

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">Edit Bank Soal</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ url('/kelola-bank-soal/update', base64_encode($soal['id_bank_soal'])) }}">
                            {{csrf_field()}}

                            {{-- <div class="form-group{{ $errors->has('mapel') ? ' has-error' : '' }}">
                                 <label for="mapel" class="col-md-2 control-label">mapel</label>

                                 <div class="col-md-9">
                                     <select name="mapel" id="mapel" class="form-control selectpicker" data-live-search="true" data-size="5">
                                         @foreach($mapel as $m)
                                         <option>{{$m->nama_mapel}}</option>
                                         @endforeach
                                     </select>

                                     @if ($errors->has('mapel'))
                                         <span class="help-block">
                                             <strong>{{ $errors->first('mapel') }}</strong>
                                         </span>
                                     @endif
                                 </div>
                             </div> --}}

                             <div class="form-group{{ $errors->has('bidangKeahlian') ? ' has-error' : '' }}">
                                 <label for="bidangKeahlian" class="col-md-2 control-label">Bidang Keahlian</label>

                                 <div class="col-md-9">
                                     <select name="bidangKeahlian" id="bidangKeahlian" class="form-control selectpicker" data-live-search="true" data-size="5">
                                         @foreach($bidangKeahlian as $bidang)
                                            <option value="{{$bidang->id_daftar_bidang}}" {{ $soal->id_daftar_bidang == $bidang->id_daftar_bidang ? 'selected' : '' }} >{{$bidang->bidang_keahlian}}</option>
                                         @endforeach
                                     </select>

                                     @if ($errors->has('bidangKeahlian'))
                                         <span class="help-block">
                                             <strong>{{ $errors->first('bidangKeahlian') }}</strong>
                                         </span>
                                     @endif
                                 </div>
                             </div>

                            <div class="form-group{{ $errors->has('tipe') ? ' has-error' : '' }}">
                                 <label for="tipe" class="col-md-2 control-label">Tipe</label>

                                 <div class="col-md-9">
                                     <select name="tipe" id="tipe" class="form-control">
                                         <option value="PG" <?php if($soal->tipe){if($soal->tipe == 'PG'){ ?> selected <?php }} ?>>Pilihan Ganda</option>
                                         <option value="BS" <?php if($soal->tipe){if($soal->tipe == 'BS'){ ?> selected <?php }} ?>>Benar / Salah</option>
                                         <option value="MC" <?php if($soal->tipe){if($soal->tipe == 'MC'){ ?> selected <?php }} ?>>Multichoice</option>
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
                                     <textarea name="soal" id="soal" class="form-control editor" rows="10" cols="120">{!! $soal->isi_soal or old('soal') !!}</textarea>

                                     @if ($errors->has('soal'))
                                         <span class="help-block">
                                             <strong>{{ $errors->first('soal') }}</strong>
                                         </span>
                                     @endif
                                 </div>
                             </div>

                            @if($soal->tipe == 'PG' || $soal->tipe == 'MC')
                                <div class="form-group{{ $errors->has('pilihanA') ? ' has-error' : '' }} PG MC">
                                     <label for="pilihanA" class="col-md-2 control-label">Pilihan A</label>

                                     <div class="col-md-9">
                                         <textarea id="pilihanA" type="text" class="form-control editor" name="pilihanA" rows="1">@if($pilihan[0]) {!! $pilihan[0] !!} @endif</textarea>

                                        @if ($errors->has('pilihanA'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('pilihanA')}} </strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('pilihanB') ? ' has-error' : '' }} PG MC">
                                    <label for="pilihanB" class="col-md-2 control-label">Pilihan B</label>

                                    <div class="col-md-9">
                                        <textarea id="pilihanB" type="text" class="form-control editor" name="pilihanB" rows="1">@if($pilihan[1]) {!! $pilihan[1] !!} @endif</textarea>

                                        @if ($errors->has('pilihanB'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('pilihanB')}} </strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('pilihanC') ? ' has-error' : '' }} PG MC">
                                    <label for="pilihanC" class="col-md-2 control-label">Pilihan C</label>

                                    <div class="col-md-9">
                                        <textarea id="pilihanC" type="text" class="form-control editor" name="pilihanC" rows="1">@if($pilihan[2]) {!! $pilihan[2] !!} @endif</textarea>

                                        @if ($errors->has('pilihanC'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('pilihanC')}} </strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('pilihanD') ? ' has-error' : '' }} PG MC">
                                    <label for="pilihanD" class="col-md-2 control-label">Pilihan D</label>

                                    <div class="col-md-9">
                                        <textarea id="pilihanD" type="text" class="form-control editor" name="pilihanD" rows="1">@if($pilihan[3]) {!! $pilihan[3] !!} @endif</textarea>

                                        @if ($errors->has('pilihanD'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('pilihanD')}} </strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('pilihanE') ? ' has-error' : '' }} PG MC">
                                    <label for="pilihanE" class="col-md-2 control-label">Pilihan E</label>

                                    <div class="col-md-9">
                                        <textarea id="pilihanE" type="text" class="form-control editor" name="pilihanE" rows="1">@if($pilihan[4]) {!! $pilihan[4] !!} @endif</textarea>

                                        @if ($errors->has('pilihanE'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('pilihanE')}} </strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <div class="form-group{{ $errors->has('jawaban') ? ' has-error' : '' }}">
                                 <label for="jawaban" class="col-md-2 control-label">Jawaban</label>

                                 <div class="col-md-9" style="margin-top:1rem">
                                     @if($soal->tipe == 'PG')
                                        <span class="PG">A<input type="radio" name="jawaban" value="A" style="margin-right:1rem" @if($jawaban == $pilihan[0]) checked @endif></span>
                                        <span class="PG">B<input type="radio" name="jawaban" value="B" style="margin-right:1rem" @if($jawaban == $pilihan[1]) checked @endif></span>
                                        <span class="PG">C<input type="radio" name="jawaban" value="C" style="margin-right:1rem" @if($jawaban == $pilihan[2]) checked @endif></span>
                                        <span class="PG">D<input type="radio" name="jawaban" value="D" style="margin-right:1rem" @if($jawaban == $pilihan[3]) checked @endif></span>
                                        <span class="PG">E<input type="radio" name="jawaban" value="E" style="margin-right:1rem" @if($jawaban == $pilihan[4]) checked @endif></span>
                                    @endif
                                    
                                    @if($soal->tipe == 'BS')
                                        <span class="BS">Benar<input type="radio" name="jawaban" value="Benar" style="margin-right:1rem" @if($jawaban == 'Benar') checked @endif></span>
                                        <span class="BS">Salah<input type="radio" name="jawaban" value="Salah" style="margin-right:1rem" @if($jawaban == 'Salah') checked @endif></span>
                                    @endif

                                    @if($soal->tipe == 'MC')
                                        <span class="MC">A<input type="checkbox" name="jawabanMC[]" value="A" style="margin-right:1rem" @if($jawaban[0] != '') @if($jawaban[0] == $pilihan[0]) checked @endif @endif/></span>
                                        <span class="MC">B<input type="checkbox" name="jawabanMC[]" value="B" style="margin-right:1rem" @if($jawaban[1] != '') @if($jawaban[1] == $pilihan[1]) checked @endif @endif/></span>
                                        <span class="MC">C<input type="checkbox" name="jawabanMC[]" value="C" style="margin-right:1rem" @if($jawaban[2] != '') @if($jawaban[2] == $pilihan[2]) checked @endif @endif/></span>
                                        <span class="MC">D<input type="checkbox" name="jawabanMC[]" value="D" style="margin-right:1rem" @if($jawaban[3] != '') @if($jawaban[3] == $pilihan[3]) checked @endif @endif/></span>
                                        <span class="MC">E<input type="checkbox" name="jawabanMC[]" value="E" style="margin-right:1rem" @if($jawaban[4] != '') @if($jawaban[4] == $pilihan[4]) checked @endif @endif/></span>
                                    @endif
                                 </div>

                             </div>

                             <div class="form-group">
                                 <div class="col-md-6 col-md-offset-4">
                                     <a href="{{ url('/kelola-bank-soal')}}" class="btn btn-danger">Cancel</a>
                                     <button type="submit" class="btn btn-primary">
                                         Update
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
    $('#bank_soal').addClass('active');
        $(document).ready(function(){

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
