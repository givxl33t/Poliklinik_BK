@extends('layouts.app')

@section('title', 'Antrian')

@section('content')
    {{-- hero --}}
    <div class="hero d-flex align-items-center">
        <div class="container-fluid">
            <div class="row">
                <div class="col text-center">
                    <h1 class="text-white fw-bold mb-4">Antrian e-Poli</h1>
                    <p class="text-white mb-5 text-opacity-75">
                        Berikut adalah daftar antrian pasien yang telah mendaftar
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- antrian --}}
    <div class="umkm">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h3 class="mb-3">Daftar Antrian</h3>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <form action="{{ url('antrianpage') }}" method="GET">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Cari..." name="keyword" value="{{ request('keyword') }}">
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No Antrian</th>
                                <th scope="col">Nama Pasien</th>
                                <th scope="col">Nama Poli</th>
                                <th scope="col">Hari</th>
                                <th scope="col">Jam Mulai</th>
                                <th scope="col">Jam Selesai</th>
                                <th scope="col">Keluhan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($antrians as $antrian)
                                <tr>
                                    <td>{{ $antrian->no_antrian }}</td>
                                    <td>{{ $antrian->pasien->nama }}</td>
                                    <td>{{ $antrian->jadwal_periksa->dokter->poli->nama_poli }}</td>                       
                                    <td>{{ $antrian->jadwal_periksa->hari }}</td>
                                    <td>{{ $antrian->jadwal_periksa->jam_mulai }}</td>
                                    <td>{{ $antrian->jadwal_periksa->jam_selesai }}</td>
                                    <td>{{ $antrian->keluhan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
