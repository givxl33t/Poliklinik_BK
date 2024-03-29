@extends('admin.app')


@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Pasien List</h3>
            <div class="card-tools">
                <a href="/adminlistpasien/add" class="btn btn-primary"><i class="fa-solid fa-plus"></i></a>
            </div>
            <div class="mt-5">
                <form action="" method="GET">
                    @csrf
                    <input type="text" class="form-control" placeholder="Cari pasien disini" name="keyword"
                        style="border-radius: 12px">
                </form>
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Nomor KTP</th>
                        <th scope="col">Nomor HP</th>
                        <th scope="col">Nomor RM</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pasiens as $pasien)
                        <tr class="align-items-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pasien->nama }}</td>
                            <td>{{ $pasien->alamat }}</td>
                            <td>{{ $pasien->no_ktp }}</td>
                            <td>{{ $pasien->no_hp }}</td>
                            <td>{{ $pasien->no_rm }}</td>
                            <td class="d-flex align-items-center">
                                <a href="/detailpasien/{{ $pasien->id }}" class="btn btn-warning mr-1 text-white">
                                    <i class="fa-sharp fa-solid fa-magnifying-glass"></i></a>
                                <a href="/adminlistpasien/{{ $pasien->id }}/edit" class="btn btn-primary mr-1"><i
                                    class="fa-solid fa-edit"></i></a>
                                <a href="/adminlistpasien/{{ $pasien->id }}/delete" class="btn btn-danger mr-1"><i
                                        class="fa-solid fa-trash-can"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
