@extends('dokter.layouts.app')

@section('title', 'Riwayat Pasien')

@section('content')
    <div class="container">
            <div class="row my-5">
                <div class="col">
                    <h1 class="text-center">Riwayat Pasien</h1>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <form action="{{ url('dokter/riwayat') }}" method="GET">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Cari..." name="keyword" value="{{ request('keyword') }}">
                        </div>
                    </form>
                </div>
            </div>
            <div class="row my-5">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama Pasien</th>
                                        <th scope="col">Tanggal Periksa</th>
                                        <th scope="col">Keluhan</th>
                                        <th scope="col">Catatan</th>
                                        <th scope="col">Obat</th>
                                        <th scope="col">Nomor HP</th>
                                        <th scope="col">Biaya Periksa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach ($riwayats as $riwayat)
                                    <tr>
                                        <td>{{ $riwayat->daftar_poli->pasien->nama }}</td>
                                        <td>{{ $riwayat->tgl_periksa }}</td>
                                        <td>{{ $riwayat->daftar_poli->keluhan }}</td>
                                        <td>{{ $riwayat->catatan }}</td>
                                        <td>
                                            <ul>
                                                @foreach ($riwayat->detail_periksas as $detail_periksa)
                                                    <li>{{ $detail_periksa->obat->nama_obat }}
                                                        | {{ $detail_periksa->obat->kemasan }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>{{ $riwayat->daftar_poli->pasien->no_hp }}</td>
                                        <td>Rp{{ number_format($riwayat->biaya_periksa, 0, ',', '.') }}</td>
                                    </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
