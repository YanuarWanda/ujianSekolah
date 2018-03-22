<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Ujian;
use App\Mapel;
use App\UjianRemedial;
use App\SoalRemed;
use App\NilaiRemedial;

class RemedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function timetosec($time){
        $hours = substr($time, 0, -6);
        $minutes = substr($time, -5, 2);
        $seconds = substr($time, -2);

        return $hours * 3600 + $minutes * 60 + $seconds;
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $ujian = Ujian::find(base64_decode($id));

        return view('admin.kelola-remed.create', compact('ujian'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $ujian = Ujian::find(base64_decode($id));
        $ujianRemedial = UjianRemedial::where('id_ujian', base64_decode($id))->get();
        $remedKe = 200;$xx = 0;
        // return $ujianRemedial;

        if(count($ujianRemedial) > 0){
            foreach($ujianRemedial as $ur => $isiUR){
                if($isiUR->id_ujian == base64_decode($id)){
                    $xx++;
                }
                $remedKe = $xx+1;
            }
        }else{
            $remedKe = 1;
        }

        // return $xx;
        
        if($request['catatan'] == ''){
            $request['catatan'] = 'Tidak ada catatan.';
        }

        $remed = UjianRemedial::create([
            'id_ujian'          => $ujian->id_ujian,
            'waktu_pengerjaan'  => gmdate("H:i:s", $request['waktu_pengerjaan']),
            'catatan'           => $request['catatan'],
            'remed_ke'          => $remedKe,
        ]);


        if($remed){
            return redirect('/kelola-ujian')->with('success', 'Data telah berhasil ditambahkan!');
        }
    }

    public function edit($id)
    {
        $ujianRemedial  = UjianRemedial::find(base64_decode($id));
        $ujian          = Ujian::where('id_ujian', $ujianRemedial->id_ujian)->get()->first();
        $wp             = $this->timetosec($ujianRemedial->waktu_pengerjaan);
        $soalRemed      = SoalRemed::where('id_ujian_remedial', '=', $ujianRemedial->id_ujian_remedial)->get();

        if(count($soalRemed) > 0){
            foreach($soalRemed as $s => $isi){
                $jawaban[] = explode(' ,  ', $isi->bankSoal->jawaban);
            }
            foreach($jawaban as $j => $jajang){
                foreach($jajang as $sj => $ssj){
                    if($ssj == ''){
                        unset($jawaban[$j][$ssj]);
                    }
                }
                $jawabanAsli[] = implode(' ,  ', $jawaban[$j]);
            }
        }

        // return $soalRemed;
        return view('admin.kelola-remed.edit', compact('ujian', 'ujianRemedial', 'wp', 'soalRemed', 'jawaban', 'jawabanAsli'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ujianRemedial  = UjianRemedial::find(base64_decode($id));

        $ujianRemedial->waktu_pengerjaan    = gmdate("H:i:s", $request['waktu_pengerjaan']);
        $ujianRemedial->catatan             = $request['catatan'];

        if($ujianRemedial->save()){
            return redirect('/kelola-ujian')->with('success', 'Data berhasil diubah!');
        }
        return redirect('/kelola-ujian')->with('error', 'Data gagal diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
