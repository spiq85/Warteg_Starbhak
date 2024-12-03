@extends('layouts.app')

@section('title', 'Create Order')

@section('content')
<div class="container">
    <h2 class="text-primary mb-4">Create Order</h2>

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

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="customer_name">Customer Name</label>
            <input type="text" name="customer_name" id="customer_name" class="form-control" placeholder="Enter customer name" required>
        </div>

        <div class="form-group" id="order-items-container">
            <label for="items">Menu Items</label>
            <div class="order-item">
                <select name="items[0][menu_id]" class="form-control" required>
                    <option value="">Select Menu Item</option>
                    @foreach ($menus as $menu)
                        <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                    @endforeach
                </select>
                <input type="number" name="items[0][quantity]" class="form-control mt-2" placeholder="Quantity" required min="1">
            </div>
        </div>

        <button type="button" id="add-item-btn" class="btn btn-info mt-3">Add More Items</button>

        <button type="submit" class="btn btn-primary mt-3">Create Order</button>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary mt-3">Back to Orders</a>
    </form>
</div>

<script>
    let itemIndex = 1;
    document.getElementById('add-item-btn').addEventListener('click', function() {
        const itemContainer = document.createElement('div');
        itemContainer.classList.add('order-item', 'mt-3');
        
        const selectMenu = `<select name="items[${itemIndex}][menu_id]" class="form-control" required>
            <option value="">Select Menu Item</option>
            @foreach ($menus as $menu)
                <option value="{{ $menu->id }}">{{ $menu->name }}</option>
            @endforeach
        </select>`;

        const quantityInput = `<input type="number" name="items[${itemIndex}][quantity]" class="form-control mt-2" placeholder="Quantity" required min="1">`;

        itemContainer.innerHTML = selectMenu + quantityInput;
        document.getElementById('order-items-container').appendChild(itemContainer);
        itemIndex++;
    });
</script>
@endsection
