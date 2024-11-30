@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Produk</h2>
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nama Produk:</label>
            <input type="text" class="form-control" name="name" value="{{ $product->name }}" required>
        </div>

        <div class="form-group">
            <label for="price">Harga:</label>
            <input type="number" class="form-control" name="price" value="{{ $product->price }}" required>
        </div>

        <div class="form-group">
            <label for="description">Deskripsi:</label>
            <textarea class="form-control" name="description">{{ $product->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Produk</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
