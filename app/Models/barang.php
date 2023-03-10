<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'waktu',
        'harga_awal',
        'image',
        'deskripsi_awal',
    ];
    public function lelangs()
    {
        return $this->hasMany(lelang::class, 'id_barang', 'id');
    }
    public function his()
    {
        return $this->hasMany(history_lelang::class, 'id_barang', 'id');
    }
}


