<?php

namespace App\Http\Controllers;

use App\Models\DataUser;
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

        return view('dashboard', compact('dataUser'));
    }
}
