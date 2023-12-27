<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Periksa;
use App\Models\Obat;
use App\Models\Poli;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $dokterCount = Dokter::count();
        $pasienCount = Pasien::count();
        $periksaCount = Periksa::count();
        $poliCount = Poli::count();
        $obatCount = Obat::count();

        return view('admin/app', ['dokter_count' => $dokterCount, 'pasien_count' => $pasienCount, 'periksa_count' => $periksaCount, 'poli_count' => $poliCount, 'obat_count' => $obatCount]);
    }

    public function listpasien(Request $request)
    {
        $dokterCount = Dokter::count();
        $pasienCount = Pasien::count();
        $periksaCount = Periksa::count();
        $poliCount = Poli::count();
        $obatCount = Obat::count();

        $keyword = $request->keyword;
        $pasiens = Pasien::where('nama', 'LIKE', '%' . $keyword . '%')
            ->simplePaginate(20);

        return view('admin/pasien/listpasien', ['dokter_count' => $dokterCount, 'pasien_count' => $pasienCount, 'periksa_count' => $periksaCount, 'pasiens' => $pasiens, 'poli_count' => $poliCount, 'obat_count' => $obatCount]);
    }

    public function detailpasien($id)
    {
        $dokterCount = Dokter::count();
        $pasienCount = Pasien::count();
        $periksaCount = Periksa::count();
        $poliCount = Poli::count();
        $obatCount = Obat::count();
        $pasien = Pasien::with(['daftar_polis'])
            ->findOrfail($id);

        return view('admin/pasien/detailpasien', ['dokter_count' => $dokterCount, 'pasien_count' => $pasienCount, 'periksa_count' => $periksaCount, 'pasien' => $pasien, 'poli_count' => $poliCount, 'obat_count' => $obatCount]);
    }

    public function destroypasien($id)
    {
        Pasien::destroy($id);
        return redirect(route('showlistpasien'))->with('success', 'Pasien Berhasil Dihapus!');
    }

    public function listdokter(Request $request)
    {
        $dokterCount = Dokter::count();
        $pasienCount = Pasien::count();
        $periksaCount = Periksa::count();
        $poliCount = Poli::count();
        $obatCount = Obat::count();

        $keyword = $request->keyword;
        $dokters = Dokter::where('nama', 'LIKE', '%' . $keyword . '%')
            ->simplePaginate(20);

        return view('admin/dokter/listdokter', ['dokter_count' => $dokterCount, 'pasien_count' => $pasienCount, 'periksa_count' => $periksaCount, 'dokters' => $dokters, 'poli_count' => $poliCount, 'obat_count' => $obatCount]);
    }

    public function detaildokter($id)
    {
        $dokterCount = Dokter::count();
        $pasienCount = Pasien::count();
        $periksaCount = Periksa::count();
        $poliCount = Poli::count();
        $obatCount = Obat::count();
        $dokter = Dokter::with(['jadwal_periksas'])
            ->findOrfail($id);

        return view('admin/dokter/detaildokter', ['dokter_count' => $dokterCount, 'pasien_count' => $pasienCount, 'periksa_count' => $periksaCount, 'dokter' => $dokter, 'poli_count' => $poliCount, 'obat_count' => $obatCount]);
    }

    public function destroydokter($id)
    {
        Dokter::destroy($id);
        return redirect(route('showlistdokter'))->with('success', 'Dokter Berhasil Dihapus!');
    }

    public function listpoli(Request $request)
    {
        $dokterCount = Dokter::count();
        $pasienCount = Pasien::count();
        $periksaCount = Periksa::count();
        $poliCount = Poli::count();
        $obatCount = Obat::count();

        $keyword = $request->keyword;
        $polis = Poli::where('nama_poli', 'LIKE', '%' . $keyword . '%')
            ->simplePaginate(20);

        return view('admin/poli/listpoli', ['dokter_count' => $dokterCount, 'pasien_count' => $pasienCount, 'periksa_count' => $periksaCount, 'polis' => $polis, 'poli_count' => $poliCount, 'obat_count' => $obatCount]);
    }

    public function detailpoli($id)
    {
        $dokterCount = Dokter::count();
        $pasienCount = Pasien::count();
        $periksaCount = Periksa::count();
        $poliCount = Poli::count();
        $obatCount = Obat::count();
        $poli = Poli::with(['dokters'])
            ->findOrfail($id);

        return view('admin/poli/detailpoli', ['dokter_count' => $dokterCount, 'pasien_count' => $pasienCount, 'periksa_count' => $periksaCount, 'poli' => $poli, 'poli_count' => $poliCount, 'obat_count' => $obatCount]);
    }

    public function destroypoli($id)
    {
        Poli::destroy($id);
        return redirect(route('showlistpoli'))->with('success', 'Poliklinik Berhasil Dihapus!');
    }

    public function listobat(Request $request)
    {
        $dokterCount = Dokter::count();
        $pasienCount = Pasien::count();
        $periksaCount = Periksa::count();
        $poliCount = Poli::count();
        $obatCount = Obat::count();

        $keyword = $request->keyword;
        $obats = Obat::where('nama_obat', 'LIKE', '%' . $keyword . '%')
            ->simplePaginate(20);

        return view('admin/obat/listobat', ['dokter_count' => $dokterCount, 'pasien_count' => $pasienCount, 'periksa_count' => $periksaCount, 'obats' => $obats, 'poli_count' => $poliCount, 'obat_count' => $obatCount]);
    }

    public function createobat()
    {
        $dokterCount = Dokter::count();
        $pasienCount = Pasien::count();
        $periksaCount = Periksa::count();
        $poliCount = Poli::count();
        $obatCount = Obat::count();
        return view('admin/obat/addobat', ['dokter_count' => $dokterCount, 'pasien_count' => $pasienCount, 'periksa_count' => $periksaCount, 'poli_count' => $poliCount, 'obat_count' => $obatCount]);
    }

    public function storeobat(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required',
            'kemasan' => 'required',
            'harga' => 'required',
        ]);

        Obat::create([
            'nama_obat' => $request->nama_obat,
            'kemasan' => $request->kemasan,
            'harga' => $request->harga,
        ]);

        return redirect(route('showlistobat'))->with('success', 'Obat Berhasil Ditambahkan!');
    }

    public function editobat($id)
    {
        $dokterCount = Dokter::count();
        $pasienCount = Pasien::count();
        $periksaCount = Periksa::count();
        $poliCount = Poli::count();
        $obatCount = Obat::count();
        $obat = Obat::find($id);
        return view('admin/obat/editobat', ['dokter_count' => $dokterCount, 'pasien_count' => $pasienCount, 'periksa_count' => $periksaCount, 'obat' => $obat, 'poli_count' => $poliCount, 'obat_count' => $obatCount]);
    }

    public function updateobat(Request $request, $id)
    {
        $request->validate([
            'nama_obat' => 'required',
            'kemasan' => 'required',
            'harga' => 'required',
        ]);

        $obat = Obat::find($id);
        $obat->nama_obat = $request->nama_obat;
        $obat->kemasan = $request->kemasan;
        $obat->harga = $request->harga;
        $obat->save();

        return redirect(route('showlistobat'))->with('success', 'Obat Berhasil Diubah!');
    }

    public function destroyobat($id)
    {
        Obat::destroy($id);
        return redirect(route('showlistobat'))->with('success', 'Obat Berhasil Dihapus!');
    }
}
