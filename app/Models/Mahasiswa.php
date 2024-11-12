<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'sia_msmahasiswa';
    //protected $primaryKey = 'mhs_id';
    protected $fillable = [
        'mhs_id',
        'mhs_nama',
        'mhs_angkatan',
        'mhs_jenis_kelamin',
        'mhs_status_kuliah'
    ];

    public function pembimbings()
    {
        return $this->belongsToMany(Pembimbing::class, 'sim_dtkelompokprakerin')->withPivot('dt_kelompok', 'dt_departemen');
    }

}
