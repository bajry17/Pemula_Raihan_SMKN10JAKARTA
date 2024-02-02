@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="row">
                <div class="col">
                    <h1>Riwayat Transaksi</h1>
                    @forelse($users as $date => $user)
                    <div class="flex text-center gap-3 mb-3 mt-3">
                        <span class="fw-bold fs-5">
                            {{ $date }}
                        </span>
                    </div>
                    @foreach($user as $report)
                    
                    <div class="card mt-2 text-bg-dark">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-10">
                                    <div class="fw-bold">Menambah User {{ $report->name }} Sebagai {{$report->role->name}}</div>
                                    <div class="fw-bold">{{$report->email}} || {{$report->created_at}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @empty
                    <span class="btn text-center">Keranjang kosong</span>
                    @endforelse
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
