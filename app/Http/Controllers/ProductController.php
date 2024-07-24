<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Catalog;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required',
            'category_id' => 'required|exists:categories,id',
            'catalog_id' => 'required|exists:catalogs,id',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $validatedData['price'] = preg_replace("/[^0-9]/", "", $validatedData['price']);

        // Set default picture name to "none.jpg"
        $pictureName = 'none.jpg';

        if ($request->hasFile('picture')) {
            // If a picture is uploaded, update $pictureName accordingly
            $picture = $request->file('picture');
            $pictureName = time() . '.' . $picture->getClientOriginalExtension();
            $picture->move(public_path('storage/item'), $pictureName);
        }

        $validatedData['slug'] = Str::slug($validatedData['name'], '-');

        Product::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'picture' => $pictureName,
            'slug' => $validatedData['slug'],
            'category_id' => $validatedData['category_id'],
            'catalog_id' => $validatedData['catalog_id'],
        ]);

        return redirect('/admin/produk')->with('sukses', 'Produk Berhasil Ditambahkan');
    }


    public function read()
    {
        return view('pages.admin.pages.product.index', [
            "title" => "Products",
            'products' => Product::all(),
            'categories' => Category::all(),
            'catalogs' => Catalog::all()
        ]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', Rule::unique('products')->ignore($request->id)],
            'description' => 'nullable',
            'editPrice' => 'required',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'category_id' => 'required|exists:categories,id',
            'catalog_id' => 'required|exists:catalogs,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        $validatedData['editPrice'] = preg_replace("/[^0-9]/", "", $validatedData['editPrice']);

        $product = Product::findOrFail($request->id);

        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            $pictureName = time() . '.' . $picture->getClientOriginalExtension();

            // Check if the current picture is "none.jpg"
            if ($product->picture == 'none.jpg') {
                // Don't delete the old picture (none.jpg)
                $picture->move(public_path('storage/item'), $pictureName);
                $product->picture = $pictureName;
            } else {
                // Delete the old picture if it exists
                if (file_exists(public_path('storage/item/' . $product->picture))) {
                    unlink(public_path('storage/item/' . $product->picture));
                }
                $picture->move(public_path('storage/item'), $pictureName);
                $product->picture = $pictureName;
            }
        }

        $validatedData['slug'] = Str::slug($validatedData['name'], '-');

        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['editPrice'];
        $product->slug = $validatedData['slug'];
        $product->category_id = $validatedData['category_id'];
        $product->catalog_id = $validatedData['catalog_id'];
        $product->save();

        return redirect('/admin/produk')->with('sukses', 'Produk Berhasil Diperbarui');
    }


    public function delete(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|exists:products,id',
        ]);

        $product = Product::findOrFail($request->id);

        // Check if the product has an image file
        if ($product->picture != 'none.jpg' && file_exists(public_path('storage/item/' . $product->picture))) {
            // Delete the image file
            unlink(public_path('storage/item/' . $product->picture));
        }

        $product->delete();

        return redirect('/admin/produk')->with('sukses', 'Produk Berhasil Dihapus');
    }

    public function bookCart()
    {
        return view('cart', [
            "title" => "Keranjang"
        ]);
    }

    public function addProducttoCart($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'picture' => $product->picture,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back();
    }

    public function increaseQuantity($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        }
        session()->put('cart', $cart);
        return redirect()->back();
    }

    public function decreaseQuantity($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id]) && $cart[$id]['quantity'] > 1) {
            $cart[$id]['quantity']--;
        }
        session()->put('cart', $cart);
        return redirect()->back();
    }

    public function deleteProduct($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        session()->flash('success', 'Product successfully deleted.');

        return redirect()->back();
    }
}
