<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->back()->with('status','Berhasil Menghapus Ke Keranjang');
        
    }

    public function addtocart(Request $request){
        $transactions = Transaction::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)->where('status','dikeranjang')->first();
        if($transactions){
            $all= $transactions->quantity += $request->quantity;
            if($transactions->product->stock < $all){
                return redirect()->back()->with('status','stok kurang');
            }
            else{
                $transactions->save();
                return redirect()->back()->with('status', 'Berhasil Add to Cart');
            }
        }
        if($request->quantity == 0){
            return redirect()->back()->with('status','isi quantity');
        }
    
        Transaction::create($request->all());


        return redirect()->back()->with('status','Berhasil Menambah Ke Keranjang');
    }

    public function paynow(Request $request){
        $transactions = Transaction::where('user_id', Auth::user()->id)->where('status','dikeranjang')->get();
        $wallet_users = Wallet::where('user_id', Auth::user()->id)->where('status','diterima')->get();
        $total = 0;
        $saldo = 0;
        $credit = 0;
        $debit = 0;
        $date = date('dmYHis');

        foreach ($transactions as $transaction) {
            $total += $transaction->product->price * $transaction->quantity;
            $stock = $transaction->product->stock;
            $quantity = $transaction->quantity;
            $product_id = $transaction->product->id;
        }   
        foreach ($wallet_users as $wallet_user) {
            $credit += $wallet_user->credit;
            $debit += $wallet_user->debit;
            $saldo = $credit-$debit;
        }
        if ($saldo < $total) {
            return redirect()->back()->with('status','Saldo kurang');   
        } else {
            foreach ($transactions as $transaction) {
                Transaction::find($transaction->id)->update([
                    'status'=> 'dibayar',
                    'order_id' => 'ORD_'.$date
                ]);
            }
            Wallet::create([
                'user_id' => Auth::user()->id,
                'debit' => $total,
                'status'=> 'diterima',
                'desc' => 'Membeli Produk'
            ]);
            Wallet::create([
                'user_id' => 4,
                'credit' => $total,
                'status'=> 'diterima',
                'desc' => 'Penjualan Produk'
            ]);
            Product::find($product_id)->update([
                'stock'=> $stock - $quantity,
            ]);
            return redirect()->back()->with('status','Berhasil dibayar');
        }
    }

    public function accept(Transaction $transaction){
        $transaction->update([
            'status'=> 'diambil'
        ]);
        return redirect()->back()->with('status','Sudah Diambil');
    }
}
