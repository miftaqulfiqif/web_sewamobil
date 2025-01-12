<?php

namespace App\Http\Controllers;

use App\Models\DataUser;
use App\Models\Mobil;
use App\Models\Pinjaman;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $dataUser = DataUser::where('user_id', $user->id)->first();

        if (!$user && !$dataUser) {
            abort(404);
        }

        $dataPinjaman = Pinjaman::where('data_user_id', $dataUser->id)->get();
        $mobilIds = $dataPinjaman->pluck('mobil_id')->unique();
        $mobils = Mobil::whereIn('id', $mobilIds)->get();

        $tanggalMulai = $mobils->pluck('tanggal_mulai')->unique();

        $riwayats = Riwayat::where('data_user_id', $dataUser->id)->get();

        return view('dashboard', compact('dataUser', 'dataPinjaman', 'mobils', 'riwayats'));
    }
}
