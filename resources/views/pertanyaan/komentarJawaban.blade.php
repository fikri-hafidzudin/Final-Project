<!-- <div class="card" id="komentarJawaban" style="display:none;"> -->
    
      
<form role="form" action="{{ route('komentarJawaban.store') }}" method="POST">
                            @csrf
                                  <label for="isi">Komentar :</label>
                                  <div class="form-group" style="display: flex;">
                                    <input type="text" class="form-control" id="isi" name="isi" value="{{old('isi', '')}}" placeholder="Tulis komentar">
                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                  @error('isi')
                                  <div class="alert alert-danger">{{$message}}</div>
                                  @enderror
                                  </div>
                              
                                  <div class="form-group" style="display:none;>
                                    <label for="isi">jawaban_id</label>
                                    <input type="text" class="form-control" id="jawaban_id" name="jawaban_id" value="{{$jawab->id}}" placeholder="id">
                                    
                                  @error('isi')
                                  <div class="alert alert-danger">{{$message}}</div>
                                  @enderror
                                  </div>
                                <!-- /.card-body -->
                          </form>
                          @forelse ($jawab->komentar as $key => $komen)
                                <div style="display: flex;">
                                    {{$komen->user->name}} : {!! $komen -> isi !!} 
                                    <div class="ml-auto" style="display:flex;">
                                    <a href="{{ route('komentarJawaban.edit', $komen->id) }}" class="btn btn-warning btn-sm mr-1 ml-1">edit</a>
                                    <form action="{{ route('komentarJawaban.destroy', $komen->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="delete" class="btn btn-danger btn-sm">
                                    </form>
                                    </div>
                                </div>
                            @empty
                            
                          @endforelse
    
<!-- </div> -->