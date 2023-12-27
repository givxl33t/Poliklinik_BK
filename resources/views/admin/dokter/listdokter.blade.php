@extends('admin.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Dokter List</h3>
            <div class="card-tools">
                <a href="/adminlistdokter/add" class="btn btn-primary"><i class="fa-solid fa-plus"></i></a>
            </div>
            <div class="mt-5">
                <form action="" method="GET">
                    @csrf
                    <input type="text" class="form-control" placeholder="Cari dokter disini" name="keyword"
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
                        <th scope="col">Email</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Nomor HP</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dokters as $item)
                        <tr class="align-items-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->no_hp }}</td>
                            <td class="d-flex align-items-center justify-content-between">
                                <a href="/detaildokter/{{ $item->id }}" class="btn btn-warning mr-1 text-white">
                                    <i class="fa-sharp fa-solid fa-magnifying-glass"></i></a>
                                <a href="/adminlistdokter/{{ $item->id }}/edit" class="btn btn-primary mr-1"><i
                                        class="fa-solid fa-edit"></i></a>
                                <a href="/adminlistdokter/{{ $item->id }}/delete" class="btn btn-danger mr-1"><i
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
