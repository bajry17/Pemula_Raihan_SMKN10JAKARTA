<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
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
    public function show(Wallet $wallet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wallet $wallet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wallet $wallet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wallet $wallet)
    {
        //
    }

    public function transaksi(Request $request){
        $wallets = Wallet::where("user_id", $request->id)->get();
        $credit = 0;
        $debit = 0;
        $saldo = 0;
        foreach ($wallets as $wallet) {
            $credit += $wallet->credit;
            $debit += $wallet->debit;
            $saldo = $credit-$debit;
        }
            Wallet::create($request->all());
            if(Auth::user()->role_id == 1){
                return redirect()->back()->with('status','Berhasil Mengirim request');
            }else{
                return redirect()->back()->with('status','Berhasil');
            }
    }
    public function acceptsaldo(Wallet $wallet){
        $wallet->update([
            'status'=> 'diterima'
        ]);
        return redirect()->back()->with('status','diterima');
    }
    public function reject(Wallet $wallet){
        $wallet->update([
            'status'=> 'ditolak'
        ]);
        return redirect()->back()->with('status','ditolak');
    }
}
