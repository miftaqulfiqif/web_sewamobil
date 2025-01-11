<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    protected $table = 'pinjamans';
    protected $fillable = [
        'mobil_id',
        'data_user_id',
        'tanggal_mulai',
        'tangagal_selesai',
    ];

    public function mobil()
    {
        return $this->belongsTo(Mobil::class, 'mobil_id');
    }

    public function data_user()
    {
        return $this->belongsTo(DataUser::class, 'data_user_id');
    }
}
