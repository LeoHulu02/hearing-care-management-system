<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen">
    <header class="sticky top-0 z-20 border-b border-hc-border bg-white/95 backdrop-blur">
        <div class="mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-3 px-4 py-4">
            <a href="{{ route('home') }}" class="font-semibold text-hc-primary">{{ config('app.name') }}</a>
            <nav class="flex flex-wrap items-center gap-3 text-sm">
                @auth
                    @if (auth()->user()->isCustomer())
                        <a href="{{ route('products.index') }}" class="text-hc-muted transition hover:text-hc-primary">Products</a>
                        <a href="{{ route('orders.index') }}" class="text-hc-muted transition hover:text-hc-primary">Orders</a>
                    @endif
                    <a href="{{ route('profile.edit') }}" class="text-hc-muted transition hover:text-hc-primary">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="rounded-md bg-hc-primary px-3 py-1.5 font-medium text-white transition hover:brightness-95">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-hc-muted transition hover:text-hc-primary">Login</a>
                    <a href="{{ route('register') }}" class="rounded-md bg-hc-primary px-3 py-1.5 font-medium text-white transition hover:brightness-95">Register</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-4 py-8">
        @if (session('status'))
            <div class="mb-6 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                {{ session('status') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="border-t border-hc-border bg-white">
        <div class="mx-auto max-w-6xl px-4 py-4 text-center text-xs text-hc-muted">
            Hearing Care Order Management System
        </div>
    </footer>
</body>
</html>
