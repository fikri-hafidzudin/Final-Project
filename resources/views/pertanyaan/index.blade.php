@extends('pertanyaan.blank')

@section('content')
<div class="mt-3 ml-3">
    <a class="btn btn-info mt-2 mb-2" href="{{url ('pertanyaanbaru/create') }}">Tambah Baru</a>
    <div class="card"> 
    <div class="card-header">
            <h3 class="card-title">Daftar Pertanyaan</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if (session('success'))
            <div class="alert alert-success">
                {{session('success')}} 
            </div>
            @endif
            <table class="table table-bordered">
            <thead>                    
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Judul</th>
                    <th>Isi</th>
                    <th style="width: 40px">Option</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pertanyaan as $key => $item)
                <tr>
                    <td> {{$key + 1}} </td>
                    <td> {{$item -> judul}} </td>
                    <td> {!!$item -> isi!!} </td>
                    <td style="display: flex;">
                        <a href="{{ route('pertanyaanbaru.show', $item->id) }}" class="btn btn-info btn-sm">show</a>
                        <a href="{{ route('pertanyaanbaru.edit', $item->id) }}" class="btn btn-warning btn-sm mr-1 ml-1">edit</a>
                        <form action="{{ route('pertanyaanbaru.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="delete" class="btn btn-danger btn-sm">
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" align="center"> Tidak ada pertanyaan</td>
                </tr>
                @endforelse
            </tbody>
            </table>   
        </div>
</div>
@endsection