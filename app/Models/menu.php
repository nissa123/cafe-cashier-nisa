<?php

namespace App\Models;
use App\Models\jenis;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    use HasFactory;
    protected $table = "menu";
    protected $fillable = ['nama_menu','harga','image','deskripsi','jenis_id'];

    public function jenis()
{
    return $this->belongsTo(Jenis::class, 'jenis_id');
}
public function stok()
{
    return $this->hasMany(stok::class, 'menu_id', 'id');
}

}
