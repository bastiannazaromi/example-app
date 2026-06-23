@extends('layouts.main')

@section('title', $title)
@section('page_heading', 'Edit Berita')

@section('container')
    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    @include('partials.alert')

                    <form action="/posts/{{ $post->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title', $post->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror"
                                required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Content</label>
                            <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="6" required>{{ old('content', $post->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label d-block">Status</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="is_published" id="publish"
                                    value="1" {{ $post->is_published ? 'checked' : '' }}>
                                <label class="form-check-label" for="publish">Publish</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="is_published" id="draft"
                                    value="0" {{ !$post->is_published ? 'checked' : '' }}>
                                <label class="form-check-label" for="draft">Draft</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Post Image</label>

                            @if ($post->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $post->image) }}" class="img-thumbnail d-block"
                                        style="max-height: 150px;">
                                </div>
                            @endif

                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                                accept=".jpg, .jpeg, .png">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update Post</button>
                        <a href="/posts" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
