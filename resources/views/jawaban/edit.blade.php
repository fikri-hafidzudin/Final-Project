@extends('pertanyaan.blank')
@section('content')
<div class="card"> 
    <div class="card-header">
            <h3>{{$jawaban->pertanyaan->judul}}</h3>
    </div>
    <div class="card-body">
    <p>{{$jawaban->pertanyaan->isi}} </p>
    </div>
  </div>
<form role="form" action="/jawaban/{{$jawaban->id}}" method="POST">
                @csrf
                @method('PUT')
                <div class="mt-3 ml-3">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="isi">Jawaban</label>
                        <input type="text" class="form-control" id="isi" name="isi" value="{{old('id',$jawaban->isi)}}" placeholder="Jawaban">
                      </div>
                    </div>
                    <!-- /.card-body -->
    
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Simpan</button>
                      <a class="btn btn-default" href="{{ route('pertanyaanbaru.show', $jawaban->pertanyaan_id) }}">Kembali</a>
                    </div>
                </div>
              </form>

    
@endsection