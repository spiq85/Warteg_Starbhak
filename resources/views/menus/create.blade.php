@extends('layouts.app')

@section('title', 'Create Menus')

@section('content')
    <div class="container">
        <h2 class="text-primary mb-4">Create Menus</h2>

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

        <!-- Menu Create Form -->
        <form action="{{ route('menus.store') }}" method="POST">
            @csrf

            <div id="menu-fields">
                <div class="menu-item">
                    <h4>Menu 1</h4>
                    <div class="form-group">
                        <label for="name_1">Menu Name</label>
                        <input type="text" name="menus[0][name]" id="name_1" class="form-control" placeholder="Enter menu name" required>
                    </div>
                    <div class="form-group">
                        <label for="price_1">Price</label>
                        <input type="number" name="menus[0][price]" id="price_1" class="form-control" placeholder="Enter price" required>
                    </div>
                    <div class="form-group">
                        <label for="description_1">Description (Optional)</label>
                        <textarea name="menus[0][description]" id="description_1" class="form-control" rows="4" placeholder="Enter description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="category_id_1">Category</label>
                        <select name="menus[0][category_id]" id="category_id_1" class="form-control" required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Button to add more menus -->
            <button type="button" id="add-menu" class="btn btn-info mb-3">Add Another Menu</button>

            <button type="submit" class="btn btn-primary">Create Menus</button>
            <a href="{{ route('menus.index') }}" class="btn btn-secondary">Back to Menus</a>
        </form>
    </div>

    @push('scripts')
        <script>
            let menuCount = 1;

            // Add new menu form dynamically
            document.getElementById('add-menu').addEventListener('click', function() {
                menuCount++;
                const menuFields = document.getElementById('menu-fields');

                // Create new menu form fields
                const newMenu = document.createElement('div');
                newMenu.classList.add('menu-item');
                newMenu.innerHTML = `
                    <h4>Menu ${menuCount}</h4>
                    <div class="form-group">
                        <label for="name_${menuCount}">Menu Name</label>
                        <input type="text" name="menus[${menuCount - 1}][name]" id="name_${menuCount}" class="form-control" placeholder="Enter menu name" required>
                    </div>
                    <div class="form-group">
                        <label for="price_${menuCount}">Price</label>
                        <input type="number" name="menus[${menuCount - 1}][price]" id="price_${menuCount}" class="form-control" placeholder="Enter price" required>
                    </div>
                    <div class="form-group">
                        <label for="description_${menuCount}">Description (Optional)</label>
                        <textarea name="menus[${menuCount - 1}][description]" id="description_${menuCount}" class="form-control" rows="4" placeholder="Enter description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="category_id_${menuCount}">Category</label>
                        <select name="menus[${menuCount - 1}][category_id]" id="category_id_${menuCount}" class="form-control" required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                `;

                menuFields.appendChild(newMenu);
            });
        </script>
    @endpush
@endsection
