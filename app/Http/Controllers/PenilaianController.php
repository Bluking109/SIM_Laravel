<?php

namespace App\Http\Controllers;

use App\Exports\DetailExport;
use App\Exports\PenilaianExport;
use App\Http\Request\StorePenilaianRequest;
use App\Models\Pengelompokkan;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Response;

class PenilaianController extends Controller
{

    public function index(Request $request)
    {
        $cari = $request->input('cari');
        $prodi = $request->input('ddProdi');

        // Retrieve prodi options
        $prodiOptions = DB::table('sia_msprodi')->get();

        // Mengambil mhs_id setiap mahasiswa
        $mahasiswa = DB::table('sia_msmahasiswa as m')
            ->join('sia_mskonsentrasi as k', 'm.kon_id', '=', 'k.kon_id')
            ->join('sia_msprodi as p', 'k.pro_id', '=', 'p.pro_id')
            ->join('sim_dtkelompokprakerin as d', 'm.mhs_id', '=', 'd.mhs_id')
            ->join('sim_mspembimbingindustri as pin', 'd.pin_id', '=', 'pin.pin_id')
            ->join('sia_msindustriprakerin as i', 'pin.ipr_id', '=', 'i.ipr_id')
            ->select('m.mhs_id', 'm.mhs_nama', 'm.mhs_angkatan', 'm.mhs_jenis_kelamin', 'p.pro_nama', 'p.pro_singkatan', 'i.ipr_nama', 'd.kel_departemen')
            ->whereNotNull('d.mhs_id')
            ->whereRaw("LEFT(SUBSTRING(m.kel_id, 7, 1), 1) = 3")
            ->where('m.mhs_status_kuliah', '=', 'Aktif');

        // Melakukan pencarian jika parameter pencarian tidak kosong
        if ($cari) {
            $mahasiswa->where('m.mhs_nama', 'like', '%' . $cari . '%')
                ->orWhere('m.mhs_id', 'like', '%' . $cari . '%');
        }

        if ($prodi) {
            $mahasiswa->where('p.pro_id', '=', $prodi);
        }
        $mahasiswa = $mahasiswa->paginate(10);

        //mengambil nilai seluruh bulan dari setiap mahasiswa untuk di rata-rata

        $laporan = collect();

        foreach ($mahasiswa as $item) {
            $nilai = DB::table('sim_trspenilaian as p')
                ->join('sia_msmahasiswa as mhs', 'p.mhs_id', '=', 'mhs.mhs_id')
                ->join('sim_dtkelompokprakerin as d', 'mhs.mhs_id', '=', 'd.mhs_id')
                ->select(
                    'p.pnl_id',
                    'p.mhs_id',
                    'p.pnl_pengetahuan_kerja',
                    'p.pnl_kualitas_kerja',
                    'p.pnl_kecepatan_kerja',
                    'p.pnl_sikap_perilaku',
                    'p.pnl_kreatifitas_kerja_sama',
                    'p.pnl_leadership',
                    'p.pnl_beradaptasi',
                    'p.pnl_penanganan_masalah',
                    'p.pnl_ulasan'
                )
                ->where('p.mhs_id', '=', $item->mhs_id)
                ->get();

            $jml = $nilai->count();

            $rata_pengetahuanFinal = ($jml > 0) ? round($nilai->avg('pnl_pengetahuan_kerja'), 2) : 0;
            $rata_kualitasFinal = ($jml > 0) ? round($nilai->avg('pnl_kualitas_kerja'), 2) : 0;
            $rata_kecepatanFinal = ($jml > 0) ? round($nilai->avg('pnl_kecepatan_kerja'), 2) : 0;
            $rata_sikapFinal = ($jml > 0) ? round($nilai->avg('pnl_sikap_perilaku'), 2) : 0;
            $rata_kreatifitasFinal = ($jml > 0) ? round($nilai->avg('pnl_kreatifitas_kerja_sama'), 2) : 0;
            $rata_leadershipFinal = ($jml > 0) ? round($nilai->avg('pnl_leadership'), 2) : 0;
            $rata_beradaptasiFinal = ($jml > 0) ? round($nilai->avg('pnl_beradaptasi'), 2) : 0;
            $rata_penangananFinal = ($jml > 0) ? round($nilai->avg('pnl_penanganan_masalah'), 2) : 0;

            $laporan->push([
                'mhs_id' => $item->mhs_id,
                'mhs_nama' => $item->mhs_nama,
                'pro_nama' => $item->pro_nama,
                'ipr_nama' => $item->ipr_nama,
                'kel_departemen' => $item->kel_departemen,
                'rata_pengetahuan' => $rata_pengetahuanFinal,
                'rata_kualitas' => $rata_kualitasFinal,
                'rata_kecepatan' => $rata_kecepatanFinal,
                'rata_sikap' => $rata_sikapFinal,
                'rata_kreatifitas' => $rata_kreatifitasFinal,
                'rata_leadership' => $rata_leadershipFinal,
                'rata_beradaptasi' => $rata_beradaptasiFinal,
                'rata_penanganan' => $rata_penangananFinal,
            ]);
        }
        $mahasiswa->appends(['cari' => $cari, 'ddProdi' => $prodi]);

        return view("Admin.Penilaian.index", [
            'laporan' => $laporan,
            'cari' => $cari,
            'mahasiswa' => $mahasiswa,
            'prodiOptions' => $prodiOptions,
        ]);
    }

    public function indexSekProd(Request $request)
    {
        $cari = $request->input('cari');
        $prodi = $request->input('ddProdi');

        $pro = session('usr_prodi');
        // Retrieve prodi options
        $prodiOptions = DB::table('sia_msprodi')->get();

        // Mengambil mhs_id setiap mahasiswa
        $mahasiswa = DB::table('sia_msmahasiswa as m')
            ->join('sia_mskonsentrasi as k', 'm.kon_id', '=', 'k.kon_id')
            ->join('sia_msprodi as p', 'k.pro_id', '=', 'p.pro_id')
            ->join('sim_dtkelompokprakerin as d', 'm.mhs_id', '=', 'd.mhs_id')
            ->join('sim_mspembimbingindustri as pin', 'd.pin_id', '=', 'pin.pin_id')
            ->join('sia_msindustriprakerin as i', 'pin.ipr_id', '=', 'i.ipr_id')
            ->select('m.mhs_id', 'm.mhs_nama', 'm.mhs_angkatan', 'm.mhs_jenis_kelamin', 'p.pro_nama', 'p.pro_singkatan', 'i.ipr_nama', 'd.kel_departemen')
            ->whereNotNull('d.mhs_id')
            ->whereRaw("LEFT(SUBSTRING(m.kel_id, 7, 1), 1) = 3")
            ->where('m.mhs_status_kuliah', '=', 'Aktif')
            ->where('p.pro_singkatan', '=', $pro);

        // Melakukan pencarian jika parameter pencarian tidak kosong
        if ($cari) {
            $mahasiswa->where('m.mhs_nama', 'like', '%' . $cari . '%')
                ->orWhere('m.mhs_id', 'like', '%' . $cari . '%');
        }

        if ($prodi) {
            $mahasiswa->where('p.pro_id', '=', $prodi);
        }
        $mahasiswa = $mahasiswa->paginate(10);

        //mengambil nilai seluruh bulan dari setiap mahasiswa untuk di rata-rata

        $laporan = collect();

        foreach ($mahasiswa as $item) {
            $nilai = DB::table('sim_trspenilaian as p')
                ->join('sia_msmahasiswa as mhs', 'p.mhs_id', '=', 'mhs.mhs_id')
                ->join('sim_dtkelompokprakerin as d', 'mhs.mhs_id', '=', 'd.mhs_id')
                ->select(
                    'p.pnl_id',
                    'p.mhs_id',
                    'p.pnl_pengetahuan_kerja',
                    'p.pnl_kualitas_kerja',
                    'p.pnl_kecepatan_kerja',
                    'p.pnl_sikap_perilaku',
                    'p.pnl_kreatifitas_kerja_sama',
                    'p.pnl_leadership',
                    'p.pnl_beradaptasi',
                    'p.pnl_penanganan_masalah',
                    'p.pnl_ulasan'
                )
                ->where('p.mhs_id', '=', $item->mhs_id)
                ->get();

            $jml = $nilai->count();

            $rata_pengetahuanFinal = ($jml > 0) ? round($nilai->avg('pnl_pengetahuan_kerja'), 2) : 0;
            $rata_kualitasFinal = ($jml > 0) ? round($nilai->avg('pnl_kualitas_kerja'), 2) : 0;
            $rata_kecepatanFinal = ($jml > 0) ? round($nilai->avg('pnl_kecepatan_kerja'), 2) : 0;
            $rata_sikapFinal = ($jml > 0) ? round($nilai->avg('pnl_sikap_perilaku'), 2) : 0;
            $rata_kreatifitasFinal = ($jml > 0) ? round($nilai->avg('pnl_kreatifitas_kerja_sama'), 2) : 0;
            $rata_leadershipFinal = ($jml > 0) ? round($nilai->avg('pnl_leadership'), 2) : 0;
            $rata_beradaptasiFinal = ($jml > 0) ? round($nilai->avg('pnl_beradaptasi'), 2) : 0;
            $rata_penangananFinal = ($jml > 0) ? round($nilai->avg('pnl_penanganan_masalah'), 2) : 0;

            $laporan->push([
                'mhs_id' => $item->mhs_id,
                'mhs_nama' => $item->mhs_nama,
                'pro_nama' => $item->pro_nama,
                'ipr_nama' => $item->ipr_nama,
                'kel_departemen' => $item->kel_departemen,
                'rata_pengetahuan' => $rata_pengetahuanFinal,
                'rata_kualitas' => $rata_kualitasFinal,
                'rata_kecepatan' => $rata_kecepatanFinal,
                'rata_sikap' => $rata_sikapFinal,
                'rata_kreatifitas' => $rata_kreatifitasFinal,
                'rata_leadership' => $rata_leadershipFinal,
                'rata_beradaptasi' => $rata_beradaptasiFinal,
                'rata_penanganan' => $rata_penangananFinal,
            ]);
        }
        $mahasiswa->appends(['cari' => $cari, 'ddProdi' => $prodi]);

        return view("Admin.Penilaian.index", [
            'laporan' => $laporan,
            'cari' => $cari,
            'mahasiswa' => $mahasiswa,
            'prodiOptions' => $prodiOptions,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $penilaian = Penilaian::join('sia_msmahasiswa as m', 'sim_trspenilaian.mhs_id', '=', 'm.mhs_id')
            ->join('sia_mskonsentrasi as k', 'm.kon_id', '=', 'k.kon_id')
            ->join('sia_msprodi as pro', 'k.pro_id', '=', 'pro.pro_id')
            ->join('sim_mspembimbingindustri as pin', 'sim_trspenilaian.pin_id', '=', 'pin.pin_id')
            ->join('sia_msindustriprakerin as i', 'pin.ipr_id', '=', 'i.ipr_id')
            ->where('sim_trspenilaian.pnl_id', '=', $id)
            ->select(
                'sim_trspenilaian.mhs_id',
                'sim_trspenilaian.pnl_periode',
                'sim_trspenilaian.pnl_pengetahuan_kerja',
                'sim_trspenilaian.pnl_kualitas_kerja',
                'sim_trspenilaian.pnl_kecepatan_kerja',
                'sim_trspenilaian.pnl_sikap_perilaku',
                'sim_trspenilaian.pnl_kreatifitas_kerja_sama',
                'sim_trspenilaian.pnl_leadership',
                'sim_trspenilaian.pnl_beradaptasi',
                'sim_trspenilaian.pnl_penanganan_masalah',
                'sim_trspenilaian.pnl_ulasan',
                'sim_trspenilaian.pnl_id',
                'pin.pin_nama',
                'i.ipr_nama',
                'i.ipr_grup',
                'm.mhs_nama',
                'pro.pro_singkatan',
                // Tambahkan kolom rata nilai dengan menggunakan AVG()
                DB::raw('(sim_trspenilaian.pnl_pengetahuan_kerja + sim_trspenilaian.pnl_kualitas_kerja + sim_trspenilaian.pnl_kecepatan_kerja 
                + sim_trspenilaian.pnl_sikap_perilaku + sim_trspenilaian.pnl_kreatifitas_kerja_sama + sim_trspenilaian.pnl_leadership 
                + sim_trspenilaian.pnl_beradaptasi + sim_trspenilaian.pnl_penanganan_masalah) / 8 as rata_nilai')
            )
            ->get();

        return new Response(view('Admin.Penilaian.detail', ['penilaian' => $penilaian]));
    }

    public function detailLaporan($id)
    {
        $penilaian = Penilaian::join('sia_msmahasiswa as m', 'sim_trspenilaian.mhs_id', '=', 'm.mhs_id')
            ->join('sia_mskonsentrasi as k', 'm.kon_id', '=', 'k.kon_id')
            ->join('sia_msprodi as pro', 'k.pro_id', '=', 'pro.pro_id')
            ->join('sim_mspembimbingindustri as pin', 'sim_trspenilaian.pin_id', '=', 'pin.pin_id')
            ->join('sia_msindustriprakerin as i', 'pin.ipr_id', '=', 'i.ipr_id')
            ->where('sim_trspenilaian.mhs_id', '=', $id)
            ->select(
                'sim_trspenilaian.mhs_id',
                'sim_trspenilaian.pnl_periode',
                'sim_trspenilaian.pnl_pengetahuan_kerja',
                'sim_trspenilaian.pnl_kualitas_kerja',
                'sim_trspenilaian.pnl_kecepatan_kerja',
                'sim_trspenilaian.pnl_sikap_perilaku',
                'sim_trspenilaian.pnl_kreatifitas_kerja_sama',
                'sim_trspenilaian.pnl_leadership',
                'sim_trspenilaian.pnl_beradaptasi',
                'sim_trspenilaian.pnl_penanganan_masalah',
                'sim_trspenilaian.pnl_ulasan',
                'sim_trspenilaian.pnl_id',
                'pin.pin_nama',
                'i.ipr_nama',
                'i.ipr_grup',
                'm.mhs_nama',
                'pro.pro_singkatan',
                // Tambahkan kolom rata nilai dengan menggunakan AVG()
                DB::raw('(sim_trspenilaian.pnl_pengetahuan_kerja + sim_trspenilaian.pnl_kualitas_kerja + sim_trspenilaian.pnl_kecepatan_kerja 
                + sim_trspenilaian.pnl_sikap_perilaku + sim_trspenilaian.pnl_kreatifitas_kerja_sama + sim_trspenilaian.pnl_leadership 
                + sim_trspenilaian.pnl_beradaptasi + sim_trspenilaian.pnl_penanganan_masalah) / 8 as rata_nilai')
            )
            ->get();

        return view('Admin.Penilaian.detailLaporan', ['penilaian' => $penilaian, 'id' => $id]);
    }

    //Pembimbing

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function firstPage()
    {
        return new Response(view('Pembimbing.Penilaian.firstPage'));
    }

    public function create(Request $request)
    {
        $username = session('username');
        //dd($username);

        //LIST MAHASISWA BY PEMBIMBING
        $mahasiswa = DB::table('sim_dtkelompokprakerin')
            ->join('sia_msmahasiswa as m', 'sim_dtkelompokprakerin.mhs_id', '=', 'm.mhs_id')
            ->where('sim_dtkelompokprakerin.pin_id', $username)
            ->where('sim_dtkelompokprakerin.kel_status', 'Aktif')
            ->select('sim_dtkelompokprakerin.mhs_id', 'm.mhs_nama')
            ->get();

        $profil = DB::table('sim_dtkelompokprakerin as d')
            ->join('sia_msmahasiswa as p', 'd.mhs_id', '=', 'p.mhs_id')
            ->join('sia_mskonsentrasi as k', 'p.kon_id', '=', 'k.kon_id')
            ->join('sia_msprodi as pro', 'k.pro_id', '=', 'pro.pro_id')
            ->join('sim_mspembimbingindustri as pin', 'd.pin_id', '=', 'pin.pin_id')
            ->join('sia_msindustriprakerin as i', 'pin.ipr_id', '=', 'i.ipr_id')
            ->select('p.mhs_id', 'p.mhs_nama', 'pro_nama', 'i.ipr_nama', 'd.kel_departemen', 'd.kel_nama')
            ->where('d.pin_id', '=', $username)
            ->get();

        $jenis = DB::table('sim_mspenilaian')->distinct()->pluck('nil_jenis');
        $karakteristik = DB::table('sim_mspenilaian')->pluck('nil_karakteristik');
        
        // Simpan pin_id dalam sesi
        $request->session()->put('pin_id', $username);

        return view('Pembimbing.Penilaian.create', ['mahasiswa' => $mahasiswa, 'profile' => $profil, 
                                                    'jenis' => $jenis, 'karakteristik' => $karakteristik]);
    }
    public function getMahasiswaData(Request $request)
    {
        // Ambil ID mahasiswa dari request
        $mhsId = $request->input('mhs_id');

        // Lakukan query untuk mendapatkan data mahasiswa berdasarkan ID
        $mahasiswaData = DB::table('sim_dtkelompokprakerin as d')
            ->select('m.mhs_id', 'm.mhs_nama', 'p.pro_nama', 'd.kel_departemen')
            ->leftJoin('sia_msmahasiswa as m', 'd.mhs_id', '=', 'm.mhs_id')
            ->leftJoin('sia_mskonsentrasi as k', 'm.kon_id', '=', 'k.kon_id')
            ->leftJoin('sia_msprodi as p', 'k.pro_id', '=', 'p.pro_id')
            ->where('m.mhs_id', '=', $mhsId)
            ->first(); // Mengambil data pertama yang cocok

        // Check if the Prodi model is found
        if ($mahasiswaData) {
            return response()->json(['pro_nama' => $mahasiswaData->pro_nama, 'mhs_id' => $mahasiswaData->mhs_id, 'kel_departemen' => $mahasiswaData->kel_departemen]);
        } else {
            return response()->json(['error' => 'Mahasiswa not found'], 404);
        }
    }

    public function export(Request $request)
    {
        $cari = $request->input('cari');
        $prodi = $request->input('ddProdi'); // Ubah nama parameter

        //$angkatan = $request->input('ddAngkatan'); // Ubah nama parameter

        //mengambil mhs_id setiap mahasiswa
        $mahasiswa = DB::table('sia_msmahasiswa as m')
            ->join('sia_mskonsentrasi as k', 'm.kon_id', '=', 'k.kon_id')
            ->join('sia_msprodi as p', 'k.pro_id', '=', 'p.pro_id')
            ->join('sim_dtkelompokprakerin as d', 'm.mhs_id', '=', 'd.mhs_id')
            ->join('sim_mspembimbingindustri as pin', 'd.pin_id', '=', 'pin.pin_id')
            ->join('sia_msindustriprakerin as i', 'pin.ipr_id', '=', 'i.ipr_id')
            ->select('m.mhs_id', 'm.mhs_nama', 'm.mhs_angkatan', 'm.mhs_jenis_kelamin', 'p.pro_id', 'i.ipr_nama', 'd.kel_departemen')
            ->whereNotNull('d.mhs_id')
            ->where('d.kel_status', '=', 'Aktif');

        // Add search condition
        if ($cari) {
            $mahasiswa->where(function ($query) use ($cari) {
                $query->where('m.mhs_nama', 'LIKE', '%' . $cari . '%');
            });
        } else if ($prodi) {
            $mahasiswa->where(function ($query) use ($prodi) {
                $query->where('p.pro_id', '=', $prodi);
            });
        }

        $mahasiswa = $mahasiswa->get();

        //mengambil nilai seluruh bulan dari setiap mahasiswa untuk di rata-rata

        $laporan = collect();

        foreach ($mahasiswa as $item) {
            $nilai = DB::table('sim_trspenilaian as p')
                ->join('sia_msmahasiswa as mhs', 'p.mhs_id', '=', 'mhs.mhs_id')
                ->join('sim_dtkelompokprakerin as d', 'mhs.mhs_id', '=', 'd.mhs_id')
                ->select(
                    'p.pnl_id',
                    'p.mhs_id',
                    'p.pnl_pengetahuan_kerja',
                    'p.pnl_kualitas_kerja',
                    'p.pnl_kecepatan_kerja',
                    'p.pnl_sikap_perilaku',
                    'p.pnl_kreatifitas_kerja_sama',
                    'p.pnl_leadership',
                    'p.pnl_beradaptasi',
                    'p.pnl_penanganan_masalah',
                    'p.pnl_ulasan'
                )
                ->where('p.mhs_id', '=', $item->mhs_id)
                ->get();

            $jml = $nilai->count();

            $rata_pengetahuanFinal = ($jml > 0) ? round($nilai->avg('pnl_pengetahuan_kerja'), 2) : 0;
            $rata_kualitasFinal = ($jml > 0) ? round($nilai->avg('pnl_kualitas_kerja'), 2) : 0;
            $rata_kecepatanFinal = ($jml > 0) ? round($nilai->avg('pnl_kecepatan_kerja'), 2) : 0;
            $rata_sikapFinal = ($jml > 0) ? round($nilai->avg('pnl_sikap_perilaku'), 2) : 0;
            $rata_kreatifitasFinal = ($jml > 0) ? round($nilai->avg('pnl_kreatifitas_kerja_sama'), 2) : 0;
            $rata_leadershipFinal = ($jml > 0) ? round($nilai->avg('pnl_leadership'), 2) : 0;
            $rata_beradaptasiFinal = ($jml > 0) ? round($nilai->avg('pnl_beradaptasi'), 2) : 0;
            $rata_penangananFinal = ($jml > 0) ? round($nilai->avg('pnl_penanganan_masalah'), 2) : 0;

            $laporan->push([
                'mhs_id' => $item->mhs_id,
                'mhs_nama' => $item->mhs_nama,
                'ipr_nama' => $item->ipr_nama,
                'kel_departemen' => $item->kel_departemen,
                'rata_pengetahuan' => $rata_pengetahuanFinal,
                'rata_kualitas' => $rata_kualitasFinal,
                'rata_kecepatan' => $rata_kecepatanFinal,
                'rata_sikap' => $rata_sikapFinal,
                'rata_kreatifitas' => $rata_kreatifitasFinal,
                'rata_leadership' => $rata_leadershipFinal,
                'rata_beradaptasi' => $rata_beradaptasiFinal,
                'rata_penanganan' => $rata_penangananFinal,
                'pro_id' => $item->pro_id
            ]);
        }

        // Filter hasil pencarian pada koleksi $laporan
        // Filter hasil pencarian pada koleksi $laporan
        if ($cari) {
            $laporan = $laporan->filter(function ($item) use ($cari) {
                return stripos($item['mhs_nama'], $cari) !== false;
            });
        } else if ($prodi) {
            $laporan = $laporan->filter(function ($item) use ($prodi) {
                return $item['pro_id'] == $prodi;
            });
        }


        $export = new PenilaianExport($laporan);
        return Excel::download($export, 'Laporan.xlsx');
    }

    public function export2($id)
    {
        $penilaian = Penilaian::join('sia_msmahasiswa as m', 'sim_trspenilaian.mhs_id', '=', 'm.mhs_id')
            ->join('sia_mskonsentrasi as k', 'm.kon_id', '=', 'k.kon_id')
            ->join('sia_msprodi as pro', 'k.pro_id', '=', 'pro.pro_id')
            ->join('sim_mspembimbingindustri as pin', 'sim_trspenilaian.pin_id', '=', 'pin.pin_id')
            ->join('sia_msindustriprakerin as i', 'pin.ipr_id', '=', 'i.ipr_id')
            ->where('sim_trspenilaian.mhs_id', '=', $id)
            ->select(
                'sim_trspenilaian.mhs_id',
                'm.mhs_nama',
                'i.ipr_nama',
                'sim_trspenilaian.pnl_periode',
                'sim_trspenilaian.pnl_pengetahuan_kerja',
                'sim_trspenilaian.pnl_kualitas_kerja',
                'sim_trspenilaian.pnl_kecepatan_kerja',
                'sim_trspenilaian.pnl_sikap_perilaku',
                'sim_trspenilaian.pnl_kreatifitas_kerja_sama',
                'sim_trspenilaian.pnl_leadership',
                'sim_trspenilaian.pnl_beradaptasi',
                'sim_trspenilaian.pnl_penanganan_masalah',
                'sim_trspenilaian.pnl_ulasan',
                // Tambahkan kolom rata nilai dengan menggunakan AVG()
                DB::raw('(sim_trspenilaian.pnl_pengetahuan_kerja + sim_trspenilaian.pnl_kualitas_kerja + sim_trspenilaian.pnl_kecepatan_kerja 
                + sim_trspenilaian.pnl_sikap_perilaku + sim_trspenilaian.pnl_kreatifitas_kerja_sama + sim_trspenilaian.pnl_leadership 
                + sim_trspenilaian.pnl_beradaptasi + sim_trspenilaian.pnl_penanganan_masalah) / 8 as rata_nilai')
            );
        $data = $penilaian->get();
        return Excel::download(new DetailExport($data), 'DetailLaporan.xlsx');
    }

    public function store(Request $request)
    {
        try {
            $pin_id = $request->session()->get('pin_id');

            $request->validate([
                'mhs_id' => 'required', // Mahasiswa harus dipilih
                'pnl_periode' => 'required', // Periode penilaian harus dipilih
                // 'pnl_pengetahuan_kerja' => 'required', // Pengetahuan kerja harus dipilih dan berupa angka antara 1 dan 10
                // 'pnl_kecepatan_kerja' => 'required', // Kecepatan kerja harus dipilih dan berupa angka antara 1 dan 10
                // 'pnl_sikap_perilaku' => 'required', // Sikap dan perilaku harus dipilih dan berupa angka antara 1 dan 10
                // 'pnl_kualitas_kerja' => 'required', // Kualitas kerja harus dipilih dan berupa angka antara 1 dan 10
                // 'pnl_kreatifitas_kerja_sama' => 'required', // Kreativitas dan kerjasama harus dipilih dan berupa angka antara 1 dan 10
                // 'pnl_leadership' => 'required', // Kemampuan leadership harus dipilih dan berupa angka antara 1 dan 10
                // 'pnl_penanganan_masalah' => 'required', // Kemampuan menangani masalah harus dipilih dan berupa angka antara 1 dan 10
                // 'pnl_beradaptasi' => 'required', // Kemampuan beradaptasi harus dipilih dan berupa angka antara 1 dan 10
                // 'pnl_ulasan' => 'required', // Catatan untuk mahasiswa harus diisi
            ]);

            $penilaianData = $request->all();

            // Menetapkan nilai pin_id ke data penilaian
            $penilaianData['pin_id'] = $pin_id;

            // Process and store the data
            $penilaian = Penilaian::create($penilaianData);

            if ($penilaian) {
                return Redirect(route('Pembimbing.Penilaian.firstPage'))->with('SuccessMessage', 'Penilaian Berhasil diTambahkan!');
            } else {
                throw new \Exception('Failed to add Penilaian. Required fields are not filled.');
            }
        } catch (\Exception $e) {
            return redirect(route('Pembimbing.Penilaian.create'))->with('Error = ', $e->getMessage());
        }
    }
}
