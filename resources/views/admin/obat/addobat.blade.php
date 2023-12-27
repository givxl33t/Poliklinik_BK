@extends('admin.app')

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tambah Obat</h3>
          <div class="card-tools">
              <a href="/adminlistobat" class="btn btn-danger"><i class="fas fa-times"></i></a>
          </div>
          <div class="card-body table-responsive p-0">
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <form method="POST" action="{{ url('/adminlistobat') }}" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="nama_obat">Nama</label>
                  <input type="text" class="form-control" name="nama_obat" id="nama_obat" value="{{ old('nama_obat') }}" placeholder="Nama Obat">
                </div>
                <div class="form-group">
                  <label for="code">Kemasan</label>
                  <input type="text" class="form-control" name="kemasan" id="kemasan" value="{{ old('kemasan') }}" placeholder="Kemasan">
                </div>
                <div class="form-group">
                  <label for="code">Harga</label>
                  <input type="text" class="form-control" name="harga" id="harga" value="{{ old('harga') }}" placeholder="Harga">
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection