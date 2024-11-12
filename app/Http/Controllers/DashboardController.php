<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembimbing;
use App\Models\Industri;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboardAdmin(Request $request)
    {
        $pembimbing = DB::table('sim_mspembimbingindustri')
            ->where('pin_status', 'Aktif')
            ->count();

        $mahasiswa = DB::table('sim_dtkelompokprakerin')
            ->where('kel_status', 'Aktif')
            ->count();

        $kelompok = DB::table('sim_dtkelompokprakerin')
            ->where('kel_status', 'Aktif')
            ->distinct('kel_nama')
            ->count('kel_nama');

        return view('Admin.DashboardAdmin', [
            'pembimbing' => $pembimbing,
            'mahasiswa' => $mahasiswa,
            'kelompok' => $kelompok,
        ]);
    }

    public function dashboardSekprod(Request $request)
    {
        return View('Sekprod.Dashboard.dashboard');
    }

    public function dashboardMahasiswa(Request $request)
    {
        return View('Mahasiswa.DashboardMahasiswa');
    }

    public function dashboardpem()
    {
        return view('Pembimbing.DashboardPembimbing');
    }

}
