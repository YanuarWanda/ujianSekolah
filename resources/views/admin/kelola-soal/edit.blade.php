@extends('layouts.app')

@section('content')
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinyMCE.init({ mode:'specific_textareas', editor_selector:'editor' });</script>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Form Ubah Soal | {{ $ujian->judul_ujian }}</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{url('/kelola-soal/update', base64_encode($soal->id_soal))}}">
                            {{csrf_field()}}

                            <div class="form-group{{ $errors->has('tipe') ? ' has-error' : '' }}">
                                 <label for="tipe" class="col-md-2 control-label">Tipe Soal</label>

                                 <div class="col-md-9">
                                     <select name="tipe" id="tipe" class="form-control">
                                         <option value="PG" <?php if($soal['tipe']){if($soal['tipe'] == 'PG'){ ?> selected <?php }} ?>>Pilihan Ganda</option>
                                         <option value="BS" <?php if($soal['tipe']){if($soal['tipe'] == 'BS'){ ?> selected <?php }} ?>>Benar / Salah</option>
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
                                         <textarea name="soal" id="soal" class="editor" rows="10" cols="80">{{ $soal['isi_soal'] }}</textarea>

                                     @if ($errors->has('soal'))
                                         <span class="help-block">
                                             <strong>{{ $errors->first('soal') }}</strong>
                                         </span>
                                     @endif
                                 </div>
                             </div>


                             <div class="PG" @if($soal['tipe'] == 'BS') style="display:none" @endif>
                                 <div class="form-group{{ $errors->has('pilihanA') ? ' has-error' : '' }}">
                                     <label for="pilihanA" class="col-md-2 control-label">Pilihan A</label>

                                     <div class="col-md-9">
                                         <textarea id="pilihanA" type="text" class="form-control editor" name="pilihanA" value="{{ old('pilihanA') }}" rows="1" required>@if($soal['tipe'] == 'PG') {{ $pilihan['0'] }} @endif</textarea>

                                         @if ($errors->has('pilihanA'))
                                             <span class="help-block">
                                                 <strong>{{ $errors->first('pilihanA')}} </strong>
                                             </span>
                                         @endif
                                     </div>
                                 </div>

                                 <div class="form-group{{ $errors->has('pilihanB') ? ' has-error' : '' }}">
                                     <label for="pilihanB" class="col-md-2 control-label">Pilihan B</label>

                                     <div class="col-md-9">
                                         <textarea id="pilihanB" type="text" class="form-control editor" name="pilihanB" value="{{ old('pilihanB') }}" rows="1" required>@if($soal['tipe'] == 'PG') {{ $pilihan['1'] }} @endif</textarea>

                                         @if ($errors->has('pilihanB'))
                                             <span class="help-block">
                                                 <strong>{{ $errors->first('pilihanB')}} </strong>
                                             </span>
                                         @endif
                                     </div>
                                 </div>

                                 <div class="form-group{{ $errors->has('pilihanC') ? ' has-error' : '' }}">
                                     <label for="pilihanC" class="col-md-2 control-label">Pilihan C</label>

                                     <div class="col-md-9">
                                         <textarea id="pilihanC" type="text" class="form-control editor" name="pilihanC" value="{{ old('pilihanC') }}" rows="1" required>@if($soal['tipe'] == 'PG') {{ $pilihan['2'] }} @endif</textarea>

                                         @if ($errors->has('pilihanC'))
                                             <span class="help-block">
                                                 <strong>{{ $errors->first('pilihanC')}} </strong>
                                             </span>
                                         @endif
                                     </div>
                                 </div>

                                 <div class="form-group{{ $errors->has('pilihanD') ? ' has-error' : '' }}">
                                     <label for="pilihanD" class="col-md-2 control-label">Pilihan D</label>

                                     <div class="col-md-9">
                                         <textarea id="pilihanD" type="text" class="form-control editor" name="pilihanD" value="{{ old('pilihanD') }}" rows="1" required>@if($soal['tipe'] == 'PG') {{ $pilihan['3'] }} @endif</textarea>

                                         @if ($errors->has('pilihanD'))
                                             <span class="help-block">
                                                 <strong>{{ $errors->first('pilihanD')}} </strong>
                                             </span>
                                         @endif
                                     </div>
                                 </div>

                                 <div class="form-group{{ $errors->has('pilihanE') ? ' has-error' : '' }}">
                                     <label for="pilihanE" class="col-md-2 control-label">Pilihan E</label>

                                     <div class="col-md-9">
                                         <textarea id="pilihanE" type="text" class="form-control editor" name="pilihanE" value="{{ old('pilihanE') }}" rows="1" required>@if($soal['tipe'] == 'PG') {{ $pilihan['4'] }} @endif</textarea>

                                         @if ($errors->has('pilihanE'))
                                             <span class="help-block">
                                                 <strong>{{ $errors->first('pilihanE')}} </strong>
                                             </span>
                                         @endif
                                     </div>
                                 </div>
                             </div>

                             <div class="form-group{{ $errors->has('jawaban') ? ' has-error' : '' }}">
                                 <label for="jawaban" class="col-md-2 control-label">Jawaban</label>

                                 <div class="col-md-9" style="margin-top:1rem">
                                     <div class="PG" @if($soal['tipe'] == 'BS') style="display:none" @endif>
                                         <span class="PG">A<input type="radio" name="jawaban" value="A" style="margin-right:1rem" @if($soal['tipe'] == 'PG') @if($soal['jawaban'] == $pilihan['0']) checked @endif @endif/></span>
                                         <span class="PG">B<input type="radio" name="jawaban" value="B" style="margin-right:1rem" @if($soal['tipe'] == 'PG') @if($soal['jawaban'] == $pilihan['1']) checked @endif @endif/></span>
                                         <span class="PG">C<input type="radio" name="jawaban" value="C" style="margin-right:1rem" @if($soal['tipe'] == 'PG') @if($soal['jawaban'] == $pilihan['2']) checked @endif @endif/></span>
                                         <span class="PG">D<input type="radio" name="jawaban" value="D" style="margin-right:1rem" @if($soal['tipe'] == 'PG') @if($soal['jawaban'] == $pilihan['3']) checked @endif @endif/></span>
                                         <span class="PG">E<input type="radio" name="jawaban" value="E" style="margin-right:1rem" @if($soal['tipe'] == 'PG') @if($soal['jawaban'] == $pilihan['4']) checked @endif @endif/></span>
                                    </div>
                                    <div class="BS" @if ($soal['tipe'] == 'PG') style="display:none" @endif>
                                         <span class="BS">Benar<input type="radio" name="jawaban" value="Benar" style="margin-right:1rem" @if($soal['tipe'] == 'BS') @if($soal['jawaban'] == $pilihan['0']) checked @endif @endif></span>
                                         <span class="BS">Salah<input type="radio" name="jawaban" value="Salah" style="margin-right:1rem" @if($soal['tipe'] == 'BS') @if($soal['jawaban'] == $pilihan['1']) checked @endif @endif></span>
                                    </div>
                                </div>
                             </div>

                             <div class="form-group">
                                 <div class="col-md-4 col-md-offset-2">
                                     <a href="{{ url('/kelola-ujian/edit', base64_encode($ujian->id_ujian))}}" class="btn btn-danger">Cancel</a>
                                     <button type="submit" class="btn btn-primary">
                                         Ubah
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
