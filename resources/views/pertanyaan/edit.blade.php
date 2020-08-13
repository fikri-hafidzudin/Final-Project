@extends('pertanyaan.blank')
@section('content')
<form role="form" action="/pertanyaan/{{$pertanyaan->id}}" method="POST">
                @csrf
                @method('PUT')
                <div class="mt-3 ml-3">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="Title">Judul</label>
                        <input type="text" class="form-control" id="title" name="judul" value="{{old('id',$pertanyaan->judul)}} " placeholder="Judul pertanyaan">
                      </div>
                      <div class="form-group">
                        <label for="isi">Pertanyaannya</label>
                        <input type="text" class="form-control" id="isi" name="isi" value="{{old('id',$pertanyaan->isi)}}" placeholder="Pertanyaan">
                      </div>
                    </div>
                    <!-- /.card-body -->
    
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
              </form>

    
@endsection