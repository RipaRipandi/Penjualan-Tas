<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Penjualan Tas</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Tailwind WAJIB di head -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />

    <!-- Hapus bootstrap.min.css dan style.css lama karena bentrok sama Tailwind -->
</head>

<body class="bg-gray-50">

    @include('layouts.navbar')

    @yield('content')

    @include('layouts.footer')

    <!-- JS Bootstrap tetap boleh ada untuk komponen JS (modal, dll) -->
    <script src="{{ asset('user/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>