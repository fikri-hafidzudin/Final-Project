@extends('pertanyaan.blank')
@section('content')
 <div class="card card-primary card-outline">
    <div class="card-body box-profile">
        <div class="text-center">
            <i class="fas fa-user-circle fa-10x"></i>
            {{-- <img class="profile-user-img img-fluid img-circle" src="{{asset ('/adminlte/dist/img/user4-128x128.jpg')}}" alt="User profile picture"> --}}
        </div>

        <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

        <p class="text-muted text-center">{{ Auth::user()->email }}</p>

        <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
            <b>Pertanyaan</b> <a class="float-right">0</a>
            </li>
            <li class="list-group-item">
            <b>Jawaban</b> <a class="float-right">543</a>
            </li>
            <li class="list-group-item">
            <b>Vote</b> <a class="float-right">13,287</a>
            </li>
        </ul>

        <a href="/profile" class="btn btn-primary btn-block"><b>Profile</b></a>
    </div>
    <!-- /.card-body -->
</div>
    
@endsection