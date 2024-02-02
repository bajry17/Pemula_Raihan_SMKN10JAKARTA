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
                    <p class="text-secondary fw-bold">Saldo Anda Rp. {{ number_format($saldo) }}</p>
                </div>
                <div class="col">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#cart">
                        <i class="bi bi-bell"></i>
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="cart" tabindex="-1" aria-labelledby="cartLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5 fw-bold" id="cartLabel">Daftar  </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @foreach ($transaction_kantins as $transaction_kantin)
                                    
                                    <div class="card">
                                        <div class="card-body text-bg-dark mt-2">
                                            <div class="fw-bold">{{ $transaction_kantin->user->name }} || {{ $transaction_kantin->created_at }} || {{ $transaction_kantin->order_id }}</div>
                                            <div class="row">
                                                <div class="col-7 fw-bold">{{ $transaction_kantin->product->name }} ( {{ $transaction_kantin->quantity }} ) * {{ $transaction_kantin->product->price }}</div>
                                                <div class="col text-end">
                                                    <form action="{{ route('accept', $transaction_kantin->id) }}" method="post">
                                                        @csrf
                                                        @method('put')
                                                        <button type="submit" class="btn btn-success"><i class="bi bi-check"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        </div>
                    </div>
                    {{-- akhir modal --}}
                </div>
                <div class="col">
                    <a href="{{ route('product.create') }}" class="btn btn-primary">Tambah Produk</a>
                </div>
            </div>
            <div>
                <h2 class="fw-bold">PRODUCT</h2>
            </div>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-4 mt-3">
                        <div class="card">            
                            <div class="card-body text-bg-dark">
                                <div class="row">
                                    <div class="col">
                                        <img class="rounded-3" src="{{ $product->photo }}" height="150px" width="100%" alt="">
                                    </div>
                                    <div class="col">
                                        <div class="fw-bold">
                                            {{ $product->name }}
                                        </div>
                                        <div>
                                           Rp. {{ number_format($product->price) }}
                                        </div>
                                        <div>
                                            Stock : {{ $product->stock }}
                                        </div>
                                        <div>
                                            Stand : {{ $product->stand }}
                                        </div>
                                        <div class="mt-3">
                                            <div class="row">
                                                <div class="col text-start">
                                                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                                                </div>
                                                <div class="col text-end">
                                                    <form action="{{ route('product.destroy', $product->id) }}" method="post">
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
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
