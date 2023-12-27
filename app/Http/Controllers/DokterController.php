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

    public function detailjadwalperiksa($id)
    {
        $jadwal = JadwalPeriksa::where('id', $id)
            ->with(['dokter.poli'])
            ->first();

        // get day with indonesian timezone
        $today = date('l', strtotime(now('+07:00')));

        if ($today == 'Monday') {
            $today = 'Senin';
        } else if ($today == 'Tuesday') {
            $today = 'Selasa';
        } else if ($today == 'Wednesday') {
            $today = 'Rabu';
        } else if ($today == 'Thursday') {
            $today = 'Kamis';
        } else if ($today == 'Friday') {
            $today = 'Jumat';
        } else if ($today == 'Saturday') {
            $today = 'Sabtu';
        }

        $isToday = $today == $jadwal->hari;

        return view('dokter/detailjadwal', ['jadwal' => $jadwal, 'isToday' => $isToday]);
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

        $id = Auth::user()->id;
        $jadwal = JadwalPeriksa::where('id_dokter', $id)->first();
        if ($jadwal) {
            return redirect('/dokter')->with('error', 'Jadwal Periksa Sudah Ada!');
        }

        $dokters = Dokter::with(['poli'])->where('id', $id)->get();
        $poliId = $dokters[0]->poli->id;

        // get all jadwals from the same poli as the dokter
        $jadwals = JadwalPeriksa::with(['dokter.poli'])
        ->whereHas('dokter', function ($query) use ($poliId) {
            $query->where('id_poli', $poliId);
        })->get();

        // make sure the new jadwal doesn't overlap with the existing ones
        foreach ($jadwals as $jadwal) {
            if ($jadwal->hari == $validated['hari']) {
                if ($jadwal->jam_mulai <= $validated['jam_mulai'] && $jadwal->jam_selesai >= $validated['jam_mulai']) {
                    return redirect('/dokter')->with('error', 'Jadwal Periksa Tidak Boleh Tumpang Tindih!');
                } else if ($jadwal->jam_mulai <= $validated['jam_selesai'] && $jadwal->jam_selesai >= $validated['jam_selesai']) {
                    return redirect('/dokter')->with('error', 'Jadwal Periksa Tidak Boleh Tumpang Tindih!');
                } else if ($jadwal->jam_mulai >= $validated['jam_mulai'] && $jadwal->jam_selesai <= $validated['jam_selesai']) {
                    return redirect('/dokter')->with('error', 'Jadwal Periksa Tidak Boleh Tumpang Tindih!');
                } else if ($jadwal->jam_mulai <= $validated['jam_mulai'] && $jadwal->jam_selesai >= $validated['jam_selesai']) {
                    return redirect('/dokter')->with('error', 'Jadwal Periksa Tidak Boleh Tumpang Tindih!');
                } else if ($jadwal->jam_mulai >= $validated['jam_mulai'] && $jadwal->jam_selesai <= $validated['jam_selesai']) {
                    return redirect('/dokter')->with('error', 'Jadwal Periksa Tidak Boleh Tumpang Tindih!');
                }
            }
        }

        JadwalPeriksa::create([
            'hari' => $validated['hari'],
            'jam_mulai' => $validated['jam_mulai'],
            'jam_selesai' => $validated['jam_selesai'],
            'id_dokter' => $request->id_dokter,
        ]);

        return redirect('/dokter')->with('success', 'Jadwal Periksa Berhasil Dibuat!');
    }

    public function editjadwal($id)
    {
        $jadwal = JadwalPeriksa::where('id', $id)->first();

        return view('dokter/edit', ['jadwal' => $jadwal]);
    }

    public function updatejadwal(Request $request)
    {
        // validasi form
        $validated = $request->validate([
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $id = Auth::user()->id;
        $jadwal = JadwalPeriksa::where('id_dokter', $id)->first();
        if (!$jadwal) {
            return redirect('/dokter')->with('error', 'Jadwal Periksa Tidak Ditemukan!');
        }

        $dokters = Dokter::with(['poli'])->where('id', $id)->get();
        $poliId = $dokters[0]->poli->id;

        // get all jadwals from the same poli as the dokter
        $jadwals = JadwalPeriksa::with(['dokter.poli'])
        ->whereHas('dokter', function ($query) use ($poliId) {
            $query->where('id_poli', $poliId);
        })->get();

        // exclude current jadwal from the list
        $jadwals = $jadwals->filter(function ($value, $key) use ($jadwal) {
            return $value->id != $jadwal->id;
        });

        // make sure the new jadwal doesn't overlap with the existing ones
        foreach ($jadwals as $jadwal) {
            if ($jadwal->hari == $validated['hari']) {
                if ($jadwal->jam_mulai <= $validated['jam_mulai'] && $jadwal->jam_selesai >= $validated['jam_mulai']) {
                    return redirect('/dokter')->with('error', 'Jadwal Periksa Tidak Boleh Tumpang Tindih!');
                } else if ($jadwal->jam_mulai <= $validated['jam_selesai'] && $jadwal->jam_selesai >= $validated['jam_selesai']) {
                    return redirect('/dokter')->with('error', 'Jadwal Periksa Tidak Boleh Tumpang Tindih!');
                } else if ($jadwal->jam_mulai >= $validated['jam_mulai'] && $jadwal->jam_selesai <= $validated['jam_selesai']) {
                    return redirect('/dokter')->with('error', 'Jadwal Periksa Tidak Boleh Tumpang Tindih!');
                } else if ($jadwal->jam_mulai <= $validated['jam_mulai'] && $jadwal->jam_selesai >= $validated['jam_selesai']) {
                    return redirect('/dokter')->with('error', 'Jadwal Periksa Tidak Boleh Tumpang Tindih!');
                } else if ($jadwal->jam_mulai >= $validated['jam_mulai'] && $jadwal->jam_selesai <= $validated['jam_selesai']) {
                    return redirect('/dokter')->with('error', 'Jadwal Periksa Tidak Boleh Tumpang Tindih!');
                }
            }
        }

        JadwalPeriksa::where('id', $request->id)->update([
            'hari' => $validated['hari'],
            'jam_mulai' => $validated['jam_mulai'],
            'jam_selesai' => $validated['jam_selesai'],
        ]);

        return redirect('/dokter')->with('success', 'Jadwal Periksa Berhasil Diubah!');
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
            $rules['password'] = 'required|min:8';
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
