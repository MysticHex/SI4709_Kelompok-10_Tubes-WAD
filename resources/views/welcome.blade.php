<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <!-- Tailwind CSS (DaisyUI requires Tailwind) -->
        @vite('resources/css/app.css')
        <style>
            body {
                font-family: 'Nunito', sans-serif;
                background: #f7fafc;
            }
            .logo {
                width: 80px;
                height: auto;
            }
        </style>
    </head>
    <body class="min-h-screen flex flex-col">
        <nav class="navbar bg-base-100 shadow-sm">
            <div class="container mx-auto flex justify-between items-center w-full">
                <a class="navbar-brand flex items-center gap-2" href="#">
                    <img src="https://laravel.com/img/logomark.min.svg" alt="Laravel" class="logo">
                    <span class="font-bold text-lg">Laravel</span>
                </a>
                <div class="flex-none">
                    <ul class="menu menu-horizontal px-1">
                        <li><a href="#">Beranda</a></li>
                        <li><a href="#">Tentang</a></li>
                        <li><a href="#">Kontak</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="flex-grow flex items-center justify-center">
            <div class="container mx-auto">
                <div class="flex flex-col items-center text-center">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">Selamat Datang di Aplikasi Laravel</h1>
                    <p class="text-lg mb-5">Aplikasi web ini dibuat menggunakan framework Laravel. Mulai kembangkan aplikasi Anda sekarang!</p>
                    <div class="flex gap-4 justify-center">
                        <a href="#" class="btn btn-primary btn-lg">Mulai</a>
                        <a href="https://laravel.com/docs" class="btn btn-outline btn-lg">Dokumentasi</a>
                    </div>
                </div>
            </div>
        </div>

        <footer class="bg-base-100 py-4 border-t mt-auto">
            <div class="container mx-auto text-center">
                <p>© {{ date('Y') }} Aplikasi Laravel. Hak Cipta Dilindungi.</p>
            </div>
        </footer>
    </body>
</html>
