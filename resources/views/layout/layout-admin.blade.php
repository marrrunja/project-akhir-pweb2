<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta')
    <title>@yield('title')</title>
    @stack('styles')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="module" src="{{ custom_asset('resources/js/utility/alert.js') }}"></script>
</head>
<body id="page-top">
    @yield('body')
    @stack('scripts')
    <script type="module" src="{{ custom_asset('resources/js/logout.js') }}"></script>
</body>
</html>
