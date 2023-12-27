@extends('admin.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Obat List</h3>
            <div class="card-tools">
                <a href="/adminlistobat/add" class="btn btn-primary"><i class="fa-solid fa-plus"></i></a>
            </div>
            <div class="mt-5">
                <form action="" method="GET">
                    @csrf
                    <input type="text" class="form-control" placeholder="Cari Obat disini" name="keyword"
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
                        <th scope="col">Kemasan</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($obats as $obat)
                        <tr class="align-items-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $obat->nama_obat }}</td>
                            <td>{{ $obat->kemasan }}</td>
                            <td>Rp{{ number_format($obat->harga, 0, ',', '.') }}</td>
                            <td class="d-flex align-items-center">
                                <a href="/adminlistobat/{{ $obat->id }}/delete" class="btn btn-danger"><i
                                        class="fa-solid fa-trash-can"></i></a>
                                <div style="width: 10px"></div>
                                <a href="/adminlistobat/{{ $obat->id }}/edit" class="btn btn-primary"><i
                                        class="fa-solid fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
