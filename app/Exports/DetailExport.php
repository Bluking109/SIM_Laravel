<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DetailExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'NIM',
            'Nama Mahasiswa',
            'Industri',
            'Periode Penilaian',
            'Pengetahuan Kerja',
            'Kualitas Kerja',
            'Kecepatan Kerja',
            'Sikap dan Perilaku',
            'Kreatifitas dan Kerjasama',
            'Softskill dan Leadership',
            'Softskill Kemampuan Menangani Masalah',
            'Softskill Kemampuan Beradaptasi',
            'Ulasan',
            'Rata-rata Nilai(Periode)'
        ];
    }
}
