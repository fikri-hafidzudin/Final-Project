@extends('pertanyaan.blank')
@section('content')
<div class="mt-3 ml-3">
    <h4>{{$pertanyaan->judul}} </h4>
    <p>{{$pertanyaan->isi}} </p>
    <form role="form" action="{{ route('jawaban.store') }}" method="POST">
      @csrf
      <div class="mt-3 ml-3 mr-3">
          <div class="card-body">
            <div class="form-group">
              <label for="isi">Jawab</label>
              <input type="text" class="form-control" id="isi" name="isi" value="{{old('isi', '')}}" placeholder="Jawaban">
            @error('isi')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Kirim</button>
          </div>
      </div>
    </form>

    <a class="btn btn-default" href="{{ route('pertanyaanbaru.index') }}">Kembali</a>
</div>
    
@endsection