<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if($request->category == 1) {
            $products = Product::where('category_id', 1 )->get();
        }elseif($request->category == 2){
            $products = Product::where('stand', 2)->get();
        }elseif($request->category == 3){
            $products = Product::where('stand', 3)->get();
        }elseif($request->category == 'all'){
            $products = Product::all();
        }else{
            $products = Product::all();
        }
        $categories = Category::all();
        $transaction_users = Transaction::where('user_id', Auth::user()->id)->where('status','dikeranjang')->get();
        $wallet_users = Wallet::where('user_id', Auth::user()->id)->where('status','diterima')->get();
        $transaction_kantins = Transaction::where('status','dibayar')->get();
        $wallet_users = Wallet::where('user_id', Auth::user()->id)->where('status','diterima')->get();
        $wallet_banks = Wallet::where('status','proses')->get();
        $users = User::all();
        $nasabah = User::where('role_id','1')->get();
        $total = 0;
        $saldo = 0;
        $credit = 0;
        $debit = 0;

        foreach ($transaction_users as $transaction_user) {
            $total += $transaction_user->product->price * $transaction_user->quantity;
        }
        foreach ($wallet_users as $wallet_user) {
            $credit += $wallet_user->credit;
            $debit += $wallet_user->debit;
            $saldo = $credit-$debit;
        }

        if(Auth::user()->role_id == 1){
        return view('user.index', compact('products','categories','transaction_users','wallet_users','total','saldo'));
        }
        elseif(Auth::user()->role_id == 2){
            return view('admin.index', compact('users'));
        }
        elseif(Auth::user()->role_id == 3){ 
            return view('bank.index', compact('wallet_banks','nasabah'));
        }
        elseif(Auth::user()->role_id == 4){
            return view('kantin.index', compact('transaction_kantins','products','saldo'));
        }
    }

    public function riwayat(){
        if(Auth::user()->role_id == 1){
            // $transactions = Transaction::where('user_id', Auth::user()->id)->get();
            $transactions = Transaction::with('product','user')->where('user_id', Auth::user()->id)->latest()->get()->groupBy(function ($item){
                return $item->created_at->toDateString();
            });
            $wallets = Wallet::with('user')->where('user_id', Auth::user()->id)->latest()->get()->groupBy(function ($item){
                return $item->created_at->toDateString();
            }); 
    
            return view("user.riwayat", compact("transactions",'wallets'));
            }elseif(Auth::user()->role_id == 2){
                $users = User::latest()->get()->groupBy(function ($item){
                    return $item->created_at->toDateString();
                });;
                return view("admin.riwayat", compact("users"));
            }
            elseif(Auth::user()->role_id == 3){
                $wallets = Wallet::with('user')->latest()->get()->groupBy(function ($item){
                    return $item->created_at->toDateString();
                });
                return view("bank.riwayat", compact('wallets'));
            }
            elseif(Auth::user()->role_id == 4){
                $transactions = Transaction::with('product','user')->latest()->get()->groupBy(function ($item){
                    return $item->created_at->toDateString();
                });
    
                return view("kantin.riwayat", compact("transactions"));
            }
    }

    public function transaksiharian($date){
        if(Auth::user()->role_id == 1){
            $transactions = Transaction::with('product','user')->where('user_id',Auth::user()->id)->whereDate('created_at', "=",     $date)->where('status','diambil')->latest()->get();
        }else{
            $transactions = Transaction::with('product','user')->whereDate('created_at', "=",    $date)->where('status','diambil')->latest()->get();
        }
        $total = 0;
            foreach ($transactions as $transaction) {
                $total += $transaction->product->price * $transaction->quantity;
            } 

        return view('downloadharian', compact('transactions','date','total'));
    }

    public function transaksiorder($order_id){  
        if(Auth::user()->role_id == 1){
            $transactions = Transaction::with('product','user')->where('user_id',Auth::user()->id)->where('order_id', $order_id)->where('status','diambil')->latest()->get();
        }else{
            $transactions = Transaction::with('product','user')->where('order_id', $order_id)->where('status','diambil')->latest()->get();
        }
        $total = 0;
            foreach ($transactions as $transaction) {
                $total += $transaction->product->price * $transaction->quantity;
            } 

        return view('download', compact('transactions','order_id','total'));
    }
}   
