<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class history_lelang extends Model
{
    use HasFactory;
    public function barangs()
    {
        return $this->belongsTo(barang::class, 'id_barang', 'id');
    }
    public function silelang()
    {
        return $this->belongsTo(lelang::class, 'id_lelang', 'id');
    }
    public function iduser()
    {
        return $this->belongsTo(User::class, 'userid', 'id');
    }
}
