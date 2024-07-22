<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Catalogize Viewer') }}</title>


{{--    <link rel="stylesheet" href="{{ asset('assets/theme_1/css/style.css') }}">--}}

    {{--        <link--}}
    {{--            href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"--}}
    {{--            rel="stylesheet" />--}}

    <!-- Styles -->


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">

    @routes
    <script src="{{ mix('js/app.js') }}" defer></script>

    @inertiaHead
</head>
<body class="font-sans antialiased">
@inertia

@env ('local')
    <script src="/js/bundle.js"></script>
@endenv
</body>
</html>
