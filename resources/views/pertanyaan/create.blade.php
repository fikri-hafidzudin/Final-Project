@extends('pertanyaan.blank')

@push('script-head')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endpush

@section('content')
    <form role="form" action="{{route('pertanyaanbaru.store') }}" method="POST">
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
              <textarea name="isi" class="form-control my-editor">{!! old('isi', '') !!}</textarea>
            @error('isi')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
            </div>
            <div class="form-group">
              <label for="tags">Tags</label>
              <input type="text" class="form-control" id="tags" name="tags" value="{{old('tags', '')}}"placeholder="Tulis tag pisahkan dengan tanda koma">
            @error('tag')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Tambah</button>
            <a class="btn btn-default" href="{{ url('/pertanyaanbaru') }}">Kembali</a>
          </div>
      </div>
    </form>

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