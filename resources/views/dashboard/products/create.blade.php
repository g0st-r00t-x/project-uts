@extends('layouts.app')

@section('content')
<h1>Tambah Produk</h1>
<form action="{{ route('products.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Nama Produk:</label>
        <input type="text" name="name" class="form-control">
    </div>
    <div class="form-group">
        <label>Harga:</label>
        <input type="number" name="price" class="form-control">
    </div>
    <div class="form-group">
        <label>Deskripsi:</label>
        <textarea name="description" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
</form>
@endsection
