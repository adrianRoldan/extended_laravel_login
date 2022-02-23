<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield("title", config('app.name', 'Extended Laravel Login'))</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    @include('includes.styles')

</head>
<body>

    <div class="container-scroller" id="app">

        @include('layouts.navbar')

        <div class="container-fluid page-body-wrapper">

            @include('layouts.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">

                    @yield('content')

                </div>
            </div>
        </div>
    </div>

    @include('includes.scripts')

</body>

</html>
