<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bbistro - Self Ordering Kiosk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #e74c3c;
            --accent: #f39c12;
            --light: #ecf0f1;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            overflow: hidden;
        }
        
        .kiosk-container {
            max-width: 1200px;
            height: 100vh;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
        }
        
        .kiosk-header {
            background: linear-gradient(135deg, var(--primary), #1a2530);
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            z-index: 100;
        }
        
        .kiosk-logo {
            font-size: 1.8rem;
            font-weight: 700;
            display: flex;
            align-items: center;
        }

        /* Add to existing styles */
        .header-logo {
            height: 40px;
            width: auto;
            margin-right: 10px;
        }

        .welcome-logo {
            max-width: 200px;
            height: auto;
            border-radius: 50%;
            background: white;
            padding: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .kiosk-logo i {
            color: var(--accent);
            margin-right: 10px;
        }
        
        .kiosk-main {
            flex-grow: 1;
            overflow-y: auto;
            padding: 20px;
            background-color: white;
        }
        
        .kiosk-footer {
            background-color: var(--primary);
            color: white;
            padding: 10px 20px;
            text-align: center;
            font-size: 0.9rem;
        }
        
        .btn-kiosk {
            background: var(--secondary);
            color: white;
            border: none;
            padding: 15px 25px;
            font-size: 1.2rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        
        .btn-kiosk:hover {
            background: #c0392b;
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.2);
        }
        
        .btn-kiosk-secondary {
            background: var(--primary);
        }
        
        .btn-kiosk-secondary:hover {
            background: #1a2530;
        }
        
        .card-kiosk {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .card-kiosk:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.15);
        }
        
        .cart-icon {
            position: relative;
            font-size: 1.5rem;
        }
        
        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--secondary);
            color: white;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
        }
        
        .category-nav {
            display: flex;
            overflow-x: auto;
            padding: 10px 0;
            margin-bottom: 20px;
            scrollbar-width: none;
        }
        
        .category-nav::-webkit-scrollbar {
            display: none;
        }
        
        .category-btn {
            flex: 0 0 auto;
            padding: 8px 20px;
            margin-right: 10px;
            border-radius: 20px;
            background: #e9ecef;
            border: none;
            font-weight: 500;
            white-space: nowrap;
        }
        
        .category-btn.active {
            background: var(--secondary);
            color: white;
        }
        
        .cart-item {
            display: flex;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #eee;
        }
        
        .table-card {
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .table-card.selected {
            box-shadow: 0 0 0 3px var(--accent);
        }
        
        .table-available {
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            color: white;
        }
        
        .table-occupied {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: white;
        }
        
        .floating-cart {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--secondary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.25);
        }
        
        .product-image {
            height: 150px;
            object-fit: cover;
            width: 100%;
            object-position: center;
        }

        .product-image-placeholder {
            height: 150px;
            background-color: #eee;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-image-placeholder i {
            font-size: 2rem;
            color: #aaa;
        }
        
        .quantity-control {
            display: flex;
            align-items: center;
        }
        
        .quantity-btn {
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #ddd;
            background: #f8f9fa;
        }
        
        .quantity-input {
            width: 50px;
            text-align: center;
            border: 1px solid #ddd;
            height: 30px;
            margin: 0 5px;
        }
    </style>
</head>
<body>
    <div class="kiosk-container">
        <header class="kiosk-header">
            <a href="{{ route('welcome') }}" class="kiosk-logo text-decoration-none text-white">
                <img src="{{ asset('images/photo_6057551501695498248_x1.jpg') }}" alt="Bbistro Logo" class="header-logo">
                <span>Bbistro</span>
            </a>
            <div>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/home') }}" class="btn btn-sm btn-light me-2">
                            <i class="fas fa-user-cog"></i> Home</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-sm btn-light me-2">
                            <i class="fas fa-sign-in-alt"></i> Admin Login</a>

                    @endauth
                @endif
            </div>
        </header>
        
        <main class="kiosk-main">
            @yield('content')
        </main>
        
        <footer class="kiosk-footer">
             {{ date('Y') }} Bbistro Kiosk Ordering System
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Basic cart management functions
        function updateCartCount(count) {
            $('#cart-count').text(count);
        }
        
        function addToCart(productId) {
            // This would be AJAX in real implementation
            alert(`Added product ${productId} to cart`);
            const currentCount = parseInt($('#cart-count').text()) || 0;
            updateCartCount(currentCount + 1);
        }
        
        // Initialize cart count
        $(document).ready(function() {
            // Set initial cart count to 0
            updateCartCount(0);
        });
    </script>
    @yield('scripts')
</body>
</html>