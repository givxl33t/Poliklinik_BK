@extends('admin.app')

@section('title', 'Detail Pasien')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detail Pasien</h3>
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
            <h1>Data {{ $pasien->nama }}</h1>
            <div class="my-5">
                <div class="header">
                    <h3>Data Profile</h3>
                    <p class="text-secondary">Data lengkap user {{ $pasien->nama }}</p>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Nomor KTP</th>
                            <th scope="col">Nomor HP</th>
                            <th scope="col">Nomor RM</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="align-items-center">
                            <td>{{ $pasien->nama }}</td>
                            <td>{{ $pasien->alamat }}</td>
                            <td>{{ $pasien->no_ktp }}</td>
                            <td>{{ $pasien->no_hp }}</td>
                            <td>{{ $pasien->no_rm }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="my-5">
                <div class="header">
                    <h3>Data Daftar Poli</h3>
                    <p class="text-secondary">Data daftar poliklinik yang telah dilakukan {{ $pasien->nama }}</p>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Keluhan</th>
                            <th scope="col">No Antrian</th>
                            <th scope="col">Tanggal Daftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pasien->daftar_polis as $daftar)
                            <tr class="align-items-center">
                                <td>{{ $daftar->id }}</td>
                                <td>{{ $daftar->keluhan }}</td>
                                <td>{{ $daftar->no_antrian }}</td>
                                <td>{{ $daftar->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
