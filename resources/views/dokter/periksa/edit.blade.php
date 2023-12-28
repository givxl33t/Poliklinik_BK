@extends('dokter.layouts.app')

@section('title', 'Edit Periksa Pasien')

@section('content')
    <div class="text-center my-5">
        <h3>Edit Periksa Pasien</h3>
    </div>
    <!-- Edit Post Form -->
    <form action="/dokter/periksa/detailpasien/{{ $periksa->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="catatan" class="form-label">Catatan</label>
            <textarea class="form-control" id="catatan" name="catatan" rows="3">{{ old('catatan', $periksa->catatan) }}</textarea>
            @error('catatan')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Dynamic "obats" section -->
        <div id="obats-container">
            @foreach ($periksa->detail_periksas as $detailPeriksa)
                <div class="mb-3 obat-entry">
                    <label for="obats" class="form-label">Obat</label>
                    <select name="obats[]" class="form-control">
                        @foreach ($obats as $obat)
                            <option value="{{ $obat->id }}" {{ ($obat->id == $detailPeriksa->id_obat) ? 'selected' : '' }}>{{ $obat->nama_obat }}</option>
                        @endforeach
                    </select>
                    <button type="button" class="remove-obat btn btn-danger mt-1">Remove</button>
                </div>
            @endforeach
        </div>
        <button type="button" class="btn btn-success mt-3 mr-2" id="add-obat">Add Obat</button>

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
                    alert("You cannot remove the last 'obat' entry.");
                }
            });
        });
    </script>
@endsection