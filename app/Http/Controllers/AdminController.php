<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Periksa;
use App\Models\Obat;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function createpasien()
    {
        $dokterCount = Dokter::count();
        $pasienCount = Pasien::count();
        $periksaCount = Periksa::count();
        $poliCount = Poli::count();
        $obatCount = Obat::count();
        return view('admin/pasien/addpasien', ['dokter_count' => $dokterCount, 'pasien_count' => $pasienCount, 'periksa_count' => $periksaCount,  'poli_count' => $poliCount, 'obat_count' => $obatCount]);
    }

    public function storepasien(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_ktp' => 'required|numeric|unique:pasien,no_ktp',
            'no_hp' => 'required|numeric',
        ]);
        
        $currentYear = date('Y');
        $currentMonth = date('m');
        $pasiensInCurrYearMonth = Pasien::whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->get();
        $newPasienOrderNumber = count($pasiensInCurrYearMonth) + 1;
        $no_rm = $currentYear . $currentMonth . '-' . $newPasienOrderNumber;

        while (Pasien::where('no_rm', $no_rm)->exists()) {
            $newPasienOrderNumber++;
            $no_rm = $currentYear . $currentMonth . '-' . $newPasienOrderNumber;
        }

        Pasien::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_ktp' => $request->no_ktp,
            'no_hp' => $request->no_hp,
            'no_rm' => $no_rm,
        ]);


        return redirect(route('showlistpasien'))->with('success', 'Pasien Berhasil Ditambahkan!');
    }

    public function editpasien($id)
    {
        $dokterCount = Dokter::count();
        $pasienCount = Pasien::count();
        $periksaCount = Periksa::count();
        $poliCount = Poli::count();
        $obatCount = Obat::count();
        $pasien = Pasien::find($id);
        return view('admin/pasien/editpasien', ['dokter_count' => $dokterCount, 'pasien_count' => $pasienCount, 'periksa_count' => $periksaCount,  'pasien' => $pasien, 'poli_count' => $poliCount, 'obat_count' => $obatCount]);
    }

    public function updatepasien(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_ktp' => 'required|numeric|unique:pasien,no_ktp,' . $id,
            'no_hp' => 'required|numeric',
        ]);

        $pasien = Pasien::find($id);
        $pasien->nama = $request->nama;
        $pasien->alamat = $request->alamat;
        $pasien->no_ktp = $request->no_ktp;
        $pasien->no_hp = $request->no_hp;
        $pasien->save();

        return redirect(route('showlistpasien'))->with('success', 'Pasien Berhasil Diubah!');
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

    public function createdokter()
    {
        $dokterCount = Dokter::count();
        $pasienCount = Pasien::count();
        $periksaCount = Periksa::count();
        $poliCount = Poli::count();
        $obatCount = Obat::count();

        $polis = Poli::get();

        return view('admin/dokter/adddokter', ['dokter_count' => $dokterCount, 'pasien_count' => $pasienCount, 'periksa_count' => $periksaCount,  'poli_count' => $poliCount, 'obat_count' => $obatCount, 'polis' => $polis]);
    }

    public function storedokter(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'email' => 'required|email|unique:dokter,email',
            'password' => 'required|min:8',
            'no_hp' => 'required|numeric',
            'id_poli' => 'required',
        ]);

        // hash password
        $password = Hash::make($request->password);

        $data = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'password' => $password,
            'no_hp' => $request->no_hp,
            'id_poli' => $request->id_poli,
        ];

        Dokter::create($data);

        return redirect(route('showlistdokter'))->with('success', 'Dokter Berhasil Ditambahkan!');
    }

    public function editdokter($id)
    {
        $dokterCount = Dokter::count();
        $pasienCount = Pasien::count();
        $periksaCount = Periksa::count();
        $poliCount = Poli::count();
        $obatCount = Obat::count();

        $polis = Poli::get();
        $dokter = Dokter::find($id);

        return view('admin/dokter/editdokter', ['dokter_count' => $dokterCount, 'pasien_count' => $pasienCount, 'periksa_count' => $periksaCount,  'poli_count' => $poliCount, 'obat_count' => $obatCount, 'polis' => $polis, 'dokter' => $dokter]);
    }
    
    public function updatedokter(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'email' => 'required|email|unique:dokter,email,' . $id,
            'no_hp' => 'required|numeric',
            'id_poli' => 'required',
        ]);

        if ($request->filled('password')) {
            $rules['password'] = 'required|min:8';
        }

        $data = [
            'nama' => $validated['nama'],
            'alamat' => $validated['alamat'],
            'email' => $validated['email'],
            'no_hp' => $validated['no_hp'],
            'id_poli' => $validated['id_poli'],
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }

        $dokter = Dokter::find($id);
        $dokter->update($data);

        return redirect(route('showlistdokter'))->with('success', 'Dokter Berhasil Diubah!');
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

        $polis = Poli::with(['dokters'])
            ->where('nama_poli', 'LIKE', '%' . $keyword . '%')
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

    public function createpoli()
    {
        $dokterCount = Dokter::count();
        $pasienCount = Pasien::count();
        $periksaCount = Periksa::count();
        $poliCount = Poli::count();
        $obatCount = Obat::count();
        return view('admin/poli/addpoli', ['dokter_count' => $dokterCount, 'pasien_count' => $pasienCount, 'periksa_count' => $periksaCount,  'poli_count' => $poliCount, 'obat_count' => $obatCount]);
    }

    public function storepoli(Request $request)
    {
        $request->validate([
            'nama_poli' => 'required',
            'keterangan' => 'required',
        ]);

        Poli::create([
            'nama_poli' => $request->nama_poli,
            'keterangan' => $request->keterangan,
        ]);

        return redirect(route('showlistpoli'))->with('success', 'Poliklinik Berhasil Ditambahkan!');
    }

    public function editpoli($id)
    {
        $dokterCount = Dokter::count();
        $pasienCount = Pasien::count();
        $periksaCount = Periksa::count();
        $poliCount = Poli::count();
        $obatCount = Obat::count();
        $poli = Poli::find($id);
        return view('admin/poli/editpoli', ['dokter_count' => $dokterCount, 'pasien_count' => $pasienCount, 'periksa_count' => $periksaCount,  'poli' => $poli, 'poli_count' => $poliCount, 'obat_count' => $obatCount]);
    }

    public function updatepoli(Request $request, $id)
    {
        $request->validate([
            'nama_poli' => 'required',
            'keterangan' => 'required',
        ]);

        $poli = Poli::find($id);
        $poli->nama_poli = $request->nama_poli;
        $poli->keterangan = $request->keterangan;
        $poli->save();

        return redirect(route('showlistpoli'))->with('success', 'Poliklinik Berhasil Diubah!');
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
