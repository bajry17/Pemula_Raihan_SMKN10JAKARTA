@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-bg-dark text-center">Edit User</div>

                <div class="card-body">
                    <form action="{{ route('user.update', $user->id) }}" method="post">
                        @csrf
                        @method('put')  
                        <label for="name">Nama Pengguna</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                        <label for="email">Email Pengguna</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" name="password" disabled>
                        <label for="role_id">Role Pengguna</label>
                        <select name="role_id" class="form-control">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}"{{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <div class="col d-grid gap-2 mt-3">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
