<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Catalogize') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="{{ asset('fonts/css2.css') }}">

{{--        <link--}}
{{--            href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"--}}
{{--            rel="stylesheet" />--}}

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ mix('css/viewer.css') }}">

        <!-- Scripts -->

        <script src="{{ asset('js/aframe.min.js') }}"></script>
        <script src="{{ asset('js/aframe-ar.js') }}"></script>

        <script src="{{ asset('js/threex-arpatternfile.js') }}"></script>

        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>

        <script async src="https://js.stripe.com/v3/pricing-table.js"></script>


        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia

        @env ('local')
            <script src="/js/bundle.js"></script>
        @endenv
    </body>
</html>
