<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Catalog;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('pages.admin.index', [
            "title" => "Admin",
            "catalogs" => Catalog::count(),
            "categories" => Category::count(),
            "products" => Product::count(),
            "users" => User::where('role', 'user')->count()
        ]);
    }
}
