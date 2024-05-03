<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $table = "absensi";
    protected $fillable = ['nama_karyawan','tanggal_masuk','waktu_masuk','status','waktu_selesai_kerja'];
}

