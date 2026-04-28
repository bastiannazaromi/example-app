<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // public function index(Request $request)
    // {
    //     $id = $request->query('id');
    //     $kategori = $request->input('kategori');
    //     return "ID: $id, Kategori: $kategori";
    // }

    // public function sapa($nama)
    // {
    //     echo 'Halo, ' . $nama;
    // }

    public function index()
    {
        $title = 'Management Kategori';

        $categories = Category::where('view_count', '>', 500)
            ->orderBy('view_count', 'desc')
            ->get();

        return view('category.index', [
            'title'      => $title,
            'categories' => $categories
        ]);
    }
}
