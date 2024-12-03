@extends('layouts.app')

@section('title', 'Edit Menu')

@section('content')
    <div class="container">
        <h2 class="text-primary mb-4">Edit Menu</h2>

        <!-- Display validation errors if any -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Menu Edit Form -->
        <form action="{{ route('menus.update', $menu->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Menu Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $menu->name) }}" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $menu->price) }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description (Optional)</label>
                <textarea name="description" id="description" class="form-control" rows="4" placeholder="Enter description">{{ old('description', $menu->description) }}</textarea>
            </div>
            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $menu->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Menu</button>
            <a href="{{ route('menus.index') }}" class="btn btn-secondary">Back to Menus</a>
        </form>
    </div>
@endsection
