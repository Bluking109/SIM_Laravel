<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengelompokkan;
use App\Models\Mahasiswa;
use App\Models\Pembimbing;
use Illuminate\Support\Facades\DB;

class PengelompokkanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = 10;

        $pengelompokkan = DB::table('sim_dtkelompokprakerin as k')
            ->select(
                DB::raw('COUNT(DISTINCT k.mhs_id) as total_mhs'),
                DB::raw('MAX(p.pin_nama) as pin_nama'),
                'k.kel_departemen',
                'k.kel_nama',
                'k.pin_id'
            )
            ->join('sim_mspembimbingindustri as p', 'k.pin_id', '=', 'p.pin_id')
            ->join('sia_msmahasiswa as m', 'k.mhs_id', '=', 'm.mhs_id')
            ->where('k.kel_status', '=', 'Aktif')
            ->groupBy('k.pin_id', 'k.kel_departemen', 'k.kel_nama')
            ->orderBy('k.pin_id')
            ->paginate($item);


        return view("Admin.Pengelompokkan.index", compact('pengelompokkan'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $tahunIni = date('Y');

        // $pembimbing = Pembimbing::orderBy('pin_nama', 'asc')->get()->pluck('pin_nama', 'pin_id');
        $pembimbing = Pembimbing::orderBy('pin_nama', 'asc')
            ->where('pin_status', '=', 'Aktif')
            ->whereNotIn('pin_id', function ($query) {
                $query->select('pin_id')
                    ->from('sim_dtkelompokprakerin');
            })
            ->get()
            ->pluck('pin_nama', 'pin_id');

        $cari = $request->input('cari');
        $mahasiswa = DB::table('sia_msmahasiswa as m')
            ->join('sia_mskonsentrasi as k', 'm.kon_id', '=', 'k.kon_id')
            ->join('sia_msprodi as p', 'k.pro_id', '=', 'p.pro_id')
            ->whereRaw("LEFT(SUBSTRING(m.kel_id, 7, 1), 1) = '3'")
            ->where('m.mhs_status_kuliah', 'Aktif')
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('sim_dtkelompokprakerin as dp')
                    ->whereRaw('dp.mhs_id = m.mhs_id');
            })
            ->where(function ($query) use ($cari) {
                $query->where(DB::raw('UPPER(m.mhs_id)'), 'like', '%' . strtoupper($cari) . '%')
                    ->orWhere(DB::raw('UPPER(m.mhs_nama)'), 'like', '%' . strtoupper($cari) . '%')
                    ->orWhere(DB::raw('UPPER(m.mhs_angkatan)'), 'like', '%' . strtoupper($cari) . '%')
                    ->orWhere(DB::raw('UPPER(m.mhs_jenis_kelamin)'), 'like', '%' . strtoupper($cari) . '%')
                    ->orWhere(DB::raw('UPPER(p.pro_singkatan)'), 'like', '%' . strtoupper($cari) . '%');
            })
            ->select('m.mhs_id', 'm.mhs_nama', 'm.mhs_angkatan', 'm.mhs_jenis_kelamin', 'p.pro_singkatan', 'm.mhs_status_kuliah', 'm.kel_id')
            
            ->paginate(10);

        return view('Admin.Pengelompokkan.create', ['pembimbing' => $pembimbing, 'mahasiswa' => $mahasiswa, 'cari' => $cari]);
    }


    public function store(Request $request)
    {
        $params = $request->all();

        // Ambil pin_id dan mhs_id dari input form
        $pinId = $request->input('pin_id');
        $mhsIds = $request->input('mhs_ids');
        $kel_nama = $request->input('kel_nama');
        $kel_departemen = $request->input('kel_departemen');

        // Lakukan pengecekan apakah kelompok sudah ada di tabel sim_dtkelompokprakerin dengan kel_status Aktif
        if (Pengelompokkan::where('kel_nama', $kel_nama)->where('kel_status', 'Aktif')->exists()) {
            return redirect(route('Admin.Pengelompokkan.create'))->with('error', 'Kelompok aktif sudah tersedia. Silakan buat Kelompok baru.');
        }

        //dd($mhsIds);
        // Tambahkan ke tabel pivot (sim_dtkelompokprakerin)
        foreach ($mhsIds as $mhsId) {
            Pengelompokkan::create([
                'pin_id' => $pinId,
                'mhs_id' => $mhsId,
                'kel_nama' => $kel_nama,
                'kel_departemen' => $kel_departemen,
                'kel_status' => 'Aktif',            //atributnya sesuai model
                // tambahkan kolom lain yang diperlukan
            ]);
        }

        // Redirect dengan pesan sukses
        return redirect(route('Admin.Pengelompokkan.index'))->with('success', 'Added!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = 10;
        $mahasiswa = DB::table('sia_msmahasiswa as m')
            ->join('sia_mskonsentrasi as k', 'm.kon_id', '=', 'k.kon_id')
            ->join('sia_msprodi as p', 'k.pro_id', '=', 'p.pro_id')
            ->whereRaw("LEFT(SUBSTRING(m.kel_id, 7, 1), 1) = '3'")
            ->where('m.mhs_status_kuliah', 'Aktif')
            ->where(function ($query) use ($id) {
                $query->whereIn('m.mhs_id', function ($subquery) use ($id) {
                    $subquery->select('mhs_id')
                        ->from('sim_dtkelompokprakerin')
                        ->where('kel_status', 'Aktif')
                        ->where('kel_nama', $id);
                })->orWhereNotIn('m.mhs_id', function ($subquery) {
                    $subquery->select('mhs_id')
                        ->from('sim_dtkelompokprakerin');
                });
            })
            ->select('m.mhs_id', 'm.mhs_nama', 'm.mhs_angkatan', 'm.mhs_jenis_kelamin', 'p.pro_singkatan', 'm.mhs_status_kuliah', 'm.kel_id')
            
            ->paginate($item);

        $pengelompokkan = Pengelompokkan::where('kel_nama', '=', $id)
            ->pluck('mhs_id')
            ->toArray();

        $kelompok1 = Pengelompokkan::where('kel_nama', '=', $id)->first();
        $pembimbing = Pembimbing::orderBy('pin_nama', 'asc')
            ->get()
            ->pluck('pin_nama', 'pin_id');

        return view('Admin.Pengelompokkan.edit', ['pembimbing' => $pembimbing, 'mahasiswa' => $mahasiswa, 'pengelompokkan' => $pengelompokkan, 'kelompok1' => $kelompok1]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $params = $request->all();

        // Ambil pin_id dan mhs_id dari input form
        $pinId = $request->input('pin_id');
        $mhsIds = $request->input('mhs_ids');
        $kel_nama = $request->input('kel_nama');
        $kel_departemen = $request->input('kel_departemen');

        //delete dahulu berdasarkan pin_id
        DB::table('sim_dtkelompokprakerin')
            ->where('kel_nama', '=', $kel_nama)
            ->delete();

        // Tambahkan ke tabel pivot (sim_dtkelompokprakerin)
        foreach ($mhsIds as $mhsId) {
            Pengelompokkan::create([
                'pin_id' => $pinId,
                'mhs_id' => $mhsId,
                'kel_nama' => $kel_nama,
                'kel_departemen' => $kel_departemen,
                'kel_status' => 'Aktif',
                // tambahkan kolom lain yang diperlukan
            ]);
        }

        return redirect(route('Admin.Pengelompokkan.index'))->with('success', 'Updated successfully!');
    }

    public function destroy($id)
    {
        //Mencari Produk dengan ID
        //$pembimbing = Pembimbing::findOrFail($id);
        $deleteResult = DB::update('
        UPDATE sim_dtkelompokprakerin
        SET
            kel_status = :kel_status
        WHERE
            kel_nama = :kel_nama
        ', [
            'kel_status' => 'Lulus',
            'kel_nama' => $id,
        ]);

        //metode delete() disediakan
        if ($deleteResult) {
            return redirect(route('Admin.Pengelompokkan.index'))->with('success', 'Deleted!');
        }

        return redirect(route('Admin.Pengelompokkan.index'))->with('error', 'Sorry, unable to delete this!');
    }

    public function detail($id)
    {
        $kelompok = DB::table('sim_dtkelompokprakerin as d')
            ->join('sim_mspembimbingindustri as p', 'd.pin_id', '=', 'p.pin_id')
            ->join('sia_msindustriprakerin as i', 'p.ipr_id', '=', 'i.ipr_id')
            ->join('sia_msmahasiswa as m', 'd.mhs_id', '=', 'm.mhs_id')
            ->join('sia_mskonsentrasi as k', 'm.kon_id', '=', 'k.kon_id')
            ->join('sia_msprodi as pr', 'k.pro_id', '=', 'pr.pro_id')
            ->select('d.kel_nama', 'p.pin_nama', 'i.ipr_nama', 'd.kel_departemen', 'm.mhs_nama', 'pr.pro_nama')
            ->where('d.kel_status', '=', 'Aktif')
            ->where('d.kel_nama', '=', $id)
            ->get();

        // Output atau gunakan $result sesuai kebutuhan Anda
        return view('Admin.Pengelompokkan.detail', ['kelompok' => $kelompok]);
    }
}
