@if(count($jumlahRemed) > 0)
    @foreach($jumlahRemed as $jr2 => $isiJR2)
        @if($isiN['id_siswa'] == $isiJR2['id_siswa'] && $isiJR2['remed_ke'] == 2)
        <div role="tabpanel" class="tab-pane fade" id="remed2_{{$ni}}">
            <table class="table table-bordered">
                <tr>
                    <th> No </th>
                    <th> Soal </th>
                    <th> Jawaban Siswa </th>
                    <th> Jawaban Benar </th>
                    <th> Point </th>
                    <th> Hasil </th>
                </tr>
                    <?php $nr2 = 1; ?>
                    @if($soalRemed)
                        @foreach($soalRemed as $sr => $isiSR2)
                        <tr>
                            <td> <?php echo $nr2;$nr2++; ?> </td>
                            <td> 
                                {!! $isiSR2->bankSoal->isi_soal !!} 
                            </td>
                            <td>
                                @foreach($jawabanRemed as $jr2x => $isiJR2X)
                                    @if($isiJR2X->id_siswa == $isiN->id_siswa)
                                        @if($isiJR2X->id_soal_remedial == $isiSR2->id_soal_remedial)
                                            {!! $isiJR2X->jawaban_siswa !!}
                                        @endif
                                    @endif
                                @endforeach
                            </td>
                            <td> {!! $jawaban_benar_remed[$sr] !!} </td>
                            <td> {{ $isiSR2->point }}</td>
                            <td>
                                @foreach($jawabanRemed as $jr2x => $isiJR2X)
                                    @if($isiJR2X->id_siswa == $isiN->id_siswa)
                                        @if($isiJR2X->id_soal_remedial == $isiSR2->id_soal_remedial)
                                            @if($isiJR2X->jawaban_siswa == $jawaban_benar_remed[$sr])
                                                <span class="text-green">Benar</span>
                                            @else
                                                <span class="text-red">Salah</span>
                                            @endif
                                        @endif
                                    @endif
                                @endforeach   
                            </td>
                        </tr>
                        @endforeach
                    @endif
            </table>

            <table class="table table-bordered">
                <tr>
                    <th>Jumlah Benar</th>
                    <th>Jumlah Salah</th>
                </tr>
                <tr>
                    <td>{{ $isiJR2->jawaban_benar }}</td>
                    <td>{{ $isiJR2->jawaban_salah }}</td>
                </tr>
            </table>
        </div>
    @elseif($jr2 == count($jumlahRemed)-1)
        <div role="tabpanel" class="tab-pane fade" id="remed2_{{$ni}}">
            <table class="table table-bordered">
                <tr>
                    <th> No </th>
                    <th> Soal </th>
                    <th> Jawaban Siswa </th>
                    <th> Jawaban Benar </th>
                    <th> Point </th>
                    <th> Hasil </th>
                </tr>
            </table>
        </div>
        @endif
@endforeach
@else
<div role="tabpanel" class="tab-pane fade" id="remed2_{{$ni}}">
    <table class="table table-bordered">
        <tr>
            <th> No </th>
            <th> Soal </th>
            <th> Jawaban Siswa </th>
            <th> Jawaban Benar </th>
            <th> Point </th>
            <th> Hasil </th>
        </tr>
    </table>
</div>
@endif
