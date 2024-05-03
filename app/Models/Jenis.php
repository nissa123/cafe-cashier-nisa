<?php

namespace App\Models;
use App\Models\menu;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    use HasFactory;
    protected $table = "jenis";
    protected $fillable = ['nama_jenis','kategori_id'];
    
    public function menu()
{
    return $this->hasMany(menu::class, 'jenis_id', 'id');
}
}
