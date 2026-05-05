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

        $categories = Category::orderBy('name', 'asc')->get();

        return view('category.index', [
            'title'      => $title,
            'categories' => $categories
        ]);
    }

    public function create()
    {
        $title = 'Tambah Kategori';

        return view('category.create', [
            'title' => $title
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|unique:categories|max:255',
            'description' => 'required',
        ]);

        $validated['slug'] = str($validated['name'])->slug();

        Category::create($validated);

        return redirect('/category')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect('/category')->with('success', 'Kategori berhasil dihapus!');
    }
}
