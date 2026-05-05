@extends('layouts.main')

@section('title', $title)
@section('page_heading', $title)

@section('container')
    @include('partials.alert')

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <a href="/category/create" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg"></i> Add
            </a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Category Name</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Viewed</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $i => $category)
                        <tr>
                            <td class="text-center">{{ $i + 1 }}</td>
                            <td>{{ $category->name }}</td>
                            <td><code>{{ $category->slug }}</code></td>
                            <td>{{ $category->description }}</td>
                            <td class="text-center">
                                <span class="badge bg-info text-dark"><i class="bi bi-eye"></i>
                                    {{ $category->view_count }}</span>
                            </td>
                            <td class="text-center">
                                @if ($category->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
                                    <form action="/category/{{ $category->id }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No category data available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
