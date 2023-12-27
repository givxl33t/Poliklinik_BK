@extends('admin.app')

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Edit Poli</h3>
          <div class="card-tools">
              <a href="/adminlistpoli" class="btn btn-danger"><i class="fas fa-times"></i></a>
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
            <form method="POST" action="/adminlistpoli/{{ $poli->id }}" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="card-body">
                <div class="form-group">
                  <label for="nama_poli">Nama Poli</label>
                  <input type="text" class="form-control" name="nama_poli" id="nama_poli" value="{{ $poli->nama_poli }}" placeholder="Nama Poli">
                </div>
                <div class="form-group">
                  <label for="code">Keterangan</label>
                  <input type="text" class="form-control" name="keterangan" id="keterangan" value="{{ $poli->keterangan }}" placeholder="Keterangan">
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