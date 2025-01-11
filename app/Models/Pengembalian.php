<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $table = 'pengembalians';
    protected $fillable = [
        'pinjaman_id',
        'data_user_id',
        'mobil_id',
        'tanggal_pengembalian',
        'biaya_sewa'
    ];
}
