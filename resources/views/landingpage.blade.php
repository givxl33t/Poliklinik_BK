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
        <div class="row">
            <div class="col">
                <h3 class="mb-3">Daftar Pasien</h3>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form action="#" method="POST">
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
                <br>
            </div>
        </div>
    </div>
</div>

</div>


@endsection