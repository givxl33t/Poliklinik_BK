@extends('admin.app')

@section('title', 'Detail Owner')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detail Dokter</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body p-5">
            <h1>Data {{ $dokter->nama }}</h1>
            <div class="my-5">
                <div class="header">
                    <h3>Data Profil</h3>
                    <p class="text-secondary">Data lengkap dokter {{ $dokter->nama }}</p>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Nomor HP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="align-items-center">
                            <td>{{ $dokter->nama }}</td>
                            <td>{{ $dokter->email }}</td>
                            <td>{{ $dokter->alamat }}</td>
                            <td>{{ $dokter->no_hp }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="my-5">
                <div class="header">
                    <h3>Data Jadwal</h3>
                    <p class="text-secondary">Data jadwal dokter {{ $dokter->nama }}</p>
                </div>
                @php
                    $total_price = 0;
                @endphp
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Status</th>
                            <th scope="col">Hari</th>
                            <th scope="col">Jam Mulai</th>
                            <th scope="col">Jam Selesai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dokter->jadwal_periksas as $jadwal)
                            <tr class="align-items-center">
                                <td>{{ $jadwal->id }}</td>
                                @if ($jadwal->aktif == 'Y')
                                    <td><span class="badge badge-success">Aktif</span></td>
                                @else
                                    <td><span class="badge badge-danger">Tidak Aktif</span></td> 
                                @endif
                                <td>{{ $jadwal->hari }}</td>
                                <td>{{ $jadwal->jam_mulai }}</td>
                                <td>{{ $jadwal->jam_selesai }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
