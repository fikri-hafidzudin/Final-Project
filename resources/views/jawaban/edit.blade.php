@extends('pertanyaan.blank')
@push('script-head')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endpush
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
                        <textarea name="isi" class="form-control my-editor">{!! old('isi', $jawaban->isi) !!}</textarea>
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