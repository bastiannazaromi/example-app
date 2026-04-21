<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // public function index(Request $request)
    // {
    //     $id = $request->query('id');
    //     $kategori = $request->input('kategori');
    //     return "ID: $id, Kategori: $kategori";
    // }

    public function sapa($nama)
    {
        echo 'Halo, ' . $nama;
    }

    public function index()
    {
        $data = [
            'title'    => 'Kategori'
        ];

        return view('category.index', compact('data'));
    }
}
