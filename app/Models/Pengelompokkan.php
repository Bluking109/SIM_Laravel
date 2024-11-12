<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengelompokkan extends Model
{
    use HasFactory;
    protected $table = 'sim_dtkelompokprakerin';
    protected $fillable = ['pin_id', 'mhs_id', 'kel_departemen', 'kel_nama', 'kel_status'];
}