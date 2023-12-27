@extends('admin.app')

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tambah Pasien</h3>
          <div class="card-tools">
              <a href="/adminlistpasien" class="btn btn-danger"><i class="fas fa-times"></i></a>
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
            <form method="POST" action="{{ url('/adminlistpasien') }}" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="code">Nama</label>
                  <input type="text" class="form-control" name="nama" id="nama" value="{{ old('nama') }}" placeholder="Nama Pasien">
                </div>
                <div class="form-group">
                  <label for="code">Alamat</label>
                  <input type="text" class="form-control" name="alamat" id="alamat" value="{{ old('alamat') }}" placeholder="Alamat Pasien">
                </div>
                <div class="form-group">
                  <label for="code">No KTP</label>
                  <input type="text" class="form-control" name="no_ktp" id="no_ktp" value="{{ old('no_ktp') }}" placeholder="No KTP Pasien">
                </div>
                <div class="form-group">
                  <label for="code">No HP</label>
                  <input type="text" class="form-control" name="no_hp" id="no_hp" value="{{ old('no_hp') }}" placeholder="No HP Pasien">
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