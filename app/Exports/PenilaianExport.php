<?php

namespace App\Exports;

use App\Models\Penilaian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PenilaianExport implements FromCollection, WithHeadings
{
    protected $laporan;

    public function __construct($laporan)
    {
        $this->laporan = $laporan;
    }

    public function collection()
    {
        return collect($this->laporan)->map(function ($item) {
            // Sesuaikan dengan kolom yang ingin Anda sertakan dalam ekspor
            return [
                $item['mhs_id'],
                $item['mhs_nama'],
                $item['ipr_nama'],
                $item['kel_departemen'],
                $item['rata_pengetahuan'],
                $item['rata_kualitas'],
                $item['rata_kecepatan'],
                $item['rata_sikap'],
                $item['rata_kreatifitas'],
                $item['rata_leadership'],
                $item['rata_beradaptasi'],
                $item['rata_penanganan'],
            ];
        });
    }
    

    public function headings(): array
    {
        return [
            'NIM',
            'Nama Mahasiswa',
            'Industri',
            'Departemen/Area Magang',
            'Pengetahuan Kerja',
            'Kualitas Kerja',
            'Kecepatan Kerja',
            'Sikap dan Perilaku',
            'Kreatifitas dan Kerjasama',
            'Softskill dan Leadership',
            'Softskill Kemampuan Menangani Masalah',
            'Softskill Kemampuan Beradaptasi',
        ];
    }
}
