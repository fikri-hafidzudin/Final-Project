@extends('pertanyaan.blank')
@section('content')
    <form role="form" action="/pertanyaan" method="POST">
      @csrf
      <div class="mt-3 ml-3 mr-3">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Buat Pertanyaan</h3>
            </div>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="Title">Judul</label>
              <input type="text" class="form-control" id="title" name="judul" value="{{old('judul', '')}}"placeholder="Judul pertanyaan">
            @error('judul')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
            </div>
            <div class="form-group">
              <label for="isi">Isi</label>
              <input type="text" class="form-control" id="isi" name="isi" value="{{old('isi', '')}}" placeholder="Pertanyaan">
            @error('isi')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Tambah</button>
          </div>
      </div>
    </form>

    
@endsection