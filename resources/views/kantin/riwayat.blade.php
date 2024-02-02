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
                    @forelse($transactions as $date => $transaction)
                    <div class="flex text-center gap-3 mb-3 mt-3">
                        <span class="fw-bold fs-5">
                            {{ $date }}
                        </span>
                       <a href="{{ route('transaksiharian', $date) }}" class="btn btn-primary"><i class="bi bi-download"></i></a>
                    </div>
                    @foreach($transaction as $report)
                    
                    <div class="card mt-2 text-bg-dark">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-10">
                                    <div class="fw-bold">{{ $report->user->name }}</div>
                                    <div class="fw-bold">{{$report->order_id}} || {{$report->status}} || {{$report->created_at}}</div>
                                    <div>{{ $report->product->name}} ({{$report->quantity}}) * {{ $report->product->price}}</div>
                                </div>
                                @if($report->status == 'diambil')
                                <div class="col">
                                    <div class="col d-flex justify-content-end align-items-center">
                                        <a href="{{ route('transaksiorder', $report->order_id) }}" class="btn btn-primary"><i class="bi bi-download"></i></a>
                                    </div>
                                </div>
                                @endif
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
