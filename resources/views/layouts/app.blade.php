<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('meta_description')">
    <meta name="keywords" content="@yield('meta_keyword')">
    <meta name="author" content="@yield('title')">
    <meta property="og:image" content="@yield('image')">
    <link rel="stylesheet" href="{{ asset('assets/vendor/boxicon/css/boxicons.min.css') }}">
    <link href="{{ asset('assets/vendor/icons/tabler-icon/tabler-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/offcanvas/offcanvas-navbar.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    {{-- External CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">


</head>

<body class="d-flex flex-column min-vh-100">
    <div id="app">
        @include('layouts.inc.frontend.navbar')

        <main>
            @yield('content')
        </main>
    </div>
    @include('layouts.inc.frontend.footer')

</body>

<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/offcanvas/offcanvas-navbar.js') }}"></script>
<script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
<link href="{{ asset('admin/vendor/summernote/summernote-lite.min.css') }}" rel="stylesheet">
<script src="{{ asset('admin/vendor/summernote/summernote-lite.min.js') }}"></script>

{{-- External JS --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.js"></script>




<script type="text/javascript">
    $("img").lazyload({
        effect: "fadeIn"
    });
</script>


@yield('scripts')

</html>
