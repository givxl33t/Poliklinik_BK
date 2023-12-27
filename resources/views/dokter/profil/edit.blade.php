@extends('dokter.layouts.app')

@section('title', 'Edit Profil')

@section('content')
    <div class="container">
        @foreach ($dokters as $dokter)
        <div class="row">
            <div class="col">
                <h1 class="text-center">Edit Profil {{ $dokter->nama }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form action="/dokter/profil/{{ $dokter->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama & Gelar</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                            id="nama" aria-describedby="emailHelp" name="nama" value="{{ $dokter->nama }}">
                        <div id="emailHelp" class="form-text">Nama tidak boleh lebih dari 255 karakter</div>
                        @error('name')
                            <div class="invalid-feedback">
                                Nama tidak boleh kosong
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror"
                            id="alamat" name="alamat" value="{{ $dokter->alamat }}">
                        @error('address')
                            <div class="invalid-feedback">
                                Alamat tidak boleh kosong
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                            id="email" name="email" value="{{ $dokter->email }}">
                        @error('email')
                            <div class="invalid-feedback">
                                Email tidak boleh kosong
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" class="form-control @error('password') is-invalid @enderror"
                            id="password" name="password" value="{{ old('password') }}">
                        <div id="emailHelp" class="form-text">Masukkan Password baru untuk diubah</div>
                        @error('password')
                            <div class="invalid-feedback">
                                Password tidak boleh kosong
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No. HP</label>
                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                            id="no_hp" name="no_hp" value="{{ $dokter->no_hp }}">
                        @error('no_hp')
                            <div class="invalid-feedback">
                                No. HP tidak boleh kosong
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
@endsection
