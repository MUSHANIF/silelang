<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lelang extends Model
{
    use HasFactory;
    public function lelang()
    {
        return $this->belongsTo(barang::class, 'id_barang', 'id');
    }
    public function lelangs()
    {
        return $this->hasOne(history_lelang::class, 'id_lelang', 'id');
    }
}
