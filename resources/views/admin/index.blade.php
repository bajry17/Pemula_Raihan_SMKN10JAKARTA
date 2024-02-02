@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
                <div class="col-7">
                    <h2 class="fw-bold">Selamat Datang {{ Auth::user()->name }}</h2>
                </div>
                <div class="col">
                    <a href="{{ route('user.create') }}" class="btn btn-primary">Tambah User</a>
                </div>
            </div>
            <div>
                <h2 class="fw-bold">Daftar USER</h2>
            </div>
            <div class="row">
                @foreach ($users as $user)
                    <div class="col-4 mt-3">
                        <div class="card">            
                            <div class="card-body text-bg-dark">
                                <div class="fw-bold">
                                    {{ $user->name }}
                                </div>
                                <div>
                                   {{ $user->email }}   
                                </div>
                                <div>
                                    Role : {{ $user->role->name }}
                                </div>
                                <div class="mt-3">
                                    <div class="row">
                                        <div class="col text-start">
                                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                                        </div>
                                        <div class="col text-end">
                                            <form action="{{ route('user.destroy', $user->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
