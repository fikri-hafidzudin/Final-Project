@extends('pertanyaan.blank')

@push('script-head')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endpush

@section('content')
<div class="mt-3 ml-3">
  <div class="card"> 
    <div class="card-header">
      <h3>{{$pertanyaan->judul}}</h3>
      <p>Oleh : {{$pertanyaan->user->name}}</p>
    </div>
    <div class="card-body">
    <p>{!!$pertanyaan->isi!!} </p>
    </div>
    <div class="card-header">
      Tags :
      @forelse($pertanyaan->tags as $tag)
        <button class="btn btn-primary btn-sm">{{ $tag->tag }}</button>

        @empty
        No Tags
      @endforelse
    </div>
  </div>

  <div class="card">
  <table class="table table-bordered">
  <tr> <h3>Komentar :</h3> </tr>
              <tbody>
              @forelse ($pertanyaan->komentar as $key => $komen)
                <tr>
                    <td>{{$pertanyaan->user->name}} : {!! $komen -> isi !!} </td>
                    <td style="display: flex;">
                        <a href="{{ route('komentarPertanyaan.edit', $komen->id) }}" class="btn btn-warning btn-sm mr-1 ml-1">edit</a>
                        <form action="{{ route('komentarPertanyaan.destroy', $komen->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="delete" class="btn btn-danger btn-sm">
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" align="center"> Tidak ada komentar</td>
                </tr>
              @endforelse
              </tbody>
              <form role="form" action="{{ route('komentarPertanyaan.store') }}" method="POST">
                  @csrf
                  <div class="mt-3 ml-3 mr-3">
                      <div class="card-body">
                        <div class="form-group">
                          <input type="text" class="form-control" id="isi" name="isi" value="{{old('isi', '')}}" placeholder="Tulis komentar">
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
                      </div>
                  </div>
                </form>
    </table>
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
                    <td>{{$pertanyaan->user->name}} : {!! $jawab -> isi !!} </td>
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
              <textarea name="isi" class="form-control my-editor">{!! old('isi', '') !!}</textarea>
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

@push('script')
<script>
  var editor_config = {
    path_absolute : "/",
    selector: "textarea.my-editor",
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };

  tinymce.init(editor_config);
</script>
@endpush