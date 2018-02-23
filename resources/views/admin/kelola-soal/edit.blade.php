@extends('layouts.app')

@section('content')
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinyMCE.init({ mode:'specific_textareas', editor_selector:'soal' });</script>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">Form Ubah Soal</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{url('/kelola-soal/update', base64_encode($soal->id_soal))}}">
                            {{csrf_field()}}

                            <div class="form-group{{ $errors->has('tipe') ? ' has-error' : '' }}">
                                 <label for="tipe" class="col-md-2 control-label">Tipe Soal</label>

                                 <div class="col-md-10">
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

                                 <div class="col-md-10">
                                         <textarea name="soal" id="soal" class="soal" rows="10" cols="80">{{ $soal['isi_soal'] }}</textarea>

                                     @if ($errors->has('soal'))
                                         <span class="help-block">
                                             <strong>{{ $errors->first('soal') }}</strong>
                                         </span>
                                     @endif
                                 </div>
                             </div>

                             <div class="form-group{{ $errors->has('pilihanA') ? ' has-error' : '' }}">
                                 <label for="pilihanA" class="col-md-2 control-label">Pilihan A</label>

                                 <div class="col-md-10">
                                     <textarea id="pilihanA" type="text" class="form-control" name="pilihanA" value="{{ old('pilihanA') }}" rows="1" required>{{ $pilihan['0'] }}</textarea>

                                     @if ($errors->has('pilihanA'))
                                         <span class="help-block">
                                             <strong>{{ $errors->first('pilihanA')}} </strong>
                                         </span>
                                     @endif
                                 </div>
                             </div>

                             <div class="form-group{{ $errors->has('pilihanB') ? ' has-error' : '' }}">
                                 <label for="pilihanB" class="col-md-2 control-label">Pilihan B</label>

                                 <div class="col-md-10">
                                     <textarea id="pilihanB" type="text" class="form-control" name="pilihanB" value="{{ old('pilihanB') }}" rows="1" required>{{ $pilihan['1'] }}</textarea>

                                     @if ($errors->has('pilihanB'))
                                         <span class="help-block">
                                             <strong>{{ $errors->first('pilihanB')}} </strong>
                                         </span>
                                     @endif
                                 </div>
                             </div>

                             <div class="form-group{{ $errors->has('pilihanC') ? ' has-error' : '' }}">
                                 <label for="pilihanC" class="col-md-2 control-label">Pilihan C</label>

                                 <div class="col-md-10">
                                     <textarea id="pilihanC" type="text" class="form-control" name="pilihanC" value="{{ old('pilihanC') }}" rows="1" required>{{ $pilihan['2'] }}</textarea>

                                     @if ($errors->has('pilihanC'))
                                         <span class="help-block">
                                             <strong>{{ $errors->first('pilihanC')}} </strong>
                                         </span>
                                     @endif
                                 </div>
                             </div>

                             <div class="form-group{{ $errors->has('pilihanD') ? ' has-error' : '' }}">
                                 <label for="pilihanD" class="col-md-2 control-label">Pilihan D</label>

                                 <div class="col-md-10">
                                     <textarea id="pilihanD" type="text" class="form-control" name="pilihanD" value="{{ old('pilihanD') }}" rows="1" required>{{ $pilihan['3'] }}</textarea>

                                     @if ($errors->has('pilihanD'))
                                         <span class="help-block">
                                             <strong>{{ $errors->first('pilihanD')}} </strong>
                                         </span>
                                     @endif
                                 </div>
                             </div>

                             <div class="form-group{{ $errors->has('pilihanE') ? ' has-error' : '' }}">
                                 <label for="pilihanE" class="col-md-2 control-label">Pilihan E</label>

                                 <div class="col-md-10">
                                     <textarea id="pilihanE" type="text" class="form-control" name="pilihanE" value="{{ old('pilihanE') }}" rows="1" required>{{ $pilihan['4'] }}</textarea>

                                     @if ($errors->has('pilihanE'))
                                         <span class="help-block">
                                             <strong>{{ $errors->first('pilihanE')}} </strong>
                                         </span>
                                     @endif
                                 </div>
                             </div>

                             <div class="form-group{{ $errors->has('jawaban') ? ' has-error' : '' }}">
                                 <label for="jawaban" class="col-md-2 control-label">Jawaban</label>

                                 <div class="col-md-10" style="margin-top:1rem">
                                     A<input type="radio" name="jawaban" value="A" style="margin-right:1rem">
                                     B<input type="radio" name="jawaban" value="B" style="margin-right:1rem">
                                     C<input type="radio" name="jawaban" value="C" style="margin-right:1rem">
                                     D<input type="radio" name="jawaban" value="D" style="margin-right:1rem">
                                     E<input type="radio" name="jawaban" value="E" style="margin-right:1rem">
                                 </div>
                             </div>

                             <div class="form-group">
                                 <div class="col-md-6 col-md-offset-4">
                                     {{-- <a href="{{ url('/kelola-ujian/edit', base64_encode($ujian->id_ujian))}}" class="btn btn-danger">Cancel</a> --}}
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
