<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    // Tampilkan daftar kategori
    public function index(Request $request)
    {
        $categories = Category::orderBy('name', 'asc')->paginate(10)->appends($request->all());

        return Inertia::render('Dashboard/Categories/Page', [
            'categories' => $categories,
            'filters' => [
                'search' => $request->input('search')
            ]
        ]);
    }

    // Tampilkan halaman pembuatan kategori baru
    public function create()
    {
        return Inertia::render('Dashboard/Categories/Create/Page');
    }

    // Simpan kategori baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string|max:1000',
        ]);

        Category::create($validated);

        return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }

    // Tampilkan halaman edit kategori
    public function edit(Category $category)
    {
        return Inertia::render('Dashboard/Categories/Edit/Page', [
            'category' => $category
        ]);
    }

    // Update data kategori
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string|max:1000',
        ]);

        $category->update($validated);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    // Hapus kategori
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }
}
