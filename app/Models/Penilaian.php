<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Penilaian extends Model
{
    use HasFactory;
    protected $table = 'sim_trspenilaian';
    protected $fillable = ['pnl_id', 'mhs_id', 'pro_singkatan', 'mhs_nama', 'pnl_periode', 
    'pnl_pengetahuan_kerja', 'pnl_kualitas_kerja', 'pnl_kecepatan_kerja', 'pnl_sikap_perilaku', 'pnl_kreatifitas_kerja_sama', 'pnl_leadership', 
    'pnl_beradaptasi', 'pnl_penanganan_masalah', 'pnl_ulasan', 'rata_nilai', 'pnl_id', 'pin_id', 'pin_nama', 'ipr_nama', 'ipr_group', 'kel_departemen'];

    public $timestamps = false; // Menonaktifkan kolom 'updated_at' dan 'created_at'
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
