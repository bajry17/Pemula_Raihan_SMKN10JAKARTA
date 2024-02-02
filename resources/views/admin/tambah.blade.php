@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-bg-dark text-center">Edit User</div>

                <div class="card-body">
                    <form action="{{ route('user.store') }}" method="post">
                        @csrf
                        <label for="name">Nama Pengguna</label>
                        <input type="text" name="name" class="form-control">
                        <label for="email">Email Pengguna</label>
                        <input type="email" name="email" class="form-control">
                        <label for="password">Password</label>
                        <input type="text" name="password" class="form-control">
                        <label for="role_id">Role Pengguna</label>
                        <select name="role_id" class="form-control">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
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
