<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    protected $table = 'mobils';
    protected $fillable = [
        'merek',
        'model',
        'no_plat',
        'tarif',
        'status'
    ];

    public function pinjaman()
    {
        return $this->hasMany(Pinjaman::class, 'mobil_id');
    }
}
