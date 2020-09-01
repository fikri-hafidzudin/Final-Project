@extends('pertanyaan.blank')

@section('content')
<div class="mt-3 ml-3 mr-3">
    <a class="btn btn-info mt-2 mb-2" href="{{url ('pertanyaanbaru/create') }}">Tambah Baru</a>
    <div class="list-group">
        @forelse ($pertanyaan as $key => $item)
    <a href="{{ route('pertanyaanbaru.show', $item->id) }}" class="list-group-item list-group-item-action flex-column align-items-start">
        <div class="row">   
            <div class="col-2">
                <div class="row justify-content-md-center">
                    <div class="col-sm">
                        <h3 align="center">0</h3> 
                        <h5 align="center">jawab</h5>
                    </div>
                    <div class="col-sm">
                    
                        @forelse ($votes as $key => $vote)
                            
                                 
                            
                                @if ($vote->pertanyaan_id == $item->id)
                                <h3 align="center">{{$vote->poin}}</h3>  
                                @endif
                                
                        @empty
                        <h3 align="center">0</h3>
                        @endforelse
                        <h5 align="center">votes</h5>
                    
                    </div>
                </div>
            </div>
            <div class="col-10">
                <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{$item -> judul}}</h5>
                <small>3 days ago oleh: {{$item -> user -> name}}</small>
                </div>
                <p class="mb-1">{!!$item -> isi!!}</p>
                <small>
                    @forelse($item->tags as $tag)
                        <button class="btn btn-primary btn-sm">{{ $tag->tag }}</button>
                    @empty
                        No Tags
                    @endforelse
                </small>
            </div>
        </div> 
    </a>
        @empty
    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                <h5 class="mb-1" align="center">Tidak ada Pertanyaan</h5>
    </a>
        @endforelse
    </div>
</div>
@endsection