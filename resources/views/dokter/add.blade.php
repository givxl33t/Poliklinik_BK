@extends('dokter.layouts.app')

@section('title', 'Tambah jadwal Periksa')

@section('content')
    <div class="text-center my-5">
        <h3>Tambah Jadwal Periksa</h3>
    </div>
    <!-- Create Post Form -->
    <form action="{{ url('/jadwalperiksa') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="hari" class="form-label">Pilih Hari</label>
            <select class="form-select  @error('hari') is-invalid @enderror" aria-label="Default select example"
                name="hari" id="hari">
                <option>Pilih Hari</option>
                <option value="Senin">Senin</option>
                <option value="Selasa">Selasa</option>
                <option value="Rabu">Rabu</option>
                <option value="Kamis">Kamis</option>
                <option value="Jumat">Jumat</option>
                <option value="Sabtu">Sabtu</option>
            </select>
            @error('hari')
                <div class="invalid-feedback">
                    Hari tidak boleh kosong
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="jam_mulai" class="form-label">Jam Mulai</label>
            // input time
            <input type="time" class="form-control @error('jam_mulai') is-invalid @enderror" id="jam_mulai"
                name="jam_mulai">
            @error('jam_mulai')
                <div class="invalid-feedback">
                    Jam Mulai tidak boleh kosong
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="jam_selesai" class="form-label">Jam Selesai</label>
            // input time
            <input type="time" class="form-control @error('jam_selesai') is-invalid @enderror" id="jam_selesai"
                name="jam_selesai">
            @error('jam_selesai')
                <div class="invalid-feedback">
                    Jam Selesai tidak boleh kosong
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="aktif" class="form-label">Status</label>
            <select class="form-select  @error('aktif') is-invalid @enderror" aria-label="Default select example"
                name="aktif" id="aktif">
                <option value="Y">Aktif</option>
                <option value="N">Tidak Aktif</option>
            </select>
            @error('aktif')
                <div class="invalid-feedback">
                    Status tidak boleh kosong
                </div>
            @enderror
        </div>
        @foreach ($dokters as $dokter)
            <input type="hidden" name="id_dokter" id="id_dokter" value="{{ $dokter->id }}">
        @endforeach
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
@endsection
