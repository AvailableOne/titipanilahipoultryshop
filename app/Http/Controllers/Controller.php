<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Catalog;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Controller extends BaseController
{
    public function index()
    {
        return view('index', [
            "title" => "Situs Bibit, Pakan Ternak, Obat Hewan",
            "catalogs" => Catalog::all(),
            "categories" => Category::with('products')->get(),
            "products" => Product::all()
        ]);
    }

    public function detail($slug)
    {
        // Ambil detail produk berdasarkan slug
        $detail = Product::where('slug', $slug)->firstOrFail();

        // Ambil kategori produk dari produk yang ditemukan
        $category = $detail->category; // Asumsi ada relasi `category` di model Product

        // Ambil semua kategori dengan jumlah produk per kategori
        $categories = Category::withCount('products')->get();

        // Ambil produk terkait dari kategori yang sama
        $relatedProducts = $category ? $category->products->where('id', '!=', $detail->id) : collect();

        return view('detail', [
            "title" => "Detail Produk",
            "categories" => $categories,
            'relatedProducts' => $relatedProducts,
            "detail" => $detail
        ]);
    }


    public function produk()
    {
        $categories = Category::withCount('products')->get(); // Menghitung jumlah produk per kategori

        return view('product', [
            "title" => "Produk",
            "catalogs" => Catalog::all(),
            "categories" => $categories,
            "products" => Product::all()
        ]);
    }

    public function masuk()
    {
        return view('pages.login.index', [
            'title' => 'Masuk'
        ]);
    }

    public function daftar()
    {
        return view('pages.register.index', [
            'title' => 'Daftar'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->intended('/admin');
            } else {
                return redirect()->intended('/');
            }
        }

        return back()->with('loginError', 'Username atau password salah!');
    }


    public function keluar(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function store(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'username' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'no_hp' => 'required|max:15',
            'alamat' => 'required|max:255',
            'password' => 'required|min:5|max:255'
        ]);

        // Hash password sebelum menyimpan ke database
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Tambahkan role default 'user'
        $validatedData['role'] = 'user';

        // Tambahkan role default 'user'
        $validatedData['foto'] = 'avatar.jpg';

        // Buat pengguna baru
        User::create($validatedData);

        // Redirect ke halaman login dengan pesan sukses
        return redirect('/masuk')->with('sukses', 'Registrasi Berhasil, Silahkan Login!');
    }
}
