@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-xl">
        <div class="mb-6 text-center">
            <div class="hc-section-kicker mb-3">Akun Pelanggan</div>
            <h1 class="hc-page-title" style="font-family: var(--font-display)">Buat Akun Baru</h1>
            <p class="hc-page-subtitle">Mulai pesan dan pantau produk alat bantu dengar Anda.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="hc-card-elevated space-y-4 p-6 sm:p-8">
            @csrf

            <div>
                <label for="name" class="hc-label">Nama Lengkap</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" class="hc-input" placeholder="Nama lengkap Anda" autocomplete="name" required>
                @error('name')
                    <p class="mt-1.5 flex items-center gap-1.5 text-sm text-rose-600">
                        <svg class="h-4 w-4 shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

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
                <label for="phone" class="hc-label">Nomor HP <span class="font-normal text-hc-muted">(opsional)</span></label>
                <input id="phone" name="phone" type="tel" value="{{ old('phone') }}" class="hc-input" placeholder="08xx-xxxx-xxxx" autocomplete="tel">
                @error('phone')
                    <p class="mt-1.5 flex items-center gap-1.5 text-sm text-rose-600">
                        <svg class="h-4 w-4 shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label for="password" class="hc-label">Password</label>
                <input id="password" name="password" type="password" class="hc-input" placeholder="Min. 8 karakter" autocomplete="new-password" required>
                @error('password')
                    <p class="mt-1.5 flex items-center gap-1.5 text-sm text-rose-600">
                        <svg class="h-4 w-4 shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="hc-label">Konfirmasi Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" class="hc-input" placeholder="Ulangi password Anda" autocomplete="new-password" required>
            </div>

            <button type="submit" class="hc-button-primary w-full text-sm">
                Daftar Sekarang
            </button>

            <p class="text-center text-sm text-hc-muted">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="hc-link">Masuk di sini</a>
            </p>
        </form>
    </div>
@endsection
