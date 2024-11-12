<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembimbing;
use App\Models\Industri;
use Illuminate\Support\Facades\DB;

class PembimbingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        $cari = $request->input('cari');

        $pembimbing = Pembimbing::join('sia_msindustriprakerin', 'sia_msindustriprakerin.ipr_id', '=', 'sim_mspembimbingindustri.ipr_id')
            ->where('sim_mspembimbingindustri.pin_status', '=', 'Aktif')
            ->when($cari, function ($query) use ($cari) {
                $query->where(function ($query) use ($cari) {
                    $query->where('sim_mspembimbingindustri.pin_nama', 'like', '%' . $cari . '%')
                        ->orWhere('sim_mspembimbingindustri.pin_id', 'like', '%' . $cari . '%')
                        ->orWhere('sim_mspembimbingindustri.pin_jabatan', 'like', '%' . $cari . '%')
                        ->orWhere('sia_msindustriprakerin.ipr_nama', 'like', '%' . $cari . '%');
                });
            })
            ->select(
                'sim_mspembimbingindustri.pin_id',
                'sia_msindustriprakerin.ipr_nama',
                'sim_mspembimbingindustri.pin_nama',
                'sim_mspembimbingindustri.pin_jabatan',
                'sim_mspembimbingindustri.pin_email',
                'sim_mspembimbingindustri.pin_password'
            )
            ->orderBy('pin_id', 'desc')
            ->paginate(10);

        return view("Admin.Pembimbing.index", ['pembimbing' => $pembimbing, 'cari' => $cari]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $industri = Industri::orderBy('ipr_nama', 'asc')->get()->pluck('ipr_nama', 'ipr_id');

        // Membuat instance baru dari model Pembimbing
        $pembimbing = new Pembimbing();

        // Mendapatkan nilai terbaru dari kolom pin_id
        $latestPinId = DB::table('sim_mspembimbingindustri')->max('pin_id');

        // Mengekstrak 4 digit terakhir dari nilai terbesar
        $lastDigits = intval(substr($latestPinId, -4));

        // Menambahkan 1 untuk mendapatkan ID berikutnya
        $nextId = $lastDigits + 1;

        // Format ID dengan "PINXXXX"
        $newPinId = 'PIN' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

        return view('Admin.Pembimbing.create', ['industri' => $industri, 'newPinId' => $newPinId]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1. Get the latest 'pin_id'
        $latestPin = Pembimbing::max('pin_id');

        // 2. Generate New 'pin_id'
        $newPinNumber = intval(substr($latestPin, 3)) + 1;
        $newPinId = 'PIN' . str_pad($newPinNumber, 4, '0', STR_PAD_LEFT);

        // 3. Use in Creation
        $pembimbingData = $request->all();
        $pembimbingData['pin_id'] = $newPinId;
        // Buat objek Pembimbing
        if ($pembimbing = Pembimbing::create($pembimbingData)) {
            return redirect(route('Admin.Pembimbing.index'))->with('success', 'Added!');
        }

        // Jika proses penyimpanan gagal
        return redirect(route('Admin.Pembimbing.index'))->with('error', 'Failed to add Pembimbing.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //findorfail bisa untuk mencari data lain, dengan syarat diubah juga route/web nya
        //$pembimbing = Pembimbing::findOrFail($id);

        $pembimbing = Pembimbing::select('sim_mspembimbingindustri.*')
            ->where('sim_mspembimbingindustri.pin_id', '=', $id)
            ->get();

        $industri = Industri::orderBy('ipr_nama', 'asc')->get()->pluck('ipr_nama', 'ipr_id');

        return view('Admin.Pembimbing.edit', ['pembimbing' => $pembimbing, 'industri' => $industri]);
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
        // Lakukan update menggunakan query langsung
        $updateResult = DB::update('
        UPDATE sim_mspembimbingindustri
        SET
            ipr_id = :ipr_id,
            pin_nama = :pin_nama,
            pin_jabatan = :pin_jabatan,
            pin_email = :pin_email,
            pin_password = :pin_password
        WHERE
            pin_id = :pin_id
        ', [
            'ipr_id' => $request->input('ipr_id'),
            'pin_nama' => $request->input('pin_nama'),
            'pin_jabatan' => $request->input('pin_jabatan'),
            'pin_email' => $request->input('pin_email'),
            'pin_password' => $request->input('pin_password'),
            'pin_id' => $id,
        ]);
        // Periksa apakah proses update berhasil
        if ($updateResult) {
            // Menambahkan data 'Updated!' ke sesi dengan kata kunci 'success'
            return redirect(route('Admin.Pembimbing.index'))->with('success', 'Pembimbing updated successfully!');
        }

        // Jika proses pembaruan gagal
        return redirect(route('Admin.Pembimbing.index'))->with('error', 'Failed to update Pembimbing.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteResult = DB::table('sim_mspembimbingindustri')
            ->where('pin_id', $id)
            ->update(['pin_status' => 'Non Aktif']);

        if ($deleteResult) {
            return redirect()->back()->with('status', 'success');
        } else {
            return redirect()->back()->with('status', 'error');
        }
    }
}
