@extends('pertanyaan.blank')
@section('content')
<div class="mt-3 ml-3">
  <div class="card"> 
    <div class="card-header">
            <h3>{{$pertanyaan->judul}}</h3>
    </div>
    <div class="card-body">
    <p>{{$pertanyaan->isi}} </p>
    </div>
  </div>
  <div class="card">
  <table class="table table-bordered">
  <thead>
  <tr> <h3>Jawaban :</h3> </tr>
  </thead>
              <tbody>
              @forelse ($pertanyaan->jawaban as $key => $jawab)
                <tr>
                    <td> {{$jawab -> isi}} </td>
                    <td style="display: flex;">
                        <a href="{{ route('jawaban.edit', $jawab->id) }}" class="btn btn-warning btn-sm mr-1 ml-1">edit</a>
                        <form action="{{ route('jawaban.destroy', $jawab->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="delete" class="btn btn-danger btn-sm">
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" align="center"> Tidak ada jawaban</td>
                </tr>
              @endforelse
              </tbody>
    </table>
    </div>
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
          <div class="card-body" style="display:none;">
            <div class="form-group">
              <label for="isi">pertanyaan_id</label>
              <input type="text" class="form-control" id="pertanyaan_id" name="pertanyaan_id" value="{{$pertanyaan->id}}" placeholder="id">
            @error('isi')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Kirim</button>
            <a class="btn btn-default" href="{{ route('pertanyaanbaru.index') }}">Kembali</a>
          </div>
      </div>
    </form>
</div>
    
@endsection