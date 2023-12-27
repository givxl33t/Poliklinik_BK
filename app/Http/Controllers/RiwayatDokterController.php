<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Periksa;
use App\Models\DaftarPoli;
use App\Models\Pasien;
use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class RiwayatDokterController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;

        $keyword = request('keyword');
        
        $riwayats = Periksa::with('daftar_poli.pasien')
          ->whereHas('daftar_poli.jadwal_periksa', function ($query) use ($id) {
            $query->where('id_dokter', $id);
          })
          ->whereHas('daftar_poli.pasien', function ($query) use ($keyword) {
            $query->where('nama', 'like', "%$keyword%");
          })
          ->get();
        
        return view('dokter.riwayat.index', compact('riwayats'));
    }
}
