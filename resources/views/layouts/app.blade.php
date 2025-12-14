<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- HTMX --}}
    <script src="https://cdn.jsdelivr.net/npm/htmx.org@2.0.7/dist/htmx.min.js"
        integrity="sha384-ZBXiYtYQ6hJ2Y0ZNoYuI+Nq5MqWBr+chMrS/RkXpNzQCApHEhOt2aY8EJgqwHLkJ" crossorigin="anonymous">
    </script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body id="app" class="font-{arial} bg-gray-50 h-screen flex flex-col">

    @include('reusable_partials.top_navbar')
    <div class="flex flex-1 overflow-hidden">

        @include('reusable_partials.nav_sidebar')


        <!-- Page Content -->
        <main class="flex-1 p-6 overflow-y-auto">
            {{ $slot }}
        </main>

         @include('reusable_partials.right-nav-sidebar')

        @include('reusable_partials.flash-messages')
    </div>
</body>

</html>
