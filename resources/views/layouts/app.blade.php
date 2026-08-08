<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistem manajemen pesanan alat bantu dengar. Pesan produk, pantau status, dan kelola data pelanggan dengan mudah.">
    <title>{{ config('app.name', 'Hearing Care') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen flex-col @auth @if (auth()->user()->isCustomer()) pb-24 md:pb-0 @endif @endauth">
    <a href="#main-content" class="hc-skip-link">Skip to main content</a>
    <header class="sticky top-0 z-20 border-b border-hc-border/70 bg-white/90 shadow-sm shadow-slate-200/40 backdrop-blur-xl">
        <div class="mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-4 px-4 py-4">
            <a href="{{ route('home') }}" class="group inline-flex items-center gap-3 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2">
                <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-teal-500 to-hc-primary text-sm font-bold text-white shadow-md shadow-teal-900/10 transition group-hover:-translate-y-0.5 group-hover:bg-teal-700">HC</span>
                <span>
                    <span class="block text-sm font-semibold leading-tight text-hc-text">{{ config('app.name', 'Hearing Care') }}</span>
                    <span class="block text-xs text-hc-muted">Manajemen Pesanan</span>
                </span>
            </a>
            @auth
                <nav class="hidden flex-wrap items-center gap-2 text-sm md:flex">
                    @if (auth()->user()->isCustomer())
                        <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'bg-teal-50 text-hc-primary shadow-sm' : 'text-hc-muted' }} hc-nav-link inline-flex items-center gap-2">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M7 8V7a5 5 0 0 1 10 0v1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                <path d="M5.4 8h13.2l-.7 10.2A3 3 0 0 1 14.9 21H9.1a3 3 0 0 1-3-2.8L5.4 8Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                                <path d="M9 12h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                            </svg>
                            Produk
                        </a>
                        <a href="{{ route('orders.index') }}" class="{{ request()->routeIs('orders.*') ? 'bg-teal-50 text-hc-primary shadow-sm' : 'text-hc-muted' }} hc-nav-link inline-flex items-center gap-2">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M9 5h6m-7 4h8m-8 4h5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                <path d="M8.5 3.5h7A2.5 2.5 0 0 1 18 6v13a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V6a2.5 2.5 0 0 1 2.5-2.5Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                            </svg>
                            Pesanan
                        </a>
                    @endif
                    <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.*') ? 'bg-teal-50 text-hc-primary shadow-sm' : 'text-hc-muted' }} hc-nav-link inline-flex items-center gap-2">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke="currentColor" stroke-width="1.8" />
                            <path d="M4.5 20a7.5 7.5 0 0 1 15 0" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                        </svg>
                        Profil
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-slate-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M15 7 20 12m0 0-5 5m5-5H9" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M11 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                            </svg>
                            Keluar
                        </button>
                    </form>
                </nav>
            @else
                <nav class="flex flex-wrap items-center gap-2 text-sm">
                    <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'bg-teal-50 text-hc-primary shadow-sm' : 'text-hc-muted' }} hc-nav-link">Masuk</a>
                    <a href="{{ route('register') }}" class="rounded-full bg-hc-primary px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-hc-primary-dark hover:shadow-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2">Daftar</a>
                </nav>
            @endauth
        </div>
    </header>

    <main id="main-content" class="mx-auto w-full max-w-6xl flex-1 px-4 py-10 sm:py-12">
        @if (session('status'))
            <div class="mb-6 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                {{ session('status') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="mt-6 border-t border-hc-border/80 bg-white/85 backdrop-blur">
        <div class="mx-auto flex max-w-6xl flex-col gap-2 px-4 py-6 text-center text-xs text-hc-muted sm:flex-row sm:items-center sm:justify-between sm:text-left">
            <span>Hearing Care Order Management System</span>
            <span class="font-medium text-slate-500">Sistem manajemen pesanan alat bantu dengar.</span>
        </div>
    </footer>

    @auth
        @if (auth()->user()->isCustomer())
            <nav class="fixed inset-x-3 bottom-3 z-30 rounded-[1.75rem] border border-white/70 bg-white/95 p-2 shadow-2xl shadow-slate-900/15 backdrop-blur-xl md:hidden" aria-label="Customer mobile navigation">
                <div class="grid grid-cols-4 gap-1">
                    <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'bg-teal-50 text-hc-primary shadow-sm ring-1 ring-teal-100' : 'text-hc-muted' }} flex flex-col items-center gap-1 rounded-2xl px-2 py-2.5 text-[11px] font-semibold transition hover:bg-teal-50 hover:text-hc-primary focus:outline-none focus:ring-2 focus:ring-teal-500">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M7 8V7a5 5 0 0 1 10 0v1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                            <path d="M5.4 8h13.2l-.7 10.2A3 3 0 0 1 14.9 21H9.1a3 3 0 0 1-3-2.8L5.4 8Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                            <path d="M9 12h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                        </svg>
                        <span>Produk</span>
                    </a>
                    <a href="{{ route('orders.index') }}" class="{{ request()->routeIs('orders.*') ? 'bg-teal-50 text-hc-primary shadow-sm ring-1 ring-teal-100' : 'text-hc-muted' }} flex flex-col items-center gap-1 rounded-2xl px-2 py-2.5 text-[11px] font-semibold transition hover:bg-teal-50 hover:text-hc-primary focus:outline-none focus:ring-2 focus:ring-teal-500">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M9 5h6m-7 4h8m-8 4h5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                            <path d="M8.5 3.5h7A2.5 2.5 0 0 1 18 6v13a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V6a2.5 2.5 0 0 1 2.5-2.5Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                        </svg>
                        <span>Pesanan</span>
                    </a>
                    <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.*') ? 'bg-teal-50 text-hc-primary shadow-sm ring-1 ring-teal-100' : 'text-hc-muted' }} flex flex-col items-center gap-1 rounded-2xl px-2 py-2.5 text-[11px] font-semibold transition hover:bg-teal-50 hover:text-hc-primary focus:outline-none focus:ring-2 focus:ring-teal-500">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke="currentColor" stroke-width="1.8" />
                            <path d="M4.5 20a7.5 7.5 0 0 1 15 0" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                        </svg>
                        <span>Profil</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex w-full flex-col items-center gap-1 rounded-2xl px-2 py-2.5 text-[11px] font-semibold text-slate-500 transition hover:bg-slate-100 hover:text-slate-900 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M15 7 20 12m0 0-5 5m5-5H9" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M11 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                            </svg>
                                <span>Keluar</span>
                        </button>
                    </form>
                </div>
            </nav>
        @endif
    @endauth
</body>
</html>
