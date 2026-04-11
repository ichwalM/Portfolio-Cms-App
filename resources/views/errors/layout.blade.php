<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">

    <title>
        @hasSection('title')
            @yield('title') | {{ config('app.name', 'Portfolio CMS') }}
        @else
            {{ config('app.name', 'Portfolio CMS') }}
        @endif
    </title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-950 text-slate-100 antialiased selection:bg-cyan-400 selection:text-slate-900" style="font-family: 'Outfit', sans-serif;">
    <div class="relative min-h-screen overflow-hidden">
        <div class="absolute -top-24 -left-16 h-80 w-80 rounded-full bg-cyan-400/20 blur-3xl"></div>
        <div class="absolute top-1/3 -right-20 h-96 w-96 rounded-full bg-orange-400/20 blur-3xl"></div>
        <div class="absolute bottom-0 left-1/3 h-72 w-72 rounded-full bg-emerald-400/10 blur-3xl"></div>

        <main class="relative z-10 flex min-h-screen items-center justify-center px-6 py-16">
            <div class="w-full max-w-2xl rounded-3xl border border-white/10 bg-slate-900/70 p-8 shadow-2xl shadow-black/40 backdrop-blur-xl md:p-10">
                <div class="mb-8 flex items-center justify-between gap-4">
                    <a href="{{ url('/') }}" class="text-sm font-semibold uppercase tracking-[0.2em] text-cyan-300 transition hover:text-cyan-200">
                        {{ config('app.name', 'Portfolio CMS') }}
                    </a>
                    <span class="rounded-full border border-white/15 bg-white/5 px-4 py-1.5 text-xs font-medium text-slate-300">
                        HTTP @yield('code', 'Error')
                    </span>
                </div>

                <p class="mb-2 text-xs font-semibold uppercase tracking-[0.25em] text-slate-400">Something happened</p>
                <h1 class="text-3xl font-bold leading-tight text-white md:text-4xl">
                    @yield('heading', 'Unexpected Error')
                </h1>
                <p class="mt-4 max-w-xl text-base leading-relaxed text-slate-300 md:text-lg">
                    @yield('message', 'An unexpected issue occurred. Please try again in a few moments.')
                </p>

                <div class="mt-8 flex flex-wrap items-center gap-3">
                    <a
                        href="{{ url('/') }}"
                        class="inline-flex items-center rounded-xl bg-cyan-400 px-5 py-3 text-sm font-semibold text-slate-900 transition hover:bg-cyan-300"
                    >
                        Back To Home
                    </a>
                    <button
                        type="button"
                        onclick="window.history.back();"
                        class="inline-flex items-center rounded-xl border border-white/20 bg-white/5 px-5 py-3 text-sm font-semibold text-slate-200 transition hover:bg-white/10"
                    >
                        Go Back
                    </button>
                </div>

                <div class="mt-8 border-t border-white/10 pt-5 text-xs text-slate-400">
                    Error code: @yield('code', 'N/A')
                </div>
            </div>
        </main>
    </div>
</body>
</html>
