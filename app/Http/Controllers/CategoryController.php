<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:categories',
        ]);

        $validatedData['slug'] = Str::slug($validatedData['name']);

        Category::create($validatedData);

        return redirect('/admin/kategori')->with('sukses', 'Kategori Berhasil Ditambahkan !');
    }

    public function read()
    {
        return view('pages.admin.pages.category.index', [
            "title" => "Kategori",
            'categories' => Category::all()
        ]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => [
                'required',
                'max:255',
                Rule::unique('categories')->ignore($request->id),
            ],
        ]);

        $validatedData['slug'] = Str::slug($validatedData['name']);

        $category = Category::findOrFail($request->id);
        $category->update($validatedData);

        return redirect('/admin/kategori')->with('sukses', 'Kategori Berhasil Diperbarui !');
    }

    public function delete(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|exists:categories,id',
        ]);

        $category = Category::findOrFail($request->id);
        $category->delete();

        return redirect('/admin/kategori')->with('sukses', 'Kategori Berhasil Dihapus !');
    }

    public function showProducts(Category $category)
    {
        $product = $category->product;

        return view('pages.admin.pages.category.product', [
            "title" => "List Kategori",
            'category' => $category,
            'product' => $product,
        ]);
    }
}
