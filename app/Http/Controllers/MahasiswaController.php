<?php

namespace App\Http\Controllers;


use App\Models\Logbook;
use App\Models\Mahasiswa;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\Readline\Hoa\Console;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $item = 20;
        $cari = $request->has('cari') ? $request->input('cari') : ' ';
        $n2 = '';
        $n3 = '';
        $n4 = '';

        if (session('usr_role') === 'PEMBIMBING INDUSTRI') {
            $n4 = session('username');
          
        } else if (session('usr_role') === 'SEKRETARIS PRODI') {
            $n2 = session('usr_prodi');
            
        }

        // dd([
        //     'cek' => 'criteria',
        //     'cari' => $cari,
        //     'n2' => $n2,
        //     'n3' => $n3,
        //     'n4' => $n4
        // ]);

        $mahasiswa = DB::table('sia_msmahasiswa as m')
            ->leftJoin('sia_mskonsentrasi as k', 'm.kon_id', '=', 'k.kon_id')
            ->leftJoin('sia_msprodi as p', 'k.pro_id', '=', 'p.pro_id')
            ->leftJoin('sim_dtkelompokprakerin as d', 'm.mhs_id', '=', 'd.mhs_id')
            ->select(
                'm.mhs_id',
                'm.mhs_nama',
                'm.mhs_angkatan',
                'm.mhs_jenis_kelamin',
                'p.pro_singkatan',
                'm.mhs_status_kuliah',
                'm.kel_id',
                'd.pin_id'
            )
            ->whereRaw("LEFT(SUBSTRING(m.kel_id, 7, 1), 1) = 3")
            ->where('m.mhs_status_kuliah', '=', 'Aktif')
            ->where(function ($query) use ($cari) {
                $query->where(DB::raw('UPPER(m.mhs_id)'), 'like', '%' . strtoupper($cari) . '%')
                    ->orWhere(DB::raw('UPPER(m.mhs_nama)'), 'like', '%' . strtoupper($cari) . '%')
                    ->orWhere(DB::raw('UPPER(m.mhs_jenis_kelamin)'), 'like', '%' . strtoupper($cari) . '%')
                    ->orWhere(DB::raw('UPPER(p.pro_singkatan)'), '=', $cari);
            })
            ->where(function ($query) use ($n2, $n3, $n4) {
                $query->where('p.pro_singkatan', '=', $n2)
                    ->orWhere('m.mhs_angkatan', '=', $n3)
                    ->orWhere('d.pin_id', '=', $n4);
            })
            ->paginate($item);


        if (session('usr_role') === 'ADMIN') {
            // dd([
            //     'cek' => 'admin',
            //     'cari' => $cari,
            //     'n2' => $n2,
            //     'n3' => $n3,
            //     'n4' => $n4
            // ]);

            
            $mahasiswa = DB::table('sia_msmahasiswa as m')
            ->leftJoin('sia_mskonsentrasi as k', 'm.kon_id', '=', 'k.kon_id')
            ->leftJoin('sia_msprodi as p', 'k.pro_id', '=', 'p.pro_id')
            ->leftJoin('sim_dtkelompokprakerin as d', 'm.mhs_id', '=', 'd.mhs_id')
            ->select(
                'm.mhs_id',
                'm.mhs_nama',
                'm.mhs_angkatan',
                'm.mhs_jenis_kelamin',
                'p.pro_singkatan',
                'm.mhs_status_kuliah',
                'm.kel_id',
                'd.pin_id'
            )
            ->whereRaw("LEFT(SUBSTRING(m.kel_id, 7, 1), 1) = 3")
            ->where('m.mhs_status_kuliah', '=', 'Aktif')
            ->where(function ($query) use ($cari) {
                $query->where(DB::raw('UPPER(m.mhs_id)'), 'like', '%' . strtoupper($cari) . '%')
                    ->orWhere(DB::raw('UPPER(m.mhs_nama)'), 'like', '%' . strtoupper($cari) . '%')
                    ->orWhere(DB::raw('UPPER(m.mhs_jenis_kelamin)'), 'like', '%' . strtoupper($cari) . '%')
                    ->orWhere(DB::raw('UPPER(p.pro_singkatan)'), '=', $cari);
            })
            ->distinct()

            ->paginate($item);

        }

     
        return view("Admin.Mahasiswa.index", ['mahasiswa' => $mahasiswa, 'cari' => $cari]);
    }

    public function detail($id)
    {
        if(session('usr_role') == 'MAHASISWA'){
            $id = session('username');

        }
        // $mahasiswa = DB::table('sia_msmahasiswa')
        //     ->where('mhs_id', $username)->first();

        // $mhs_id = $mahasiswa->mhs_id;
        $logbookData = DB::table('sia_msmahasiswa as m')
        ->join('sia_mskonsentrasi as k', 'm.kon_id', '=', 'k.kon_id')
        ->join('sia_msprodi as p', 'k.pro_id', '=', 'p.pro_id')
        ->join('sim_trlogbook as log', 'm.mhs_id', '=', 'log.mhs_id')
        ->join('sim_mspembimbingindustri as pin', 'log.pin_id', '=', 'pin.pin_id')
        ->join('sia_msindustriprakerin as i', 'pin.ipr_id', '=', 'i.ipr_id')
        ->select(
            'm.mhs_id',
            'm.mhs_nama',
            'p.pro_nama',
            'log.create_at',
            'log.log_status',
            'log.log_minggu',
            'log.log_mulai',
            'log.log_selesai',
            'log.log_hari_1',
            'log.log_hari_2',
            'log.log_hari_3',
            'log.log_hari_4',
            'log.log_hari_5',
            'log.log_hari_6',
            'log.log_hari_7',
            'pin.pin_nama',
            'log.log_id',
            'i.ipr_nama',
            'i.ipr_grup'
        )
        ->where('log.mhs_id', '=', $id)
        ->where('log.log_status', '!=', 'Draft')
        ->get();

        $penilaianData = DB::table('sim_trspenilaian as p')
            ->join('sia_msmahasiswa as m', 'p.mhs_id', '=', 'm.mhs_id')
            ->join('sia_mskonsentrasi as k', 'm.kon_id', '=', 'k.kon_id')
            ->join('sia_msprodi as pro', 'k.pro_id', '=', 'pro.pro_id')
            ->join('sim_mspembimbingindustri as pin', 'p.pin_id', '=', 'pin.pin_id')
            ->join('sia_msindustriprakerin as i', 'pin.ipr_id', '=', 'i.ipr_id')
            ->where('p.mhs_id', '=', $id)
            ->select(
                'p.mhs_id',
                'p.pnl_periode',
                'p.pnl_pengetahuan_kerja',
                'p.pnl_kualitas_kerja',
                'p.pnl_kecepatan_kerja',
                'p.pnl_sikap_perilaku',
                'p.pnl_kreatifitas_kerja_sama',
                'p.pnl_leadership',
                'p.pnl_beradaptasi',
                'p.pnl_penanganan_masalah',
                'p.pnl_ulasan',
                'p.pnl_id',
                'i.ipr_nama',
                'pro.pro_singkatan',
                'm.mhs_nama',
                'pin.pin_nama',
                'i.ipr_grup',
                // Tambahkan kolom rata nilai dengan menggunakan AVG()
                DB::raw('(p.pnl_pengetahuan_kerja + p.pnl_kualitas_kerja + p.pnl_kecepatan_kerja 
                + p.pnl_sikap_perilaku + p.pnl_kreatifitas_kerja_sama + p.pnl_leadership 
                + p.pnl_beradaptasi + p.pnl_penanganan_masalah) / 8 as rata_nilai')
            )
            ->get();


            $mahasiswa = DB::table('sim_dtkelompokprakerin as d')
            ->leftJoin('sim_trspenilaian as pnl', 'd.mhs_id', '=', 'pnl.mhs_id')
            ->leftJoin('sim_trlogbook as log', 'd.mhs_id', '=', 'log.mhs_id')
            ->leftJoin('sia_msmahasiswa as m', 'd.mhs_id', '=', 'm.mhs_id')
            ->leftJoin('sia_mskonsentrasi as k', 'm.kon_id', '=', 'k.kon_id')
            ->leftJoin('sia_msprodi as p', 'k.pro_id', '=', 'p.pro_id')
            ->leftJoin('sim_mspembimbingindustri as pin', 'd.pin_id', '=', 'pin.pin_id')
            ->leftJoin('sia_msindustriprakerin as i', 'pin.ipr_id', '=', 'i.ipr_id')
            ->select('m.mhs_id', 'm.mhs_nama', 'p.pro_nama', 'pin.pin_nama', 'i.ipr_nama', 'i.ipr_grup', 'd.kel_nama', 'd.kel_departemen', 'd.kel_status')
            ->where('m.mhs_id', $id)
            ->first();
        
        return view('Admin.Mahasiswa.detail', ['logbookData' => $logbookData, 'penilaianData' => $penilaianData, 'mahasiswa' => $mahasiswa]);
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
        //
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
