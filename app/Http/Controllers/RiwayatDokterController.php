<?php

namespace App\Http\Controllers;

use App\Models\Periksa;
use Illuminate\Support\Facades\Auth;

class RiwayatDokterController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;

        $keyword = request('keyword');
        
        $riwayats = Periksa::with('daftar_poli.pasien', 'detail_periksas')
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
