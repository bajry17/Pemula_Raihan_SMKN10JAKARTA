@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-bg-dark text-center">Edit Produk</div>

                <div class="card-body">
                    <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')  
                        <label for="name">Nama Produk</label>
                        <input type="text" name="name" class="form-control" value="{{ $product->name }}">
                        <label for="price">Harga Produk</label>
                        <input type="number" name="price" class="form-control" value="{{ $product->price }}">
                        <label for="stock">Stok Produk</label>
                        <input type="number" name="stock" class="form-control" value="{{ $product->stock }}">
                        <label for="photo">Foto Produk</label>
                        <input type="file" name="photo" class="form-control" value="{{ $product->photo }}">
                        <label for="stand">Stand</label>
                        <select name="stand" class="form-control">
                            <option value="{{ $product->stand }}">{{ $product->stand }}</option>
                            @foreach ($stands=['1','2','3'] as $stand)
                                <option value="{{ $stand }}">{{ $stand }}</option>
                            @endforeach
                        </select>
                        <label for="desc">Deskripsi Produk</label>
                        <textarea name="desc" class="form-control" cols="30" rows="3">{{ $product->desc }}</textarea>
                        <div class="col d-grid gap-2 mt-3">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
