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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cart">
                        <i class="bi bi-cart"></i>
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="cart" tabindex="-1" aria-labelledby="cartLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5 fw-bold" id="cartLabel">Keranjang</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="card">
                                    @foreach ($transaction_users as $transaction_user)    
                                        <div class="card-body text-bg-dark mt-2">
                                            <div class="row">
                                                <div class="col-7 fw-bold">{{ $transaction_user->product->name }} ( {{ $transaction_user->quantity }} ) * {{ $transaction_user->product->price }}</div>
                                                <div class="col text-end">
                                                    <form action="{{ route('transaction.destroy', $transaction_user->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger">X</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col fw-bold">
                                                Total Biaya = {{ $total }}
                                            </div>
                                            <div class="col text-end">
                                                <form action="{{ route('paynow') }}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <button type="submit" class="btn btn-success">Bayar Sekarang</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    {{-- akhir modal --}}
                </div>
                <div class="col">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#topup">
                        Top Up
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="topup" tabindex="-1" aria-labelledby="topupLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="topupLabel">Top Up</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('transaksi') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="status" value="proses">
                                    <input type="hidden" name="desc" value="Top Up">
                                    <input type="number" name="credit" class="form-control" min="10000" value="10000">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Top Up</button>
                                </form>
                            </div>
                        </div>
                        </div>
                    </div>
                    {{-- akhir modal --}}
                </div>
                <div class="col">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tariktunai">
                        Tarik Tunai
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="tariktunai" tabindex="-1" aria-labelledby="tariktunaiLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="tariktunaiLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('transaksi') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="status" value="proses">
                                    <input type="hidden" name="desc" value="Top Up">
                                    <input type="number" name="debit" class="form-control" min="10000" max="{{ $saldo }}" value="10000">
                            </div>
                            <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Tarik Tunai</button>
                                </form>
                            </div>  
                        </div>
                        </div>
                    </div>
                    {{-- akhir modal --}}
                </div>
            </div>
            <div>
                <h2 class="fw-bold">PRODUCT</h2>
            </div>
            <div>
                <form action="home" method="get">
                    <div class="row">
                        <label for="category">Kategori</label>
                        <div class="col-md-2">
                            <select name="category" class="form-control">
                                <option value="all">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                                <option value = "all">Semua Kategori</option>
                            </select>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Pilih</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row mt-3">
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
                                                <div class="col-7">
                                                    <form action="{{ route('addtocart') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                        <input type="number" name="quantity" class="form-control" min="1" max="{{ $product->stock }}" value="1">
                                                </div>
                                                <div class="col">
                                                    <button type="submit" class="btn btn-primary"><i class="bi bi-plus-lg"></i></button>
                                                </div>
                                                    </form>
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
