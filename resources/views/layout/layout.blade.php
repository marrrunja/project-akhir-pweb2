<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    @stack('styles')

</head>

<body>
    @include('layout.navbar')
    @yield('body')
    @stack('scripts')
</body>

</html>
