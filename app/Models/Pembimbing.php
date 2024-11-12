<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembimbing extends Model
{ 
     use HasFactory;
     protected $table = 'sim_mspembimbingindustri';
     //protected $primaryKey = 'pin_id'; // Sesuaikan dengan nama primary key yang Anda gunakan
     protected $fillable = [
        'pin_id',
        'ipr_id',
        'pin_nama',
        'pin_jabatan',
        'pin_email',
        'pin_status',
        'pin_password'
    ];
    
    public function mahasiswas()
{
    return $this->belongsToMany(Mahasiswa::class, 'sim_dtkelompokprakerin')->withPivot('dt_kelompok', 'dt_departemen');
}

}
