<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Tambahkan CSS atau library seperti Bootstrap atau Tailwind -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: white;
            color: black;
            font-family: 'Poppins', sans-serif;
        }

        .display-1 {
            font-size: 3.5rem;
            /* Ukuran lebih besar untuk Cipta Indonesia ERP System */
            font-weight: bold;
            margin-bottom: 2rem;
            /* Jarak ke elemen berikutnya */
        }

        .display-2 {
            font-size: 2.5rem;
            /* Ukuran lebih besar untuk Easier Travel Solution */
            font-weight: bold;
            margin-bottom: 2rem;
            /* Jarak ke Hi, Welcome! */
        }

        .text-muted {
            font-size: 1.5rem;
            /* Ukuran lebih kecil untuk Hi, Welcome! */
            margin-bottom: 3rem;
            /* Jarak ke tombol */
        }

        .btn {
            border-radius: 8px;
            /* Membulatkan tombol */
        }

        .btn-lg {
            font-size: 1.2rem;
            /* Ukuran tulisan di tombol */
        }
    </style>
</head>

<body>
    <div class="container my-4">
        <!-- Flash Messages -->
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <!-- Konten Halaman -->
        @yield('content')
    </div>

    <!-- Tambahkan JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>