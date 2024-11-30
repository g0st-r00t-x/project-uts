<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    // Menampilkan daftar produk dengan fitur pencarian dan sorting
    public function index(Request $request)
{
    $query = Product::with('category'); // Load kategori dengan relasi

    // Pencarian
    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhereHas('category', function ($categoryQuery) use ($search) {
                  $categoryQuery->where('name', 'like', "%{$search}%");
              }); // Cari berdasarkan nama kategori
        });
    }

    // Sorting
    $sortColumn = $request->input('sort', 'id');
    $sortDirection = $request->input('direction', 'desc');

    // Validasi kolom sort untuk mencegah SQL Injection
    $allowedColumns = ['id', 'name', 'price', 'stock', 'category', 'created_at'];
    $sortColumn = in_array($sortColumn, $allowedColumns) ? $sortColumn : 'id';

    $query->orderBy($sortColumn, $sortDirection);

    // Pagination
    $products = $query->paginate(10)->appends($request->all());

    return Inertia::render('Dashboard/Products/Page', [
        'products' => $products,
        'filters' => [
            'search' => $request->input('search'),
            'sort' => $sortColumn,
            'direction' => $sortDirection
        ]
    ]);
}

    // Membuka halaman form pembuatan produk
    public function create()
    {
        return Inertia::render('Dashboard/Products/Create/Page');
    }

    // Menyimpan produk baru ke database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id' // Pastikan kategori valid
        ]);

        Product::create($validated);

        return redirect()->route('products')->with('success', 'Produk berhasil dibuat');
    }

    // Membuka halaman edit produk
    public function edit(Product $product)
    {
        return Inertia::render('Dashboard/Products/Update/Page', [
            'product' => $product
        ]);
    }

    // Mengupdate produk yang ada
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id'
        ]);

        $product->update($validated);

        return redirect()->route('products')->with('success', 'Produk berhasil diperbarui');
    }

    // Menghapus produk dari database
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products')->with('success', 'Produk berhasil dihapus');
    }
}
