@extends('layouts.app')

@section('title', 'Edit Order')

@section('content')
<div class="container">
    <h2 class="text-primary mb-4">Edit Order</h2>

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

    <form action="{{ route('orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="customer_name">Customer Name</label>
            <input type="text" name="customer_name" id="customer_name" class="form-control" value="{{ old('customer_name', $order->customer_name) }}" required>
        </div>

        <div class="form-group" id="order-items-container">
            <label for="items">Menu Items</label>
            @foreach ($order->orderItems as $index => $item)
                <div class="order-item">
                    <select name="items[{{ $index }}][menu_id]" class="form-control" required>
                        <option value="">Select Menu Item</option>
                        @foreach ($menus as $menu)
                            <option value="{{ $menu->id }}" {{ $item->menu_id == $menu->id ? 'selected' : '' }}>{{ $menu->name }}</option>
                        @endforeach
                    </select>
                    <input type="number" name="items[{{ $index }}][quantity]" class="form-control mt-2" value="{{ $item->quantity }}" required min="1">
                </div>
            @endforeach
        </div>

        <button type="button" id="add-item-btn" class="btn btn-info mt-3">Add More Items</button>

        <button type="submit" class="btn btn-primary mt-3">Update Order</button>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary mt-3">Back to Orders</a>
    </form>
</div>

<script>
    let itemIndex = {{ count($order->orderItems) }};
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
