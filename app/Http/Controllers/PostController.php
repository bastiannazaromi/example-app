<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Management Berita';

        $keyword = $request->input('search');

        $posts = Post::with('category')
            ->when($keyword, function ($query, $keyword) {
                return $query->where('title', 'like', '%' . $keyword . '%')
                    ->orWhere('content', 'like', '%' . $keyword . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(3)
            ->withQueryString();

        return view('post.index', [
            'title' => $title,
            'posts' => $posts
        ]);
    }

    public function create()
    {
        $title = 'Tambah Berita';

        $categories = Category::where('is_active', 1)->orderBy('name', 'asc')->get();

        return view('post.create', [
            'title'      => $title,
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id'  => 'required|exists:categories,id',
            'title'        => 'required|unique:posts|max:255',
            'content'      => 'required',
            'image'        => 'image|file|max:2048|mimes:jpeg,png,jpg'
        ]);

        if ($request->file('image')) {
            $validated['image'] = $request->file('image')->store('post-images', 'public');
        }

        $validated['slug'] = str($validated['title'])->slug();

        Post::create($validated);

        return redirect('/posts')->with('success', 'Berita berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::where('is_active', 1)->orderBy('name', 'asc')->get();

        return view('post.edit', [
            'title'      => 'Edit Berita',
            'post'       => $post,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $validated = $request->validate([
            'category_id'  => 'required|exists:categories,id',
            'title'        => 'required|max:255|unique:posts,title,' . $post->id,
            'content'      => 'required',
            'is_published' => 'required|boolean',
            'image'        => 'image|file|max:2048|mimes:jpeg,png,jpg'
        ]);

        if ($request->file('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }

            $validated['image'] = $request->file('image')->store('post-images', 'public');
        }

        $validated['slug'] = str($validated['title'])->slug();

        $post->update($validated);

        return redirect('/posts')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect('/posts')->with('success', 'Berita berhasil dihapus!');
    }
}
