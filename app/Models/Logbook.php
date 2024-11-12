<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    use HasFactory;
    
    protected $primaryKey  = 'log_id';
    protected $table = 'sim_trlogbook';
    protected $fillable = ['log_id', 'mhs_id', 'log_minggu', 'log_mulai', 'log_selesai', 'log_hari_1', 'log_hari_2', 'log_hari_3', 'log_hari_4', 'log_hari_5', 'log_hari_6', 'log_hari_7', 'log_status','create_at','pin_id'];
    public $timestamps = false;
}