<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Industri extends Model
{
    use HasFactory;
    protected $table = 'sia_msindustriprakerin';
    protected $fillable = [
        'ipr_id',
        'ipr_nama',
        'ipr_cabang',
        'ipr_grup',
        'ipr_alamat',
        'ipr_telepon',
        'ipr_status',
    ];
    public function pembimbing()
    {
        return $this->hasMany(Pembimbing::class);
    }
}
