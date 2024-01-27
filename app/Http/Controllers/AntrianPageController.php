<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\Pasien;
use App\Models\JadwalPeriksa;
use App\Models\Dokter;
use App\Models\Poli;
use Illuminate\Http\Request;

class AntrianPageController extends Controller
{
    public function index(Request $request)
    {
        $antrians = [];
        $polis = Poli::all();
        $dokters = Dokter::with('jadwal_periksas')->get();

        $request->validate([
            'id_dokter' => 'nullable|exists:dokter,id',
        ]);

        $jadwalDokter = JadwalPeriksa::where('id_dokter', $request->id_dokter)->first();
        
        if ($request->id_dokter) {
            $antrians = DaftarPoli::with('pasien', 'jadwal_periksa.dokter.poli')
                ->where('id_jadwal', $jadwalDokter->id)
                ->where('is_deleted', 0)
                ->where('no_antrian', '!=', null)
                ->orderBy('no_antrian', 'asc')->get();
        }

        return view('user.antrian.antrianpage', compact('polis', 'dokters', 'antrians'));
    }
}
