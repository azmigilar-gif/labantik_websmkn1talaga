<!DOCTYPE html>
<html lang="en" class="group overflow-x-hidden scroll-smooth" data-mode="light" dir="ltr">

<head>

    <meta charset="utf-8">
    <title>@yield('title', 'SMKN 1 Talaga Web')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta content="SMKN 1 Talaga Web" name="description">
    <meta content="ICT SMKN 1 Talaga" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link href="{{ asset('../../css2?family=Tourney:wght@100&display=swap') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('../../aos%403.0.0-beta.6/dist/aos.css') }}">

    <!-- Swiper Slider css-->

    <!-- Layout config Js -->
    <script src="{{ asset('assets/js/layout.js') }}"></script>
    <!-- Icons CSS -->

    <!-- StarCode CSS -->

    <link rel="stylesheet" href="{{ asset('assets/css/starcode2.css') }}">
</head>

<body>
    @include('partials.navbar')

    @yield('content')

    @include('partials.footer')

    <script src='{{ asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}'></script>
    <script src="{{ asset('assets/libs/%40popperjs/core/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/libs/tippy.js/tippy-bundle.umd.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/prismjs/prism.js') }}"></script>
    <script src="{{ asset('assets/libs/lucide/umd/lucide.js') }}"></script>
    <script src="{{ asset('assets/js/starcode.bundle.js') }}"></script>
    <script src="{{ asset('assets/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/aos/aos.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script src="{{ asset('assets/js/pages/landing-product.init.js') }}"></script>
    <!-- Page-specific scripts pushed from views -->
    @stack('scripts')
</body>

</html>
