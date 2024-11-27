@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Produk</h2>
    <div class="card">
        <div class="card-body">
            <h3>{{ $product->name }}</h3>
            <p><strong>Harga:</strong> Rp{{ number_format($product->price, 0, ',', '.') }}</p>
            <p><strong>Deskripsi:</strong> {{ $product->description }}</p>
        </div>
    </div>
    <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
