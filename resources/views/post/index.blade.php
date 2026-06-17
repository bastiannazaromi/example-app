@extends('layouts.main')

@section('title', $title)
@section('page_heading', $title)

@section('container')
    @include('partials.alert')

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <a href="/posts/create" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg"></i> Add
            </a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $i => $post)
                        <tr>
                            <td class="text-center">{{ $i + 1 }}</td>
                            <td>{{ $post->title }}</td>
                            <td class="text-center"><span class="badge bg-secondary">{{ $post->category->name }}</span></td>
                            <td><code>{{ $post->slug }}</code></td>
                            <td class="text-center">
                                @if ($post->is_published)
                                    <span class="badge bg-success">Published</span>
                                @else
                                    <span class="badge bg-warning">Draft</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="/posts/{{ $post->id }}/edit" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="/posts/{{ $post->id }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin hapus berita ini?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No post data available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
