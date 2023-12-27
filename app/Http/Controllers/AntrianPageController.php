<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\Pasien;
use App\Models\JadwalPeriksa;
use App\Models\Poli;
use Illuminate\Http\Request;

class AntrianPageController extends Controller
{
    public function index(Request $request)
    {
        $antrians = DaftarPoli::with('pasien', 'jadwal_periksa')->orderBy('no_antrian', 'asc')->get();

        // keyword nama pasien
        if ($request->has('keyword')) {
            $antrians = DaftarPoli::with('pasien', 'jadwal_periksa')->whereHas('pasien', function ($query) use ($request) {
                $query->where('nama', 'like', "%{$request->keyword}%");
            })->orderBy('no_antrian', 'asc')->get();
        }

        return view('user.antrian.antrianpage', compact('antrians'));
    }
}
