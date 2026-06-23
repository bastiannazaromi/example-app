@extends('layouts.main')

@section('title', $title)
@section('page_heading', 'Tambah Berita Baru')

@section('container')
    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    @include('partials.alert')

                    <form action="/posts" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror"
                                required>
                                <option value="">-- Select Category --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                            <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="6" required>{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Post Image</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                                accept=".jpg, .jpeg, .png">
                            <div class="form-text">Format: JPG, JPEG, PNG. Maksimal 2MB.</div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Save Post</button>
                        <a href="/posts" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
