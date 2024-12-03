<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Warteg Starbhak')</title>
    <!-- Add Bootstrap CSS or other styles here -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles for the sidebar */
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: #4B70F5;
            color: white;
            padding-top: 20px;
            transition: width 0.3s;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
        }
        .sidebar a:hover {
            background-color: #000B58;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s;
        }
        .sidebar.closed {
            width: 0;
        }
        .content.closed {
            margin-left: 0;
        }
        /* Hide sidebar toggle button when sidebar is open */
        .toggle-btn {
            display: none;
        }
        /* Show button when sidebar is closed */
        .sidebar.closed + .content .toggle-btn {
            display: block;
        }
    </style>
</head>
<body>

    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <h3 class="text-center text-white">Warteg Starbhak</h3>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('categories.index') }}">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('menus.index') }}">Menus</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('orders.index') }}">Orders</a>
                </li>
                <!-- Add more sidebar links as needed -->
            </ul>
        </div>

        <!-- Main Content -->
        <div class="content" id="content">
            <!-- Sidebar Toggle Button -->
            <button class="toggle-btn btn btn-primary" id="toggle-btn">Open Sidebar</button>
            
            @include('partials.flash-message') <!-- If you want to display success/error messages -->
            
            @yield('content')
        </div>
    </div>

    <!-- Add Bootstrap JS or other JS libraries here -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // JavaScript to toggle the sidebar visibility
        document.getElementById('toggle-btn').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');
            sidebar.classList.toggle('closed');
            content.classList.toggle('closed');
        });
    </script>
</body>
</html>
