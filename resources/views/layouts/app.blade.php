<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TaskManager') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-slate-950 text-slate-100">
        <div class="min-h-screen relative overflow-hidden">
            <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(99,102,241,0.25),transparent_55%)]"></div>
            <div class="pointer-events-none absolute -top-32 right-10 h-72 w-72 rounded-full bg-fuchsia-500/20 blur-3xl"></div>
            <div class="pointer-events-none absolute bottom-0 left-10 h-72 w-72 rounded-full bg-cyan-500/20 blur-3xl"></div>

            <div class="relative">
            @include('layouts.navigation')  

            <!-- Page Heading -->
            @isset($header)
                <header class="mx-auto mt-6 max-w-6xl rounded-3xl border border-white/20 bg-white/70 shadow-xl shadow-slate-900/10 backdrop-blur">
                    <div class="px-6 py-6">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
           <main class="py-10">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
                @include('components.flash')
                {{ $slot }}

            </div>
        </main>
            </div>
        </div>
    </body>
</html>
