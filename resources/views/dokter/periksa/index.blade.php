@extends('dokter.layouts.app')

@section('title', 'Daftar Pasien')

@section('content')
    <div class="container">
        <div class="row my-5">
            <div class="col">
                <h1 class="text-center">Daftar Pasien</h1>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @if ($daftarpolis->isEmpty())
                <p><i class="text-warning">Anda belum memiliki pasien baru, silahkan tunggu dan cek secara berkala pasien terbaru!</i></p>
            @else
                @foreach ($daftarpolis as $daftarpoli)
                    <div class="col">
                        <a href="/dokter/periksa/detailpasien/{{ $daftarpoli->pasien->id }}" style="text-decoration: none">
                            <div class="card" style="text-decoration: none">
                                <img src="/css/patient.jpg" class="img-fluid card-img-top">
                                <div class="card-body">
                                    <h6 class="card-title">{{ $daftarpoli->pasien->nama }}</h6>
                                    <h6 style="color:black">No. Antrian {{ $daftarpoli->no_antrian }}</h6>
                                    <span style="color:black">Keluhan {{ $daftarpoli->keluhan }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
