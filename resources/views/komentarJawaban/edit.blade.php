@extends('pertanyaan.blank')

@section('content')
<div class="card"> 
    <div class="card-header">
    {!!$komentarJawaban->jawaban->isi!!}
    </div>
  </div>
<form role="form" action="/komentarJawaban/{{$komentarJawaban->id}}" method="POST">
                @csrf
                @method('PUT')
                <div class="mt-3 ml-3">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="isi">Komentar :</label>
                        <input type="text" class="form-control" id="isi" name="isi" value="{{old('id',$komentarJawaban->isi)}}" placeholder="Komentar">
                      </div>
                    </div>
                    <!-- /.card-body -->
    
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Simpan</button>
                      <a class="btn btn-default" href="{{ route('pertanyaanbaru.show', $komentarJawaban->jawaban->pertanyaan_id) }}">Kembali</a>
                    </div>
                </div>
              </form>

    
@endsection