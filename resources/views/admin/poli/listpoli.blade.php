@extends('admin.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Poli List</h3>
            <div class="card-tools">
                <a href="/adminlistpoli/add" class="btn btn-primary"><i class="fa-solid fa-plus"></i></a>
            </div>
            <div class="mt-5">
                <form action="" method="GET">
                    @csrf
                    <input type="text" class="form-control" placeholder="Cari poli disini" name="keyword"
                        style="border-radius: 12px">
                </form>
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nama Poli</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Jumlah Dokter</th>
                        <th scope="col">Tanggal Ditambah</th>
                        <th scope="col">Tanggal Diubah</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($polis as $poli)
                        <tr class="align-items-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $poli->nama_poli }}</td>
                            <td>{{ $poli->keterangan }}</td>
                            <td>{{ $poli->dokters->count() }}</td>
                            <td>{{ $poli->created_at }}</td>
                            <td>{{ $poli->updated_at }}</td>
                            <td class="d-flex align-items-center">
                                <a href="/detailpoli/{{ $poli->id }}" class="btn btn-warning mr-1 text-white">
                                    <i class="fa-sharp fa-solid fa-magnifying-glass"></i></a>
                                <a href="/adminlistpoli/{{ $poli->id }}/edit" class="btn btn-primary mr-1"><i
                                    class="fa-solid fa-edit"></i></a>
                                <a href="/adminlistpoli/{{ $poli->id }}/delete" class="btn btn-danger mr-1"><i
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
