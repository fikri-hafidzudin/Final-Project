@extends('pertanyaan.blank')
@section('content')
<div class="mt-3 ml-3">
    <h4>{{$pertanyaan->judul}} </h4>
    <p>{{$pertanyaan->isi}} </p>
    <a class="btn btn-default" href="{{ route('pertanyaanbaru.index') }}">Kembali</a>
</div>
    
@endsection