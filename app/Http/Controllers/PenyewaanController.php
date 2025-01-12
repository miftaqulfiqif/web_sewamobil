<?php

namespace App\Http\Controllers;

use App\Models\DataUser;
use App\Models\Mobil;
use App\Models\Pinjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenyewaanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $dataUser = DataUser::where('user_id', $user->id)->first();

        if (!$user && !$dataUser) {
            abort(404);
        }

        return view('peminjaman', compact('dataUser'));
    }

    public function cekMobil(Request $request)
    {
        $tanggalPinjam = $request->tanggal_mulai;
        $tanggalKembali = $request->tanggal_selesai;

        $mobils = Mobil::all();

        $availableMobil = [];
        foreach ($mobils as $mobil) {
            $cekKetersediaanMobil = Pinjaman::where('mobil_id', $mobil->id)
                ->where(function ($query) use ($tanggalPinjam, $tanggalKembali) {
                    $query->whereBetween('tanggal_peminjaman', [$tanggalPinjam, $tanggalKembali])
                        ->orWhereBetween('tanggal_pengembalian', [$tanggalPinjam, $tanggalKembali]);
                })
                ->exists();


            if (!$cekKetersediaanMobil) {
                $availableMobil[] = $mobil->id;
            }
        }

        if (!$availableMobil) {

            return back()->with('error', 'Mobil Tidak Tersedia')->withInput();
        }

        return redirect()->route('tampil_mobil', 'availableMobil');
    }

    public function tampilMobil(Request $request)
    {
        $user = Auth::user();
        $dataUser = DataUser::where('user_id', $user->id)->first();
        $availableMobil = Mobil::where('id', $request->availableMobil)->get();
        $semuaMobil = Mobil::all();

        return view('peminjaman', compact('availableMobil', 'dataUser', 'semuaMobil', 'request'));
    }
}
