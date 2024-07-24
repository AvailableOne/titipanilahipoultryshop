<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $title }} | Titipan Ilahi Poultry Shop</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('dist/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('dist/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('dist/css/style.css') }}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{ asset('dist/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
</head>

<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">
        @include('partials.spinner')
        @include('pages.admin.layouts.sidebar')
        <!-- Content Start -->
        <div class="content">
            @include('pages.admin.layouts.topbar')
            <div style="min-height: 78vh">
                @yield('container')
            </div>
            @include('pages.admin.layouts.footer')
        </div>
        <!-- Content End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('dist/lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('dist/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('dist/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('dist/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('dist/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('dist/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('dist/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('dist/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dist/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('dist/js/main.js') }}"></script>
    <script src="{{ asset('dist/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('dist/js/demo/chart-bar-demo.js') }}"></script>
    <script src="{{ asset('dist/js/demo/chart-pie-demo.js') }}"></script>
    <script src="{{ asset('dist/js/demo/datatables-demo.js') }}"></script>

    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
</body>

</html>
