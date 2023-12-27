<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Periksa;
use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DokterController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $periksas = JadwalPeriksa::where('id_dokter', $id)
            ->with(['daftar_polis', 'daftar_polis.pasien'])
            ->get();

        return view('dokter/index', ['periksas' => $periksas]);
    }

    public function createjadwal()
    {
        $id = Auth::user()->id;
        $dokters = Dokter::all()->where('id', $id);

        return view('dokter/add', ['dokters' => $dokters]);
    }

    public function storejadwal(Request $request)
    {
        // validasi form
        $validated = $request->validate([
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        //menambahkan data ke database
        JadwalPeriksa::create([
            'hari' => $validated['hari'],
            'jam_mulai' => $validated['jam_mulai'],
            'jam_selesai' => $validated['jam_selesai'],
            'id_dokter' => $request->id_dokter,
        ]);

        return redirect('/dokter')->with('success', 'Jadwal Periksa Berhasil Dibuat!');
    }

    // edit profil dokter
    public function editdokter()
    {
        $id = Auth::user()->id;
        $dokters = Dokter::all()->where('id', $id);

        return view('dokter/profil/edit', ['dokters' => $dokters]);
    }

    public function updatedokter(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'email' => 'required|email|unique:dokter,email,' . $request->id,
            'no_hp' => 'required',
        ]);

        if ($request->filled('password')) {
            $rules['password'] = 'required|min:8|confirmed';
        }

        $data = [
            'nama' => $validated['nama'],
            'alamat' => $validated['alamat'],
            'email' => $validated['email'],
            'no_hp' => $validated['no_hp'],
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }

        Dokter::where('id', $request->id)->update($data);

        return redirect('/dokter')->with('success', 'Profil Berhasil Diubah!');
    }
}
