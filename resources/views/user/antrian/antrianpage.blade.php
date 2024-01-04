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
                        <div class="mb-3">
                            <label for="poli" class="form-label">Poli</label>
                            <select class="form-select" aria-label="Default select example" name="poli" id="poliSelect">
                                <option selected>Pilih Poli</option>
                                @foreach ($polis as $poli)
                                    <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="id_dokter" class="form-label">Dokter & Jadwal</label>
                            <select class="form-select" aria-label="Default select example" name="id_dokter" id="dokterSelect">
                                <option selected>Pilih Dokter</option>
                                @foreach ($dokters as $dokter)
                                    // check if dokter has jadwal_periksas
                                    @if ($dokter->jadwal_periksas->count() > 0)
                                        // if dokter has jadwal_periksas, show dokter
                                        <option value="{{ $dokter->id }}" data-poli="{{ $dokter->poli->id }}">{{ $dokter->nama }} | {{ $dokter->jadwal_periksas[0]->hari }}
                                            | {{ $dokter->jadwal_periksas[0]->jam_mulai }} - {{ $dokter->jadwal_periksas[0]->jam_selesai }}</option>
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Cari</button>
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
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    // Get the Dokter select element
                    var dokterSelect = document.getElementById('dokterSelect');

                    // Get all Dokter options
                    var dokterOptions = dokterSelect.getElementsByTagName('option');

                    // Hide Dokter options initially
                    Array.from(dokterOptions).forEach(function (option) {
                        option.style.display = 'none';
                    });

                    // On change of Poli dropdown
                    document.getElementById('poliSelect').addEventListener('change', function () {
                        // Reset the Dokter dropdown
                        dokterSelect.value = 'Pilih Dokter';

                        var selectedPoli = this.value;

                        // Show only Dokters related to the selected Poli
                        Array.from(dokterOptions).forEach(function (option) {
                            var dokterPoli = option.getAttribute('data-poli');

                            // Show option only if it matches the selected Poli or is the default option
                            option.style.display = (dokterPoli === selectedPoli || dokterPoli === null) ? '' : 'none';
                        });
                    });
                });
            </script>
        </div>
    @endsection
