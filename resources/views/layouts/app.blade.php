<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Dog Marketplace')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-light">

    @include('partials.navbar')

    <div class="container mt-5">
        @yield('content')
    </div>

    @include('partials.footer')

    <!-- Toast Container -->
    <div id="cartToastContainer" class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080;"></div>
    {{-- Global scripts (needed for add-to-cart on listing/show pages) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    

    {{-- Page-specific scripts --}}
    @yield('scripts')
</body>
</html>
