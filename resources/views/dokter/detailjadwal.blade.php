@extends('dokter.layouts.app')

@section('title', 'Detail Jadwal')

@section('content')
    <div class="container">
        <div class="row my-5">
            <div class="col">
                <h1 class="text-center">Detail Jadwal</h1>
            </div>
        </div>
        <div class="row gx-lg-5 d-flex align-items-center my-5">
            <div class="col-lg-6 mb-5">
                <img src="/css/clinic.jpg" class="img-fluid rounded">
            </div>
            <div class="col-lg-6">
                <h2>{{ $jadwal->dokter->poli->nama_poli }}</h2>
                <p>{{ $jadwal->dokter->poli->keterangan }}</p>
            </div>
        </div>
        <div class="row my-5">
            <div class="col">
                <div class="row">
                    <div class="col">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Hari</th>
                                    <th scope="col">Jam Mulai</th>
                                    <th scope="col">Jam Selesai</th>
                                    <th scope="col">Dokter</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $jadwal->hari }}</td>
                                    <td>{{ $jadwal->jam_mulai }}</td>
                                    <td>{{ $jadwal->jam_selesai }}</td>
                                    <td>{{ $jadwal->dokter->nama }}</td>
                                    <td>
                                        @if ($isToday)
                                            <div>Tidak Boleh Edit</div>
                                        @else
                                            <a href="/jadwalperiksa/detailjadwalperiksa/{{ $jadwal->id }}/edit"
                                                class="btn btn-md btn-primary">Edit Jadwal</a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
