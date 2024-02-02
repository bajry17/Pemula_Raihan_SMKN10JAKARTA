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
                {{-- Dompet --}}
                <div class="col">
                    <h1>Mutasi Wallet</h1>
                    @forelse($wallets as $date => $wallet)
                    <div class="flex text-center gap-3 mb-3 mt-3">
                        <span class="fw-bold fs-5">
                            {{ $date }}
                        </span>
                    </div>
                    @foreach($wallet as $mutasi) 
                    @if ($mutasi->status == 'diterima')
                    <div class="card mt-2 text-bg-success">
                        <div class="card-body">
                            <div class="fw-bold">{{ $mutasi->user->name }}</div>
                            <div class="fw-bold">{{$mutasi->desc}} || {{$mutasi->status}} || {{$mutasi->created_at}}</div>
                            <div>{{ $mutasi->credit ? "+ $mutasi->credit":"- $mutasi->debit"}}</div>
                        </div>
                    </div>
                    @endif
                    @if ($mutasi->status =='proses')
                    <div class="card mt-2 text-bg-warning">
                        <div class="card-body">
                            <div class="fw-bold">{{ $mutasi->user->name }}</div>
                            <div class="fw-bold">{{$mutasi->desc}} || {{$mutasi->status}} || {{$mutasi->created_at}}</div>
                            <div>{{ $mutasi->credit ? "+ $mutasi->credit":"- $mutasi->debit"}}</div>
                        </div>
                    </div>
                    @endif
                    @if($mutasi->status =='ditolak')
                    <div class="card mt-2 text-bg-danger">
                        <div class="card-body">
                            <div class="fw-bold">{{ $mutasi->user->name }}</div>
                            <div class="fw-bold">{{$mutasi->desc}} || {{$mutasi->status}} || {{$mutasi->created_at}}</div>
                            <div>{{ $mutasi->credit ? "+ $mutasi->credit":"- $mutasi->debit"}}</div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    @empty
                    <span>Mutasi Kosong</span>
                    @endforelse
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
