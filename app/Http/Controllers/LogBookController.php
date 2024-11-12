<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembimbing;
use App\Models\Logbook;
use App\Models\Industri;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Psy\Readline\Hoa\Console;

class LogBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $username = session('username');
        $item = 10;
        $logbook = DB::table('sia_msmahasiswa as m')
            ->join('sia_mskonsentrasi as k', 'm.kon_id', '=', 'k.kon_id') //prodi pny beberapa konsentrasi
            ->join('sia_msprodi as p', 'k.pro_id', '=', 'p.pro_id')
            ->join('sim_trlogbook as log', 'm.mhs_id', '=', 'log.mhs_id')
            ->join('sim_mspembimbingindustri as pin', 'pin.pin_id', '=', 'log.pin_id')
            ->join('sia_msindustriprakerin as i', 'pin.ipr_id', '=', 'i.ipr_id')
            ->select(
                'm.mhs_id',
                'm.mhs_nama',
                'p.pro_nama',
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
                'log.log_status',
                'log.create_at',
                'pin.pin_id',
                'pin.pin_nama',
                'log.log_id',
                'i.ipr_nama',
                'i.ipr_grup'
            )
            ->where(function ($query) use ($username) {     //
                $query->where(DB::raw('UPPER(m.mhs_id)'), 'like', '%' . strtoupper($username) . '%');
            })

            ->paginate($item);

        return view("Mahasiswa.LogBook.index", ['logbook' => $logbook]);
    }

    public function detail($id)
    {
        $logbook = DB::table('sia_msmahasiswa as m')
            ->join('sia_mskonsentrasi as k', 'm.kon_id', '=', 'k.kon_id')
            ->join('sia_msprodi as p', 'k.pro_id', '=', 'p.pro_id')
            ->join('sim_trlogbook as log', 'm.mhs_id', '=', 'log.mhs_id')
            ->join('sim_mspembimbingindustri as pin', 'pin.pin_id', '=', 'log.pin_id')
            ->join('sia_msindustriprakerin as i', 'pin.ipr_id', '=', 'i.ipr_id')
            ->where('m.mhs_id', '=', $id)
            ->orWhere('log.log_id', '=', $id)
            ->select(
                'm.mhs_id',
                'm.mhs_nama',
                'p.pro_nama',
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
                'log.log_status',
                'log.create_at',
                'pin.pin_nama',
                'log.log_id',
                'i.ipr_nama',
                'i.ipr_grup',
                'log.log_ulasan'
            )
            ->first();

        return view('Mahasiswa.LogBook.detail', ['logbook' => $logbook]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $mhs_id = session('username');
        $pembimbing = DB::table('sim_dtkelompokprakerin as d')
            ->join('sim_mspembimbingindustri as p', 'd.pin_id', '=', 'p.pin_id')
            ->select('d.pin_id', 'p.pin_nama')
            ->where('d.mhs_id', '=', $mhs_id)
            ->get();

        // Simpan pin_id dalam sesi
        $request->session()->put('mhs_id');

        // Panggil fungsi logMinggu untuk mendapatkan nilai "Pekan LogBook"
        $latestLogMinggu = $this->logMinggu($mhs_id);

        return view('Mahasiswa.LogBook.create', ['pembimbing' => $pembimbing, 'latestLogMinggu' => $latestLogMinggu]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        try {
            // Ambil nilai pin_id dari sesi
            $mhs_id = session('username');

            // Menambahkan nilai 'log_status' secara otomatis
            $request->merge(['log_status' => 'Draft']);

            // Ambil data logBook dari request
            $logBookData = $request->all();
            $logBookData['mhs_id'] = $mhs_id;

            // Dapatkan nilai pin_id dari input form
            $pinId = $logBookData['pin_id']; // Ganti ini dengan sesuai input form Anda

            // Pastikan pin_id diisi dengan nilai yang valid
            if (!$pinId) {
                throw new \Exception('PIN ID is required.'); // Ubah pesan kesalahan sesuai kebutuhan
            }

            // Mengatur log_mulai sesuai dengan input create_at
            $logBookData['log_mulai'] = Carbon::parse($logBookData['create_at'])->startOfWeek(); // Hari Senin

            // Menghitung tanggal log_selesai dengan menambahkan 7 hari ke log_mulai
            $logBookData['log_selesai'] = Carbon::parse($logBookData['log_mulai'])->addDays(6); // Hari Minggu

            $request->validate([
                'log_minggu' => 'required',
                'pin_id' => 'required',
                'create_at' => 'required|date_format:Y-m-d\TH:i',
            ]);

            // Validasi untuk memastikan tanggal yang dipilih adalah hari Senin
            $selectedDate = Carbon::parse($request->input('create_at'));
            if ($selectedDate->dayOfWeek !== Carbon::MONDAY) {
                return redirect()->back()->withErrors(['create_at' => 'Tanggal yang dipilih harus merupakan hari Senin.']);
            }

            // Buat logBook baru
            $logbook = Logbook::create([
                'mhs_id' => $logBookData['mhs_id'],
                'log_minggu' => $logBookData['log_minggu'],
                'log_mulai' => $logBookData['log_mulai'],
                'log_selesai' => $logBookData['log_selesai'],
                'log_hari_1' => $logBookData['log_hari_1'] ?: '-', // Jika kosong, ganti dengan '-'
                'log_hari_2' => $logBookData['log_hari_2'] ?: '-',
                'log_hari_3' => $logBookData['log_hari_3'] ?: '-',
                'log_hari_4' => $logBookData['log_hari_4'] ?: '-',
                'log_hari_5' => $logBookData['log_hari_5'] ?: '-',
                'log_hari_6' => $logBookData['log_hari_6'] ?: '-',
                'log_hari_7' => $logBookData['log_hari_7'] ?: '-',
                'log_status' => $logBookData['log_status'],
                'create_at' => Carbon::now(),
                'pin_id' => $pinId, // Pastikan pin_id diisi dengan nilai yang valid
            ]);


            // Pastikan bahwa data yang diperlukan terisi sebelum menyimpan
            if ($logbook) {
                return redirect(route('Mahasiswa.LogBook.index'))->with('success', 'LogBook added successfully!');
            } else {
                throw new \Exception('Failed to add LogBook. Required fields are not filled.');
            }
        } catch (\Exception $e) {
            return redirect(route('Mahasiswa.LogBook.index'))->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            // Ambil data logBook berdasarkan ID
            $logbook = Logbook::findOrFail($id);

            // Lakukan operasi atau tindakan lainnya dengan $logbook

            // Panggil fungsi logMinggu untuk mendapatkan nilai "Pekan LogBook"
            $latestLogMinggu = $this->logMinggu($logbook->mhs_id);

            // Ambil data pembimbing untuk ditampilkan di form
            $pembimbing = DB::table('sim_mspembimbingindustri as pin')
                ->select('pin_id', 'pin_nama')
                ->where('pin.pin_id', '=', $logbook->pin_id)
                ->get();

            return view('Mahasiswa.LogBook.edit', ['logbook' => $logbook, 'pembimbing' => $pembimbing, 'latestLogMinggu' => $latestLogMinggu]);
        } catch (\Exception $e) {
            // Handle kesalahan sesuai kebutuhan aplikasi Anda
            return redirect()->route('Mahasiswa.LogBook.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
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
       UPDATE sim_trlogbook
       SET
           log_hari_1 = :log_hari_1,
           log_hari_2 = :log_hari_2,
           log_hari_3 = :log_hari_3,
           log_hari_4 = :log_hari_4,
           log_hari_5 = :log_hari_5,
           log_hari_6 = :log_hari_6,
           log_hari_7 = :log_hari_7

       WHERE
           log_id = :log_id
       ', [
            'log_id' => $id,
            'log_hari_1' => $request->input('log_hari_1'),
            'log_hari_2' => $request->input('log_hari_2'),
            'log_hari_3' => $request->input('log_hari_3'),
            'log_hari_4' => $request->input('log_hari_4'),
            'log_hari_5' => $request->input('log_hari_5'),
            'log_hari_6' => $request->input('log_hari_6'),
            'log_hari_7' => $request->input('log_hari_7'),
        ]);
        // Periksa apakah proses update berhasil
        if ($updateResult) {
            // Menambahkan data 'Updated!' ke sesi dengan kata kunci 'success'
            return redirect(route('Mahasiswa.LogBook.index'))->with('success', 'LogBook berhasil diedit!');
        }

        // Jika proses pembaruan gagal
        return redirect(route('Mahasiswa.LogBook.index'))->with('error', 'Failed to update Pembimbing.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function daftar(Request $request)
    {
        $cari = $request->input('cari');
        $username = session('username');
        $mhsNama = $request->input('mhs_nama');
        $selectedStatus = $request->input('ddStatus'); // Assuming you are using 'ddProdi' for status

        $result = DB::table('sim_trlogbook as l')
            ->join('sia_msmahasiswa as m', 'l.mhs_id', '=', 'm.mhs_id')
            ->join('sim_dtkelompokprakerin as k', 'l.mhs_id', '=', 'k.mhs_id')
            ->select('l.log_id', 'm.mhs_nama', 'k.kel_departemen', 'l.log_minggu', 'l.log_mulai', 'l.log_selesai', 'l.log_status')
            ->where('l.log_status', '!=', 'Draft')
            ->where('l.pin_id', '=', $username)
            ->distinct();

        if (!empty($selectedStatus)) {
            $result->where('l.log_status', '=', $selectedStatus);
        } else if (!empty($cari)) {
            $result->where('l.log_status', '=', $cari);
        }

        $result = $result->get();

        return view('Pembimbing.LogBook.daftar', ['logbook' => $result, 'selectedStatus' => $selectedStatus]);
    }

    public function konfirmasi($id)
    {
        try {
            // Ambil data log berdasarkan ID

            $updateResult = DB::update('
                UPDATE sim_trlogbook
                SET
                log_status = :log_status
                WHERE
                    log_id = :log_id
                ', [
                'log_status' => 'Disetujui',
                'log_id' => $id,
            ]);

            return redirect()->route('Pembimbing.LogBook.daftar')->with('success', 'Log berhasil dikonfirmasi');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            // Handle kesalahan sesuai kebutuhan aplikasi Anda
            return redirect()->route('Pembimbing.LogBook.daftar')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function kirimLogBook($logId)
    {
        try {
            // Mengambil data logbook berdasarkan log_id
            $logbook = DB::table('sim_trlogbook')
                ->where('log_id', $logId)
                ->first();

            // Memeriksa apakah logbook ditemukan
            if ($logbook !== null) {
                // Memeriksa apakah setiap log_hari memiliki nilai yang valid
                if (
                    $logbook->log_hari_1 != "-" &&
                    $logbook->log_hari_2 != "-" &&
                    $logbook->log_hari_3 != "-" &&
                    $logbook->log_hari_4 != "-" &&
                    $logbook->log_hari_5 != "-"
                ) {
                    // Jika semua log_hari memiliki nilai yang valid, update status logbook menjadi "Pending"
                    $updateResult = DB::table('sim_trlogbook')
                        ->where('log_id', $logId)
                        ->update(['log_status' => 'Pending']);

                    return redirect()->route('Mahasiswa.LogBook.index')->with('success', 'LogBook berhasil dikirim');
                } else {
                    // Jika ada log_hari yang kosong, tampilkan pesan error
                    return redirect()->route('Mahasiswa.LogBook.index')->with('error', 'Data LogBook harus lengkap');
                }
            } else {
                // Jika logbook tidak ditemukan, tampilkan pesan error
                return redirect()->route('Mahasiswa.LogBook.index')->with('error', 'Data LogBook tidak ditemukan');
            }
        } catch (\Exception $e) {
            // Tangani kesalahan sesuai kebutuhan aplikasi Anda
            return redirect()->route('Mahasiswa.LogBook.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }




    public function tolak(Request $request, $id)
{
    try {
        // Ambil alasan penolakan dari request
        $alasan = $request->input('alasan');

        // Update data logbook berdasarkan ID dengan status "Ditolak" dan alasan penolakan
        $updateResult = DB::table('sim_trlogbook')
            ->where('log_id', $id)
            ->update([
                'log_status' => 'Ditolak',
                'log_ulasan' => $alasan,
            ]);

        // Periksa apakah data berhasil diperbarui
        if ($updateResult) {
            return redirect()->route('Pembimbing.LogBook.daftar')->with('success', 'Log berhasil ditolak');
        } else {
            return redirect()->route('Pembimbing.LogBook.daftar')->with('error', 'Gagal memperbarui data logbook');
        }
    } catch (\Exception $e) {
        // Handle kesalahan sesuai kebutuhan aplikasi Anda
        return redirect()->route('Pembimbing.LogBook.daftar')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}



    public function logMinggu($id)
    {

        $logMinggu = DB::table('sim_trlogbook')
            ->select('log_minggu')
            ->where('mhs_id', '=', $id)
            ->orderByDesc('create_at')
            ->first();

        // Periksa apakah data ditemukan sebelum mengakses nilai log_minggu
        if ($logMinggu) {
            $logMingguString = $logMinggu->log_minggu;

            // Gunakan ekspresi reguler untuk mengekstrak angka setelah "Minggu-"
            preg_match('/Minggu-(\d+)/', $logMingguString, $matches);

            if (isset($matches[1])) {
                // Jumlahkan 1 ke angka setelah "Minggu-"
                $latestLogMinggu = intval($matches[1]) + 1;
            } else {
                // Jika tidak ada angka yang ditemukan, berikan nilai default Minggu-1
                $latestLogMinggu = 1;
            }

            // Lakukan operasi atau tindakan lainnya dengan $latestLogMinggu
        } else {
            // Data tidak ditemukan, berikan nilai default Minggu-1
            $latestLogMinggu = 1;
        }

        return $latestLogMinggu;
    }
}
