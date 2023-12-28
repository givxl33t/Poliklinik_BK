<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Poli;
use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use App\Models\Dokter;

class LandingPageController extends Controller
{
    public function index() {
        $polis = Poli::all();
        $dokters = Dokter::with('jadwal_periksas')->get();

        return view('landingpage', compact('polis', 'dokters'));
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


        // return to landing page with success message
        return redirect(route('landingpage'))->with('success', 'Pasien berhasil didaftarkan!');
    }

    public function cekrekammedis(Request $request)
    {
        $request->validate([
            'no_ktp' => 'required|numeric',
        ]);

        $pasien = Pasien::where('no_ktp', $request->no_ktp)->first();

        if ($pasien) {
            return redirect(route('landingpage'))->with('success', 'Pasien ditemukan dengan nomor rekam medis ' . $pasien->no_rm);
        } else {
            return redirect(route('landingpage'))->with('error', 'Pasien tidak ditemukan!');
        }
    }

    public function storedaftarpoli(Request $request)
    {
        $request->validate([
            'no_rm' => 'required',
            'keluhan' => 'required',
            'id_dokter' => 'required',
        ]);

        $pasien = Pasien::where('no_rm', $request->no_rm)->first();

        $jadwalDokter = JadwalPeriksa::where('id_dokter', $request->id_dokter)->first();
        // return error if jadwal dokter not found
        if (!$jadwalDokter) {
            return redirect(route('landingpage'))->with('error', 'Jadwal dokter tidak ditemukan!');
        }

        $no_antrian = DaftarPoli::where('id_jadwal', $jadwalDokter->id)->count() + 1;

        if ($pasien) {
            DaftarPoli::create([
                'id_pasien' => $pasien->id,
                'id_jadwal' => $jadwalDokter->id,
                'keluhan' => $request->keluhan,
                'no_antrian' => $no_antrian,
            ]);

            return redirect(route('landingpage'))->with('success', 'Pasien berhasil mendaftar poli!');
        } else {
            return redirect(route('landingpage'))->with('error', 'Pasien tidak ditemukan!');
        }
    }


}
