@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header fw-bold text-center">
                    {{ $date }}
                </div>
                
                <div class="card-body">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Product</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        @foreach ($transactions as $report)    
                            <tbody>
                                <tr>
                                    <td class="col-2">{{ $report->user->name }}</td>
                                    <td class="col-2">{{ $report->product->name }}</td>
                                    <td class="col-2">{{ $report->quantity }}</td>
                                    <td class="col-4">Rp. {{ number_format($report->quantity * $report->product->price) }}</td>
                                </tr>
                            </tbody>
                        @endforeach 
                        </table>
                        <div class="row text-center">
                            <div class="col-7 fw-bold">Total</div>
                            <div class="col">Rp. {{ number_format($total) }}</div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <script>
        window.print()
    </script>
</div>
@endsection
