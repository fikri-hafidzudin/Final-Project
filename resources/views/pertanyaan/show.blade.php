@extends('pertanyaan.blank')

@push('script-head')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endpush

@section('content')
  <!-- pertanyaan -->
  <div class="list-group-item list-group-item flex-column align-items-start ">
        <div class="d-flex w-100">
            <h3 class="mb-1 mr-auto p-2">{{$pertanyaan->judul}}</h3>
            <a class="btn btn-sm btn-primary mb-3 p-2" href="{{url ('pertanyaanbaru/create') }}">Tambah Pertanyaan Baru</a>
            <a href="{{ route('pertanyaanbaru.edit', $pertanyaan->id) }}" class="btn btn-warning btn-sm p-2 mr-1 ml-1 mb-3">edit</a>
            <form action="{{ route('pertanyaanbaru.destroy', $pertanyaan->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="delete" class="btn btn-danger btn-sm p-2">
            </form>
        </div>
        <small class="mb-1 mr-auto p-2">oleh: {{$pertanyaan -> user -> name}}</small>
  </div>
  <div class="list-group-item list-group-item flex-column align-items-start">
    <div class="row">   
        <div class="col-1">
            <div class="row justify-content-md-center">
                <div class="col-sm">
                  <form action="{{ route('vote.pertanyaanup', $pertanyaan->id) }}" method="POST">
                  @csrf
                    <button class="btn btn-white ml-3 btn-sm">
                      <input type="submit" value="upvote" name="upvote" style="display:none;">
                      <i class="fas fa-caret-up fa-3x" style="color:#DCDCDC"></i>
                    </button>
                  </form>
                  <h3 align="center" class="my-0 ml-1">{{$vote->poin}}</h3>
                  <form action="{{ route('vote.pertanyaandown', $pertanyaan->id) }}" method="POST">
                  @csrf
                    <button class="btn btn-white ml-3 btn-sm">
                      <input type="submit" value="downvote" name="downvote" style="display:none;">
                      <i class="fas fa-caret-down fa-3x" style="color:#DCDCDC"></i>
                    </button>
                  </form>
                </div>
            </div>
        </div>
        <div class="col-11">
            <p class="mb-1">{!!$pertanyaan -> isi!!}</p>
            <small>
                @forelse($pertanyaan->tags as $tag)
                    <button class="btn btn-secondary btn-sm">{{ $tag->tag }}</button>
                @empty
                    No Tags
                @endforelse
            </small> <br><br>
            <div style="text-align: left">
              <button class="btn btn-link btn-sm komen"><i class="far fa-comment"></i> Tambah Komentar</button>
            </div>
        </div>
        <div class="input-group mb-3 col-md-11 offset-md-1" style="display:none;">
            <form role="form" action="{{ route('komentarPertanyaan.store') }}" method="POST">
            @csrf
              <div class="input-group-append">
                  <input type="text" class="form-control" placeholder="Tulis komentar di sini" name="isi" value="{{old('isi', '')}}" aria-label="Recipient's username" aria-describedby="basic-addon2">
                  <!-- <input type="text" class="form-control" id="isi" name="isi" value="{{old('isi', '')}}" placeholder="Tulis komentar"> -->
                  <button class="btn btn-outline-primary" type="submit">Kirim</button>
                  @error('isi')
                  <div class="alert alert-danger">{{$message}}</div>
                  @enderror
                  <input type="text" class="form-control" id="pertanyaan_id" name="pertanyaan_id" value="{{$pertanyaan->id}}" placeholder="id" style="display:none;">
              </div>
            </form>
        </div>
        <div class="input-group mb-3 col-md-11 offset-md-1">
           <ul class="list-group list-group-flush">
            @forelse ($pertanyaan->komentar as $key => $komen)
              <li class="list-group-item d-flex"><a href="#" class="badge badge-light mt-1">{{$komen->user->name}}</a>&nbsp- {!! $komen -> isi !!}
              <a href="{{ route('komentarPertanyaan.edit', $komen->id) }}" class="btn btn-link btn-sm ml-1">edit</a>
              <form action="{{ route('komentarPertanyaan.destroy', $komen->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="delete" class="btn btn-link btn-sm">
              </form>
              </li>
            @empty
            @endforelse
            </ul>
        </div>
    </div> 
  </div>
  <!-- jawaban -->
  <div class="list-group-item list-group-item flex-column align-items-start ">
        <div class="d-flex w-100">
            <h3 class="mb-1 mr-auto p-2">Jawaban</h3>
        </div>
  @forelse ($pertanyaan->jawaban as $key => $jawab)
  <div class="list-group-item list-group-item flex-column align-items-start">
    <div class="row">   
        <div class="col-1">
            <div class="row justify-content-md-center">
                <div class="col-sm">
                    <button class="btn btn-white ml-3 btn-sm">
                      <i class="fas fa-caret-up fa-3x" style="color:#DCDCDC"></i>
                    </button>
                    <h3 align="center" class="my-0 ml-1">0</h3> 
                    <button class="btn btn-white ml-3 btn-sm">
                    <i class="fas fa-caret-down fa-3x" style="color:#DCDCDC"></i>
                    </button>
                    <form action="{{ route('jawaban.tepat', $jawab->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-white ml-2 btn-sm">
                        <i class="fas fa-check fa-3x" style="color:#DCDCDC">
                        <input type="submit" value="pilih jawaban tepat" style="display:none;">
                        </i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-11">
            <p class="mb-1">{!! $jawab -> isi !!}</p>
            <div style="text-align: left">
              <button class="btn btn-link btn-sm komen"><i class="far fa-comment"></i> Tambah Komentar</button>
            </div>
        </div>
        <div class="input-group mb-3 col-md-11 offset-md-1" style="display:none;">
            <form role="form" action="{{ route('komentarJawaban.store') }}" method="POST">
              @csrf
              <div class="input-group-append">
                  <input type="text" class="form-control" placeholder="Tulis komentar di sini" name="isi" value="{{old('isi', '')}}" aria-label="Recipient's username" aria-describedby="basic-addon2">
                  <button class="btn btn-outline-primary" type="submit">Kirim</button>
                  @error('isi')
                  <div class="alert alert-danger">{{$message}}</div>
                  @enderror
                  <input type="text" class="form-control" name="jawaban_id" value="{{$jawab->id}}" placeholder="id" style="display:none;">
              </div>
            </form>
        </div>
        <div class="input-group mb-3 col-md-11 offset-md-1">
           <ul class="list-group list-group-flush">
            @forelse ($jawab->komentar as $key => $komen)
              <li class="list-group-item d-flex"><a href="#" class="badge badge-light mt-1">{{$komen->user->name}}</a>&nbsp- {!! $komen -> isi !!}
              <a href="{{ route('komentarJawaban.edit', $komen->id) }}" class="btn btn-link btn-sm ml-1">edit</a>
              <form action="{{ route('komentarJawaban.destroy', $komen->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="delete" class="btn btn-link btn-sm">
              </form>
              </li>
            @empty
            @endforelse
            </ul>
        </div>
    </div> 
  </div>
  @empty
  @endforelse
  <!-- input jawaban -->
  <div class="list-group-item list-group-item flex-column align-items-start ">
        <div class="d-flex w-100">
            <h3 class="mb-1 mr-auto p-2">Jawab Pertanyaan:</h3>
        </div>
        <form role="form" action="{{ route('jawaban.store') }}" method="POST">
          @csrf
                <textarea name="isi" class="form-control my-editor">{!! old('isi', '') !!}</textarea>
                @error('isi')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
                <input type="text" class="form-control" id="jawabpertanyaan_id" name="pertanyaan_id" value="{{$pertanyaan->id}}" placeholder="id" style="display:none;">
                @error('isi')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
                <br>
                <button type="submit" class="btn btn-primary">Posting Jawaban</button>
                <a class="btn btn-default" href="{{ route('pertanyaanbaru.index') }}">Kembali</a>
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
  function komentar(){
    var x = document.getElementById("komentar_pertanyaan");
    if (x.style.display === "none") {
      x.style.display = "";
    } else {
      x.style.display = "none";
    }
  }
  function komentarJawaban(){
    var y = document.getElementById("komentar_jawaban");
    if (y.style.display === "none") {
      y.style.display = "flex";
    } else {
      y.style.display = "none";
    }
  }

  const check = document.querySelectorAll('.fa-check');
  
  check.forEach(function(el){
    el.addEventListener('click', function(e){
      e.target.style.color='green';
      e.preventDefault();
    });
  });

  const up = document.querySelectorAll('.fa-caret-up');
  
  var x = 0;
  up.forEach(function(el){
    el.addEventListener('click', function(e){
      x++;
      e.target.style.color='black';
      e.target.parentElement.nextElementSibling.innerHTML = x;
      //e.preventDefault();
    });
  });

  const down = document.querySelectorAll('.fa-caret-down');
  
  down.forEach(function(el){
    el.addEventListener('click', function(e){
      x--;
      e.target.style.color='black';
      e.target.parentElement.previousElementSibling.innerHTML = x;
      //e.preventDefault();
    });
  });

  const komen = document.querySelectorAll('.komen');
  
  komen.forEach(function(el){
    el.addEventListener('click', function(e){
      var y = e.target.parentElement.parentElement.nextElementSibling;
      if (y.style.display === "none") {
      y.style.display = "block";
      } else {
      y.style.display = "none";
      }
    });
  });
  
</script>
@endpush