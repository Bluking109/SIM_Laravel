<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $rol = null;
        $namaUser = null;
        $prodiUser = null;
        $result = null;
        $cekKaryawan = null;
        $cekDosen = null;
        $cekPembimbing = null;
        $cekMahasiswa = null;


        // Pengecekan di tabel sso_msuser
        $result = DB::table('sso_msuser')
            ->select(DB::raw('1 AS userExist'))
            ->where('usr_id', $username)
            ->where('usr_status', 'Aktif')
            ->first();

        if ($result) {

            //Jika ditemukan di Karyawan 
            $cekKaryawan = DB::table('ess_mskaryawan')
                ->select('kry_nama_depan', 'kry_nama_blkg')
                ->where('kry_id', $username)
                ->first();

            if ($cekKaryawan) {
                $cekDosen = DB::table('ess_mskaryawan as k')
                    ->join('sia_mskonsentrasi as d', 'k.kry_id', '=', 'd.kon_npk')
                    ->join('sia_msprodi as p', 'd.pro_id', '=', 'p.pro_id')
                    ->select('k.kry_nama_depan', 'k.kry_nama_blkg', 'p.pro_singkatan')
                    ->where('k.kry_id', '=', $username)
                    ->first();

                if ($cekDosen) {
                    $namaUser = $cekKaryawan->kry_nama_depan . ' ' . $cekKaryawan->kry_nama_blkg;
                    $rol = 'Sekretaris Prodi';
                    $prodiUser = $cekDosen->pro_singkatan;
                } else {
                    $namaUser = $cekKaryawan->kry_nama_depan . ' ' . $cekKaryawan->kry_nama_blkg;
                    $rol = 'Admin';
                }
            } else {
                //Jika tidak ditemukan di Karyawan maka cek Apakah Pembimbing
                $cekPembimbing = DB::table('sim_mspembimbingindustri as spi')
                    ->join('sim_mspembimbingindustri as sp', 'spi.pin_id', '=', 'sp.pin_id')
                    ->select(DB::raw('1 AS userExist'), 'sp.pin_nama')
                    ->where('spi.pin_id', $username)
                    ->where('spi.pin_status', 'Aktif')
                    ->first();

                if ($cekPembimbing) {
                    $namaUser = $cekPembimbing->pin_nama;
                    $rol = 'Pembimbing Industri';
                } else {
                    $cekMahasiswa = DB::table('sia_msmahasiswa as m')
                        ->join('sim_dtkelompokprakerin as d', 'm.mhs_id', '=', 'd.mhs_id')
                        ->select(DB::raw('1 AS userExist'), 'm.mhs_nama')
                        ->where('d.mhs_id', $username)
                        ->where('d.kel_status', 'Aktif')
                        ->first();
           
                    if ($cekMahasiswa) {
                        $rol = 'Mahasiswa';
                        $namaUser = $cekMahasiswa->mhs_nama;
                    } else {
                        $namaUser = 'Tidak ditemukan';
                    }
                }

            }


        } else {
            $namaUser = 'Tidak ditemukan';
        }

        // $ppp = strtoupper($namaUser->kry_nama_depan . ' ' . $namaUser->kry_nama_blkg);
        session([
            'usr_nama' => strtoupper($namaUser),
            'usr_role' => strtoupper($rol),
            'usr_prodi' => $prodiUser,
            'login_date' => now()->toDateString(),
            'username' => $username,
            'login' => true
        ]);

        if ($rol === 'Admin') {
            return redirect()->route('Admin.DashboardAdmin');

        } elseif ($rol === 'Mahasiswa') {
            return view('Mahasiswa.DashboardMahasiswa');

        } elseif ($rol === 'Sekretaris Prodi') {
            return view('Sekprod.Dashboard.dashboard');

        } elseif ($rol === 'Pembimbing Industri') {
            return view('Pembimbing.DashboardPembimbing');
        } else {
            return view('auth.login')->with('error', 'Username tidak Ditemukan !!');
        }
    }
}
