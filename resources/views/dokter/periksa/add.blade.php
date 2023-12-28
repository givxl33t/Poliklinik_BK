@extends('dokter.layouts.app')

@section('title', 'Periksa Pasien')

@section('content')
    <div class="text-center my-5">
        <h3>Periksa Pasien</h3>
    </div>
    <!-- Create Post Form -->
    <form action="{{ url('/dokter/periksa/detailpasien') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="tgl_periksa" class="form-label">Tanggal Periksa</label>
            <input type="datetime-local" class="form-control" id="tgl_periksa" name="tgl_periksa">
            @error('tgl_periksa')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="catatan" class="form-label">Catatan</label>
            <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
            @error('catatan')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Dynamic "obats" section -->
        <div id="obats-container">
            <div class="mb-3 obat-entry">
                <label for="obats" class="form-label">Obat</label>
                <select name="obats[]" class="form-control">
                    @foreach ($obats as $obat)
                        <option value="{{ $obat->id }}">{{ $obat->nama_obat }} | {{ $obat->kemasan }} </option>
                    @endforeach
                </select>
                <button type="button" class="remove-obat btn btn-danger mt-1">Remove Obat</button>
            </div>
        </div>
        <button type="button" class="btn btn-success mt-3 mr-2" id="add-obat">Add Obat</button>

        <input type="hidden" name="id_daftar_poli" id="id_daftar_poli" value="{{ $iddaftarpoli }}">

        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            // Add new "obat" entry
            $("#add-obat").click(function () {
                var newObatEntry = $(".obat-entry:first").clone();
                newObatEntry.find("select").val($("select[name='obats[]']:first").val());
                $("#obats-container").append(newObatEntry);
            });

            // Remove "obat" entry
            $(document).on("click", ".remove-obat", function () {
            // Check if it's not the last "obat" entry before removing
            if ($("#obats-container .obat-entry").length > 1) {
                $(this).parent().remove();
            } else {
                alert("Obat terakhir tidak bisa dihapus!");
            }
        });
        });
    </script>
@endsection
