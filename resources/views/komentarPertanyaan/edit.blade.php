@extends('pertanyaan.blank')

@section('content')
<div class="card"> 
    <div class="card-header">
            <h3>{{$komentarPertanyaan->pertanyaan->judul}}</h3>
    </div>
    <div class="card-body">
    <p>{{$komentarPertanyaan->pertanyaan->isi}} </p>
    </div>
  </div>
<form role="form" action="/komentarPertanyaan/{{$komentarPertanyaan->id}}" method="POST">
                @csrf
                @method('PUT')
                <div class="mt-3 ml-3">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="isi">Komentar :</label>
                        <input type="text" class="form-control" id="isi" name="isi" value="{{old('id',$komentarPertanyaan->isi)}}" placeholder="Komentar">
                      </div>
                    </div>
                    <!-- /.card-body -->
    
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Simpan</button>
                      <a class="btn btn-default" href="{{ route('pertanyaanbaru.show', $komentarPertanyaan->pertanyaan_id) }}">Kembali</a>
                    </div>
                </div>
              </form>

    
@endsection