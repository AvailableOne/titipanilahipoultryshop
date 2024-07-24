<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Http\RedirectResponse;

class CatalogController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:catalogs',
        ]);

        $validatedData['slug'] = Str::slug($validatedData['name']);

        Catalog::create($validatedData);

        return redirect('/admin/katalog')->with('sukses', 'Katalog Berhasil Ditambahkan !');
    }

    public function read()
    {
        return view('pages.admin.pages.catalog.index', [
            "title" => "Katalog",
            'catalog' => Catalog::all()
        ]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => [
                'required',
                'max:255',
                Rule::unique('catalogs')->ignore($request->id),
            ],
        ]);

        $validatedData['slug'] = Str::slug($validatedData['name']);

        $category = Catalog::findOrFail($request->id);
        $category->update($validatedData);

        return redirect('/admin/katalog')->with('sukses', 'Katalog Berhasil Diperbarui !');
    }

    public function delete(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|exists:catalogs,id',
        ]);

        $category = Catalog::findOrFail($request->id);
        $category->delete();

        return redirect('/admin/katalog')->with('sukses', 'Katalog Berhasil Dihapus !');
    }

    public function showProducts(Catalog $catalog)
    {
        $product = $catalog->product;

        return view('pages.admin.pages.catalog.product', [
            "title" => "List Katalog",
            'catalog' => $catalog,
            'product' => $product,
        ]);
    }
}