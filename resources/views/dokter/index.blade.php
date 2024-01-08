@extends('dokter.layouts.app')

@section('title', 'Daftar Jadwal')

@section('content')
    <div class="container">
        <div class="row my-5">
            <div class="col">
                <h1 class="text-center">Daftar Jadwal</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a href="{{ 'jadwalperiksa/add' }}" class="btn btn-primary my-4" type="button">+ Tambah Jadwal
                    Periksa</a>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @if ($periksas->isEmpty())
                <p><i class="text-warning">Anda belum menambahkan jadwal periksa Anda, silahkan tekan tombol di atas
                        untuk menambahkan
                        jadwal periksa Anda</i></p>
            @else
                @foreach ($periksas as $periksa)
                    <div class="col">
                        <a href="/jadwalperiksa/detailjadwalperiksa/{{ $periksa->id }}" style="text-decoration: none">
                            <div class="card">
                                <img src="/css/schedule.jpg" class="img-fluid card-img-top">
                                <div class="card-body">
                                    <h6 class="card-title">{{ $periksa->hari }}</h6>
                                    @if ($periksa->aktif == 'Y')
                                        <h6 style="color:black"><span class="badge bg-success">Aktif</span></h6>
                                    @else
                                        <h6 style="color:black"><span class="badge bg-danger">Tidak Aktif</span></h6>
                                    @endif
                                    <span style="color:black">{{ $periksa->jam_mulai }} - {{ $periksa->jam_selesai }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
