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
                                    <label for="user_id">Nasabah</label>
                                    <select name="user_id" class="form-control">
                                        @foreach ($nasabah as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="credit">Nominal</label>
                                    <input type="hidden" name="status" value="diterima">
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
                            <h1 class="modal-title fs-5" id="tariktunaiLabel">Tarik Tunai</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('transaksi') }}" method="post">
                                    @csrf
                                    <label for="user_id">Nasabah</label>
                                    <select name="user_id" class="form-control">
                                        @foreach ($nasabah as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="debit">Nominal</label>
                                    <input type="hidden" name="status" value="diterima">
                                    <input type="hidden" name="desc" value="Tarik Tunai">
                                    <input type="number" name="debit" class="form-control" min="10000" value="10000">
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
                <h2 class="fw-bold">Daftar Request Dana</h2>
            </div>
            <div class="row">
                @foreach ($wallet_banks as $wallet_bank)    
                    <div class="col-4">
                        <div class="card text-bg-dark mt-2">
                            <div class="card-body text-bg-dark mt-2">
                                <div class="row">
                                    <div class="col-7 fw-bold">
                                        <div class="fw-bold">{{ $wallet_bank->user->name }} </div>
                                        <div> {{ $wallet_bank->created_at }}</div>
                                        {{ $wallet_bank->desc }} ( {{ $wallet_bank->credit ? "+ $wallet_bank->credit" : "- $wallet_bank->debit"}} )
                                    </div>
                                    <div class="col text-end">
                                        <form action="{{ route('acceptsaldo', $wallet_bank->id) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <button type="submit" class="btn btn-success"><i class="bi bi-check"></i></button>
                                        </form>
                                    </div>      
                                    <div class="col text-end">
                                        <form action="{{ route('reject', $wallet_bank->id) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <button type="submit" class="btn btn-danger">X</button>
                                        </form>
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
