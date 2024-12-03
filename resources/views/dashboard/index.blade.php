@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <h2 class="mb-4 text-center text-primary">Dashboard</h2>

        <!-- Button to toggle the sidebar -->
        <button class="toggle-btn btn btn-primary mb-3" id="toggle-btn">
            <i class="fas fa-bars"></i> Toggle Sidebar
        </button>

        <!-- Button to go back to dashboard -->
        <a href="{{ route('dashboard') }}" class="btn btn-secondary mb-3">Back to Dashboard</a>

        <!-- Button for logout -->
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-danger mb-3">Logout</button>
        </form>

        <div class="row justify-content-center">
            <!-- Container for Categories Count -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-lg border-left-primary">
                    <div class="card-body text-center">
                        <i class="fas fa-list-alt fa-3x text-primary mb-3"></i>
                        <h5 class="card-title text-primary">Total Categories</h5>
                        <h3 class="card-text font-weight-bold">{{ $totalCategories }}</h3>
                        <p class="text-muted">Total number of categories available.</p>
                    </div>
                </div>
            </div>

            <!-- Container for Menus Count -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-lg border-left-success">
                    <div class="card-body text-center">
                        <i class="fas fa-utensils fa-3x text-success mb-3"></i>
                        <h5 class="card-title text-success">Total Menus</h5>
                        <h3 class="card-text font-weight-bold">{{ $totalMenus }}</h3>
                        <p class="text-muted">Total number of menus available.</p>
                    </div>
                </div>
            </div>

            <!-- Container for Orders Count -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-lg border-left-warning">
                    <div class="card-body text-center">
                        <i class="fas fa-clipboard-list fa-3x text-warning mb-3"></i>
                        <h5 class="card-title text-warning">Total Orders</h5>
                        <h3 class="card-text font-weight-bold">{{ $totalOrders }}</h3>
                        <p class="text-muted">Total number of orders placed.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/font-awesome@5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .card {
            border-radius: 15px;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .card-body {
            padding: 30px;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .card-text {
            font-size: 1.2rem;
        }

        .shadow-lg {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .border-left-primary {
            border-left: 5px solid #007bff;
        }

        .border-left-success {
            border-left: 5px solid #28a745;
        }

        .border-left-warning {
            border-left: 5px solid #ffc107;
        }

        .toggle-btn {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .btn-secondary {
            margin-right: 10px;
        }
    </style>
@endpush
