<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataUser extends Model
{
    protected $table = 'data_users';
    protected $fillable = [
        'user_id',
        'nama',
        'alamat',
        'no_telp',
        'no_sim'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pinjaman()
    {
        return $this->hasMany(Pinjaman::class, 'data_user_id');
    }
}
