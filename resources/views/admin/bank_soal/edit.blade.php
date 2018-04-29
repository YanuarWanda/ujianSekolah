@extends('layouts/app')

@section('content')
@include('layouts/navbar/navbar_admin')
            <div class="content p-4">
                <h1 class="text-center">Form Edit Bank Soal</h1>            
                <form action="{{ url('bank_soal/edit', base64_encode($soal->id_bank_soal)) }}" method="POST" id="formEdit">
                    {{ csrf_field() }}

                    <div class="form-group" id="bidang_keahlian_nest">
                        <label for="bidang_keahlian" class="col-form-label">Bidang Keahlian</label>
                        <select name="bidang_keahlian" id="bidang_keahlian" class="form-control">
                            @foreach($daftarBidang as $db)
                                <option value="{{ $db->id_daftar_bidang }}" @if($soal->id_daftar_bidang == $db->id_daftar_bidang) selected @endif>{{ $db->bidang_keahlian }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" id="tipe_nest">
                        <label for="tipe" class="col-form-label">Tipe</label>
                        <select name="tipe" id="tipe" class="form-control">
                            <option value="PG" @if($soal->tipe == 'PG') selected @endif>Pilihan Ganda</option>
                            <option value="BS" @if($soal->tipe == 'BS') selected @endif>Benar / Salah</option>
                            <option value="MC" @if($soal->tipe == 'MC') selected @endif>Multichoice</option>
                        </select>
                    </div>

                    <div class="form-group" id="soal_nest">
                        <label for="soal" class="col-form-label">Soal</label>
                        <textarea name="soal" id="soal" cols="30" rows="10" class="form-control">{!! $soal->isi_soal !!}</textarea>
                    </div>
                    <hr>
                    @if($soal->tipe == 'PG' || $soal->tipe == 'MC')
                        <div class="form-group PG MC" id="pilihanA_nest">
                            <label for="pilihanA" class="col-form-label">Pilihan A</label>
                            <textarea name="pilihanA" id="pilihanA" cols="30" rows="10" class="form-control">@if($pilihan[0]){!! $pilihan[0] !!}@endif</textarea>
                        </div>
                        
                        <div class="form-group PG MC" id="pilihanB_nest">
                            <label for="pilihanB" class="col-form-label">Pilihan B</label>
                            <textarea name="pilihanB" id="pilihanB" cols="30" rows="10" class="form-control">@if($pilihan[1]){!! $pilihan[1] !!}@endif</textarea>
                        </div>
                        
                        <div class="form-group PG MC" id="pilihanC_nest">
                            <label for="pilihanC" class="col-form-label">Pilihan C</label>
                            <textarea name="pilihanC" id="pilihanC" cols="30" rows="10" class="form-control">@if($pilihan[2]){!! $pilihan[2] !!}@endif</textarea>
                        </div>
                    
                        <div class="form-group PG MC" id="pilihanD_nest">
                            <label for="pilihanD" class="col-form-label">Pilihan D</label>
                            <textarea name="pilihanD" id="pilihanD" cols="30" rows="10" class="form-control">@if($pilihan[3]){!! $pilihan[3] !!}@endif</textarea>
                        </div>
                        
                        <div class="form-group PG MC" id="pilihanE_nest">
                            <label for="pilihanE" class="col-form-label">Pilihan E</label>
                            <textarea name="pilihanE" id="pilihanE" cols="30" rows="10" class="form-control">@if($pilihan[4]){!! $pilihan[4] !!}@endif</textarea>
                        </div>
                    @endif
                        
                    <div class="form-group">
                        <label for="jawaban" class="col-form-label">Jawaban</label>
                        <br>

                        @if($soal->tipe == 'PG')
                            <label class="radio-inline PG"><input type="radio" name="jawaban" value="A" @if($jawaban == $pilihan[0]) checked @endif>A</label>
                            <label class="radio-inline PG"><input type="radio" name="jawaban" value="B" @if($jawaban == $pilihan[1]) checked @endif>B</label>
                            <label class="radio-inline PG"><input type="radio" name="jawaban" value="C" @if($jawaban == $pilihan[2]) checked @endif>C</label>
                            <label class="radio-inline PG"><input type="radio" name="jawaban" value="D" @if($jawaban == $pilihan[3]) checked @endif>D</label>
                            <label class="radio-inline PG"><input type="radio" name="jawaban" value="E" @if($jawaban == $pilihan[4]) checked @endif>E</label>
                        @endif

                        @if($soal->tipe == 'BS')
                            <label class="radio-inline BS"><input type="radio" name="jawaban" value="Benar" @if($jawaban == 'Benar') checked @endif>Benar</label>
                            <label class="radio-inline BS"><input type="radio" name="jawaban" value="Salah" @if($jawaban == 'Salah') checked @endif>Salah</label>
                        @endif

                        @if($soal->tipe == 'MC')
                            <div class="form-check form-check-inline MC">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="jawabanMC[]" value="A" @if($jawaban[0] != '') @if($jawaban[0] == $pilihan[0]) checked @endif @endif>A
                                </label>
                            </div>
                            <div class="form-check form-check-inline MC">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="jawabanMC[]" value="B" @if($jawaban[1] != '') @if($jawaban[1] == $pilihan[1]) checked @endif @endif>B
                                </label>
                            </div>
                            <div class="form-check form-check-inline MC">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="jawabanMC[]" value="C" @if($jawaban[2] != '') @if($jawaban[2] == $pilihan[2]) checked @endif @endif>C
                                </label>
                            </div>
                            <div class="form-check form-check-inline MC">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="jawabanMC[]" value="D" @if($jawaban[3] != '') @if($jawaban[3] == $pilihan[3]) checked @endif @endif>D
                                </label>
                            </div>
                            <div class="form-check form-check-inline MC">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="jawabanMC[]" value="E" @if($jawaban[4] != '') @if($jawaban[4] == $pilihan[4]) checked @endif @endif>E
                                </label>
                            </div>
                        @endif

                    </div>

                    <div class="btn-group btn-block">
                        <a href="{{ url('bank_soal') }}" class="btn btn-membesar btn-danger" data-toggle="tooltip" data-placement="bottom" title="Kembali"><i class="fas fa-arrow-left"></i></a>
                        <button type="submit" class="btn btn-membesar btn-primary" data-toggle="tooltip" data-placement="bottom" title="Tambah Data Bank Soal"><i class="fas fa-plus"></i></button>
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
        $('#sidebar-menu-bank-soal').addClass('active');
    });

    $(document).ready(function(){
        $('#tipe').on('change', function(){
            var $value = $('#tipe option:selected').attr('value');
            if($value == 'BS'){
                $('.PG').slideUp(500, function(){
                    $('.MC').slideUp(500, function (){
                    $('.BS').slideDown(500);
                    });
                });
            }else if($value == "PG"){
                $('.MC').slideUp(500, function(){
                $('.BS').slideUp(500, function(){
                    $('.PG').slideDown(500);
                });
                });
            }else if($value == "MC"){
                $('.PG').slideUp(500, function(){
                    $('.BS').slideUp(500, function(){
                        $('.MC').slideDown(500);
                    })
                })
            }
        });

        CKEDITOR.replace( 'soal',{
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        });
        CKEDITOR.replace( 'pilihanA',{
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        });
        CKEDITOR.replace( 'pilihanB',{
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        });
        CKEDITOR.replace( 'pilihanC',{
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        });
        CKEDITOR.replace( 'pilihanD',{
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        });
        CKEDITOR.replace( 'pilihanE',{
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        });
    })
</script>
@endsection