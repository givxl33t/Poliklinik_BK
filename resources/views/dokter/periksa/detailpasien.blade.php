@extends('dokter.layouts.app')

@section('title', 'Detail Pasien')

@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col">
            <h1 class="text-center">Detail Pasien</h1>
        </div>
    </div>
    <div class="row gx-lg-5 d-flex align-items-center my-5">
        <div class="col-lg-6 mb-5">
            <img src="/css/patient.jpg" class="img-fluid rounded">
        </div>
        <div class="col-lg-6">
            <h2>{{ $daftarpoli->pasien->nama }}</h2>
            <p>{{ $daftarpoli->pasien->no_rm }}</p>
        </div>
    </div>
    <div class="row my-5">
        <div class="col">
            <div class="row">
                <div class="col">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Keluhan</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Nomor HP</th>
                                <th scope="col">Hari Periksa</th>
                                <th scope="col">Jam Periksa</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $daftarpoli->keluhan }}</td>
                                <td>{{ $daftarpoli->pasien->alamat }}</td>
                                <td>{{ $daftarpoli->pasien->no_hp }}</td>
                                <td>{{ $daftarpoli->jadwal_periksa->hari }}</td>
                                <td>{{ $daftarpoli->jadwal_periksa->jam_mulai }} -
                                    {{ $daftarpoli->jadwal_periksa->jam_selesai }}
                                </td>
                                <td>
                                    @if (empty($daftarpoli->periksas))
                                    <a href="/dokter/periksa/detailpasien/{{ $daftarpoli->id }}/add" class="btn btn-md btn-primary">Periksa</a>
                                    @else
                                    <div>Tidak Ada Aksi</div>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @if (empty($daftarpoli->periksas))
                @else
                <div class="col my-5">
                    <h1 class="text-center mb-5">Detail Pemeriksaan</h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Tanggal Periksa</th>
                                <th scope="col">Catatan</th>
                                <th scope="col">Obat</th>
                                <th scope="col">Biaya Periksa</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $daftarpoli->periksas->tgl_periksa }}</td>
                                <td>{{ $daftarpoli->periksas->catatan }}</td>
                                <td>
                                    <ul>
                                        @foreach ($daftarpoli->periksas->detail_periksas as $detail_periksa)
                                        <li>{{ $detail_periksa->obat->nama_obat }}
                                            | {{ $detail_periksa->obat->kemasan }}
                                        </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>Rp{{ number_format($daftarpoli->periksas->biaya_periksa, 0, ',', '.') }}</td>
                                <td>
                                    <a href="/dokter/periksa/detailpasien/{{ $daftarpoli->periksas->id }}/edit" class="btn btn-md btn-warning">Edit</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>

</div>
@endsection