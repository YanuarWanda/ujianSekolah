@extends('layouts.app')

@section('content')
@include('layouts/navbar/navbar_guru')
<div class="container text-dark">
    <div class="card mt-2 mb-2">
        <div class="card-header"><h1 class="text-center">Form Tambah Soal</h1></div>
        <form action="{{ url('guru/ujian/remed/tambahSoalRemed', base64_encode($ujianRemedial->id_ujian_remedial)) }}" method="POST">    
            {{ csrf_field() }}
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group" id="tipe_nest">
                            <label for="tipe" class="col-form-label">Tipe</label>
                            <select name="tipe" id="tipe" class="form-control">
                                <option value="PG">Pilihan Ganda</option>
                                <option value="BS">Benar / Salah</option>
                                <option value="MC">Multichoice</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="point" class="col-form-label">Point</label>
                            <div class="input-group" id="point_nest">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-trophy"></i></div>
                                </div>
                                <input type="number" name="point" id="point" class="form-control" placeholder="Masukkan nilai point" value="{{ old('point') }}">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group" id="soal_nest">
                    <label for="soal" class="col-form-label">Soal</label>
                    <textarea name="soal" id="soal" cols="30" rows="10" class="form-control" required>{!! old('soal') !!}</textarea>
                </div>
                <hr>
                <div class="form-group PG MC" id="pilihanA_nest">
                    <label for="pilihanA" class="col-form-label">Pilihan A</label>
                    <textarea name="pilihanA" id="pilihanA" cols="30" rows="10" class="form-control">{!! old('pilihanA') !!}</textarea>
                </div>
                
                <div class="form-group PG MC" id="pilihanB_nest">
                    <label for="pilihanB" class="col-form-label">Pilihan B</label>
                    <textarea name="pilihanB" id="pilihanB" cols="30" rows="10" class="form-control">{!! old('pilihanB') !!}</textarea>
                </div>
                
                <div class="form-group PG MC" id="pilihanC_nest">
                    <label for="pilihanC" class="col-form-label">Pilihan C</label>
                    <textarea name="pilihanC" id="pilihanC" cols="30" rows="10" class="form-control">{!! old('pilihanC') !!}</textarea>
                </div>
                
                <div class="form-group PG MC" id="pilihanD_nest">
                    <label for="pilihanD" class="col-form-label">Pilihan D</label>
                    <textarea name="pilihanD" id="pilihanD" cols="30" rows="10" class="form-control">{!! old('pilihanD') !!}</textarea>
                </div>
                
                <div class="form-group PG MC" id="pilihanE_nest">
                    <label for="pilihanE" class="col-form-label">Pilihan E</label>
                    <textarea name="pilihanE" id="pilihanE" cols="30" rows="10" class="form-control">{!! old('pilihanE') !!}</textarea>
                </div>
                
                <div class="form-group">
                    <label for="jawaban" class="col-form-label">Jawaban</label>
                    <br>
                    
                    <label class="radio-inline PG"><input type="radio" name="jawaban" value="A">A</label>
                    <label class="radio-inline PG"><input type="radio" name="jawaban" value="B">B</label>
                    <label class="radio-inline PG"><input type="radio" name="jawaban" value="C">C</label>
                    <label class="radio-inline PG"><input type="radio" name="jawaban" value="D">D</label>
                    <label class="radio-inline PG"><input type="radio" name="jawaban" value="E">E</label>
                    
                    <label class="radio-inline BS"><input type="radio" name="jawaban" value="Benar">Benar</label>
                    <label class="radio-inline BS"><input type="radio" name="jawaban" value="Salah">Salah</label>

                    <div class="form-check form-check-inline MC">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="jawabanMC[]" value="A">A
                        </label>
                    </div>
                    <div class="form-check form-check-inline MC">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="jawabanMC[]" value="B">B
                        </label>
                    </div>
                    <div class="form-check form-check-inline MC">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="jawabanMC[]" value="C">C
                        </label>
                    </div>
                    <div class="form-check form-check-inline MC">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="jawabanMC[]" value="D">D
                        </label>
                    </div>
                    <div class="form-check form-check-inline MC">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="jawabanMC[]" value="E">E
                        </label>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="btn-group btn-block">
                    <a href="{{ url('guru/ujian/remed/detail', base64_encode($ujianRemedial->id_ujian_remedial)) }}" class="btn btn-membesar btn-danger" data-toggle="tooltip" data-placement="bottom" title="Kembali"><i class="fas fa-arrow-left"></i></a>
                    <button type="submit" class="btn btn-membesar btn-primary" data-toggle="tooltip" data-placement="bottom" title="Tambah Data Soal Ujian"><i class="fas fa-plus"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $(window).on('load', function(){
        if($('#tipe').val() == 'PG'){
            $('.MC').slideUp(500, function(){
                $('.BS').slideUp(500, function(){
                    $('.PG').slideDown(500);
                });
            });
        }else if($('#tipe').val() == 'BS'){
            $('.PG').slideUp(500, function(){
                $('.MC').slideUp(500, function (){
                $('.BS').slideDown(500);
                });
            });
        }else if($('#tipe').val() == 'MC'){
            $('.PG').slideUp(500, function(){
                $('.BS').slideUp(500, function(){
                    $('.MC').slideDown(500);
                })
            })
        }
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