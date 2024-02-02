<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
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
        return view("kantin.tambah");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $date = date("dmYhis");
        $photoPath = "/photos/$date.png";
        if($request->hasFile("photo")){
            $request->file("photo")->move("photos/", "$date.png");
        }

        Product::create([
            'name'  => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'stand' => $request->stand,
            'photo' => $photoPath,
            'desc'  => $request->desc
        ]);

        return redirect('/home')->with('status','Berhasil Menambah Produk');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view("kantin.edit", compact("product"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $productImage = $product->photo;
        $date = date("dmYhis");
        $photoPath = "/photos/$date.png";
        if($request->hasFile("photo")){
            $request->file("photo")->move("photos/", "$date.png");
            unlink(public_path($productImage));
            $photoPath = "/photos/$date.png";
        }
        else{
            $photoPath = $product->photo;
        }

        $product->update([
            'name'  => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'stand' => $request->stand,
            'photo' => $photoPath,
            'desc'  => $request->desc
        ]);

        return redirect('/home')->with('status','Berhasil Mengedit Produk');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $productImage = $product->photo;
        unlink(public_path($productImage));
        $product->delete();

        return redirect('/home')->with('status','Berhasil Menghapus Produk');
    }
}
