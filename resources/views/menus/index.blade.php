@extends('layouts.app')

@section('title', 'Menus')

@section('content')
    <div class="container-fluid">
        <h2 class="text-center text-primary mb-4">Menus</h2>

        <!-- Success and Error Messages -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Button to Create New Menu -->
        <div class="mb-3">
            <a href="{{ route('menus.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Menu
            </a>
        </div>

        <!-- Menus Table -->
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="m-0">Menu List</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Menu Name</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($menus as $menu)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $menu->name }}</td>
                                <td>${{ number_format($menu->price, 2) }}</td>
                                <td>{{ $menu->category->category_name }}</td>
                                <td>
                                    <!-- Edit Button -->
                                    <a href="{{ route('menus.edit', $menu) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('menus.destroy', $menu) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this menu?')">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No menus found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/font-awesome@5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .card {
            border-radius: 10px;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .table thead {
            background-color: #f8f9fa;
        }

        .alert {
            margin-bottom: 20px;
        }

        .btn-sm {
            font-size: 0.875rem;
        }
    </style>
@endpush
