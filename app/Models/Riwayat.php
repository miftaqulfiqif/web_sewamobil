<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    protected $table = 'riwayats';

    protected $fillable = [
        'data_user_id',
        'mobil_id',
        'pinjaman_id',
        'tanggal',
        'biaya',
    ];

    public function dataUser()
    {
        return $this->belongsTo(DataUser::class, 'data_user_id');
    }

    public function mobil()
    {
        return $this->belongsTo(Mobil::class, 'mobil_id');
    }

    public function pinjaman()
    {
        return $this->belongsTo(Pinjaman::class, 'pinjaman_id');
    }
}
