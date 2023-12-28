@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<div class="px-5">
    {{-- hero --}}
<div class="banner">
    <div class="container">
        <div class="row a align-items-center">
            <div class="col mx-5">
                <h1 class="fw-bold mb-4">Selamat Datang di e-Poli <br>
                     Appointment System</h1>
                <p class="mb-5 ">
                    Website e-Poli adalah sistem temu janji pasien dokter, bergabunglah <br>
                    sekarang dan nikmati pengalaman mengatur janji yang lebih efisien <br>
                    dan terorganisir.
                </p>
            </div>
        </div>
    </div>
</div>

{{-- daftar pasien --}}
<div class="category">
    <div class="container">
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="col">
                <h3 class="mb-3">Daftar Pasien</h3>
                <form action="{{ url('/') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}">
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{ old('alamat') }}">
                        @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="no_ktp" class="form-label">Nomor KTP</label>
                        <input type="text" class="form-control @error('no_ktp') is-invalid @enderror" id="no_ktp" name="no_ktp" value="{{ old('no_ktp') }}">
                        @error('no_ktp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">Nomor HP</label>
                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ old('no_hp') }}">
                        @error('no_hp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Daftar</button>
                </form>
            </div>
            <div class="col">
                <h3 class="mb-3">Cek Rekam Medis</h3>
                <form action="{{ url('/cekrekammedis') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="no_ktp" class="form-label">Nomor KTP</label>
                        <input type="text" class="form-control @error('no_ktp') is-invalid @enderror" id="no_ktp" name="no_ktp" value="{{ old('no_ktp') }}">
                        @error('no_ktp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
            </div>
        </div>
        <hr class="solid">
        <h3 class="mb-3  text-center">Daftar Poli</h3>
        <form action="{{ url('/daftarpoli') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <div class="col">
                    <div class="mb-3">
                        <label for="no_rm" class="form-label">Nomor Rekam Medis</label>
                        <input type="text" class="form-control @error('no_rm') is-invalid @enderror" id="no_rm" name="no_rm" value="{{ old('no_rm') }}">
                        @error('no_rm')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="keluhan" class="form-label">Keluhan</label>
                        <input type="text" class="form-control @error('keluhan') is-invalid @enderror" id="keluhan" name="keluhan" value="{{ old('keluhan') }}">
                        @error('keluhan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col">
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
            </div>
            <button type="submit" class="btn btn-primary">Daftar</button>
        </form>
        <br/>
    </div>
</div>

</div>


@endsection