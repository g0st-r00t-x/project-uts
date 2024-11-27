<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
 
    public function index(Request $request)
    {
        $query = Product::query();

        // Pencarian
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
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

    public function create()
    {
        return Inertia::render('Dashboard/Products/Create/Page');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'nullable|max:255'
        ]);

        Product::create($validated);

        return redirect()->route('products')->with('success', 'Product created successfully');
    }

    public function edit(Product $product)
    {
        return Inertia::render('Dashboard/Products/Update/Page', [
            'product' => $product
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'nullable|max:255'
        ]);

        $product->update($validated);

        return redirect()->route('products')->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products')->with('success', 'Product deleted successfully');
    }
}