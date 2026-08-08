@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-xl">
        <div class="mb-6 text-center">
            <div class="hc-section-kicker mb-3">Akses Pelanggan</div>
            <h1 class="hc-page-title" style="font-family: var(--font-display)">Masuk ke Akun Anda</h1>
            <p class="hc-page-subtitle">Akses katalog produk dan riwayat pesanan Anda.</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="hc-card-elevated space-y-4 p-6 sm:p-8">
            @csrf

            <div>
                <label for="email" class="hc-label">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" class="hc-input" placeholder="contoh@email.com" autocomplete="email" required>
                @error('email')
                    <p class="mt-1.5 flex items-center gap-1.5 text-sm text-rose-600">
                        <svg class="h-4 w-4 shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label for="password" class="hc-label">Password</label>
                <input id="password" name="password" type="password" class="hc-input" placeholder="••••••••" autocomplete="current-password" required>
                @error('password')
                    <p class="mt-1.5 flex items-center gap-1.5 text-sm text-rose-600">
                        <svg class="h-4 w-4 shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <label class="flex items-center gap-2 text-sm text-slate-700">
                <input type="checkbox" name="remember" value="1" class="rounded border-slate-300 text-teal-600 focus:ring-teal-500">
                Ingat saya
            </label>

            <button type="submit" class="hc-button-primary w-full text-sm">
                Masuk
            </button>

            <p class="text-center text-sm text-hc-muted">
                Belum punya akun?
                <a href="{{ route('register') }}" class="hc-link">Daftar sekarang</a>
            </p>
        </form>
    </div>
@endsection
