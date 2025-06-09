<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta')
    <title>@yield('title')</title>
    @stack('styles')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    @include('layout.header')
    @yield('body')
    @include('layout.footer')
    @stack('scripts')
    <!-- SweetAlert2 CDN -->
</body>

</html>
