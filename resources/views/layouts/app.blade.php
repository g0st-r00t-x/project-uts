<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Product Management')</title>
    <!-- Link CSS (misalnya Bootstrap, atau custom CSS) -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles') <!-- Untuk menambahkan CSS tambahan jika dibutuhkan -->
</head>
<body>
    <!-- Navbar atau Header -->
    <nav>
        <ul>
            <li><a href="{{ route('products.index') }}">Produk</a></li>
            <li><a href="{{ route('products.create') }}">Tambah Produk</a></li>
            <!-- Tambahkan menu lain jika perlu -->
        </ul>
    </nav>

    <!-- Konten utama -->
    <div class="container">
        @yield('content') <!-- Halaman utama akan disuntikkan di sini -->
    </div>

    <!-- Footer (jika diperlukan) -->
    <footer>
        <p>&copy; 2024 Product Management System</p>
    </footer>

    <!-- Link JS (misalnya Bootstrap atau custom JS) -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts') <!-- Untuk menambahkan JavaScript tambahan jika dibutuhkan -->
</body>
</html>
