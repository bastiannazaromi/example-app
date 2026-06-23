@extends('layouts.main')

@section('title', $title)
@section('page_heading', $title)

@section('container')
    @include('partials.alert')

    <div class="card border-0 shadow-sm">
        <div
            class="card-header bg-white py-3 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <a href="/posts/create" class="btn btn-primary btn-sm me-auto">
                <i class="bi bi-plus-lg"></i> Add
            </a>

            <form action="/posts" method="GET" class="d-flex gap-2 col-md-4">
                <input type="text" name="search" class="form-control form-control-sm"
                    placeholder="Cari judul atau isi berita..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-secondary btn-sm px-3">
                    <i class="bi bi-search"></i>
                </button>
                @if (request('search'))
                    <a href="/posts" class="btn btn-outline-danger btn-sm"><i class="bi bi-arrow-clockwise"></i></a>
                @endif
            </form>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $i => $post)
                        <tr>
                            <td class="text-center">{{ $posts->firstItem() + $i }}</td>
                            <td class="text-center">
                                @if ($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}" class="img-thumbnail"
                                        style="max-width: 80px;">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>{{ $post->title }}</td>
                            <td class="text-center"><span class="badge bg-secondary">{{ $post->category->name }}</span></td>
                            <td class="text-center">
                                <span class="badge {{ $post->is_published ? 'bg-success' : 'bg-warning' }}">
                                    {{ $post->is_published ? 'Published' : 'Draft' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="/posts/{{ $post->id }}/edit" class="btn btn-sm btn-warning"><i
                                            class="bi bi-pencil"></i></a>

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
                            <td colspan="6" class="text-center text-muted">No post data available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-end mt-3">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
