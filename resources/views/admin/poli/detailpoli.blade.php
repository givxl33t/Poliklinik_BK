@extends('admin.app')

@section('title', 'Detail Poli')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detail Poli</h3>
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
            <h1>Data {{ $poli->nama_poli }}</h1>
            <div class="my-5">
                <div class="header">
                    <h3>Data Poli</h3>
                    <p class="text-secondary">Data lengkap Poli {{ $poli->nama_poli }}</p>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nama Poli</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Tanggal Ditambah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="align-items-center">
                            <td>{{ $poli->nama_poli }}</td>
                            <td>{{ $poli->keterangan }}</td>
                            <td>{{ $poli->created_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="my-5">
                <div class="header">
                    <h3>Data Dokter</h3>
                    <p class="text-secondary">Data dokter yang ditugaskan di {{ $poli->nama_poli }}</p>
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
                        @foreach ($poli->dokters as $dokter)
                            <tr class="align-items-center">
                                <td>{{ $dokter->nama }}</td>
                                <td>{{ $dokter->email }}</td>
                                <td>{{ $dokter->alamat }}</td>
                                <td>{{ $dokter->no_hp }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
