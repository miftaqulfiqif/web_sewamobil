<?php

namespace App\Http\Controllers;

use App\Models\DataUser;
use App\Models\Mobil;
use App\Models\Pinjaman;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenyewaanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $dataUser = DataUser::where('user_id', $user->id)->first();

        if (!$user || !$dataUser) {
            abort(404);
        }

        $mobils = Mobil::all();
        $mobilTersedia = null;


        return view('peminjaman', compact('dataUser', 'mobils', 'mobilTersedia'));
    }

    public function cekMobil(Request $request)
    {
        $user = Auth::user();
        $dataUser = DataUser::where('user_id', $user->id)->first();

        $tanggalPinjam = $request->tanggal_mulai;
        $tanggalKembali = $request->tanggal_selesai;

        $mobils = Mobil::all();
        $availableMobil = [];

        foreach ($mobils as $mobil) {
            $cekKetersediaanMobil = Pinjaman::where('mobil_id', $mobil->id)
                ->where(function ($query) use ($tanggalPinjam, $tanggalKembali) {
                    $query->whereBetween('tanggal_mulai', [$tanggalPinjam, $tanggalKembali])
                        ->orWhereBetween('tanggal_selesai', [$tanggalPinjam, $tanggalKembali]);
                })
                ->exists();

            if (!$cekKetersediaanMobil) {
                $availableMobil[] = $mobil->id;
            }
        }

        if (empty($availableMobil)) {
            return back()->with('error', 'Mobil Tidak Tersedia')->withInput();
        }

        $mobilTersedia = Mobil::whereIn('id', $availableMobil)->get();

        return view('peminjaman', compact('dataUser', 'mobils', 'mobilTersedia', 'tanggalPinjam', 'tanggalKembali'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $dataUser = DataUser::where('user_id', $user->id)->first();

        $tanggalPinjam = $request->tanggal_pinjam;
        $tanggalKembali = $request->tanggal_kembali;

        $mobilId = $request->mobil_id;
        $mobil = Mobil::find($mobilId);

        if (!$mobil) {
            return back()->with('error', 'Mobil Tidak Ditemukan')->withInput();
        }

        $cekKetersediaanMobil = Pinjaman::where('mobil_id', $mobilId)
            ->where(function ($query) use ($tanggalPinjam, $tanggalKembali) {
                $query->whereBetween('tanggal_mulai', [$tanggalPinjam, $tanggalKembali])
                    ->orWhereBetween('tanggal_selesai', [$tanggalPinjam, $tanggalKembali]);
            })
            ->exists();

        if ($cekKetersediaanMobil) {
            return back()->with('error', 'Mobil Tidak Tersedia')->withInput();
        }

        Pinjaman::create([
            'mobil_id' => $mobilId,
            'data_user_id' => $dataUser->id,
            'tanggal_mulai' => $tanggalPinjam,
            'tanggal_selesai' => $tanggalKembali,
        ]);

        return redirect()->route('dashboard')->with('success', 'Peminjaman Berhasil');
    }

    public function pengembalian(Request $request)
    {
        $user = Auth::user();
        $dataUser = DataUser::where('user_id', $user->id)->first();

        $pinjaman = Pinjaman::where('mobil_id', $request->mobil_id)
            ->first();

        if (!$pinjaman) {
            return back()->with('error', 'Peminjaman Tidak Ditemukan')->withInput();
        }

        $lamanyaPinjaman = ceil(now()->diffInDays($pinjaman->tanggal_mulai));
        $biaya = abs($lamanyaPinjaman * $pinjaman->mobil->tarif);

        $pinjaman->delete();

        Riwayat::create([
            'data_user_id' => $dataUser->id,
            'mobil_id' => $pinjaman->mobil_id,
            'tanggal_pinjam' => $pinjaman->tanggal_mulai,
            'tanggal_kembali' => now()->format('Y-m-d'),
            'biaya' => $biaya
        ]);

        return redirect()->route('dashboard')->with('success', 'Pengembalian Berhasil');
    }
}
