<?php

namespace App\Http\Controllers;

use App\Models\Periksa;
use App\Models\DaftarPoli;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeriksaController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        
        $daftarpolis = DaftarPoli::with(['pasien', 'jadwal_periksa', 'periksas'])
            ->whereHas('jadwal_periksa', function ($query) use ($id) {
                $query->where('id_dokter', $id);
            })->orderBy('no_antrian', 'asc')->get();
        
        return view('dokter.periksa.index', compact('daftarpolis'));
    }

    public function detailpasien($id)
    {
        $daftarpoli = DaftarPoli::with(['jadwal_periksa', 'periksas.detail_periksas'])
            ->whereHas('pasien', function ($query) use ($id) {
                $query->where('id', $id);
            })
            ->first();

        return view('dokter.periksa.detailpasien', compact('daftarpoli'));
    }

    public function createperiksa($iddaftarpoli)
    {
        $obats = Obat::all();

        return view('dokter.periksa.add', compact('obats' , 'iddaftarpoli'));
    }

    // handle store with dynamic form on obat input
    public function storeperiksa(Request $request)
    {
        $request->validate([
            'id_daftar_poli' => 'required',
            'tgl_periksa' => 'required',
            'catatan' => 'required',
            'obats' => 'required|array',
        ]);

        // generate biaya periksa with 150000 + obat price
        $biaya = 150000;
        $obat = $request->obats;

        for ($i = 0; $i < count($obat); $i++) {
            $biaya += Obat::find($obat[$i])->harga;
        }

        $periksa = Periksa::create([
            'id_daftar_poli' => $request->id_daftar_poli,
            'tgl_periksa' => $request->tgl_periksa,
            'catatan' => $request->catatan,
            'biaya_periksa' => $biaya,
        ]);

        for ($i = 0; $i < count($obat); $i++) {
            $periksa->detail_periksas()->create([
                'id_obat' => $obat[$i],
            ]);
        }

        $daftarpoli = DaftarPoli::find($request->id_daftar_poli);
        $pasienId = $daftarpoli->pasien->id;

        return redirect('/dokter/periksa/detailpasien/'. $pasienId)->with('success', 'Data periksa berhasil ditambahkan');
    }

    public function editperiksa($id)
    {
        $periksa = Periksa::with('detail_periksas')->find($id);
        $obats = Obat::all();

        return view('dokter.periksa.edit', compact('periksa', 'obats'));
    }

    public function updateperiksa(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required',
            'obats' => 'required|array',
        ]);

        // generate biaya periksa with 150000 + obat price
        $biaya = 150000;
        $obat = $request->obats;

        for ($i = 0; $i < count($obat); $i++) {
            $biaya += Obat::find($obat[$i])->harga;
        }

        $periksa = Periksa::find($id);
        $periksa->update([
            'catatan' => $request->catatan,
            'biaya_periksa' => $biaya,
        ]);

        $periksa->detail_periksas()->delete();

        for ($i = 0; $i < count($obat); $i++) {
            $periksa->detail_periksas()->create([
                'id_obat' => $obat[$i],
            ]);
        }

        $daftarpoli = DaftarPoli::find($periksa->id_daftar_poli);
        $pasienId = $daftarpoli->pasien->id;

        return redirect('/dokter/periksa/detailpasien/'. $pasienId)->with('success', 'Data periksa berhasil diubah');
    }
}
