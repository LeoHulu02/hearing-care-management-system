@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-xl rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
        <h1 class="mb-6 text-2xl font-semibold text-slate-900">Customer Login</h1>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="mb-1 block text-sm font-medium text-slate-700">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" class="w-full rounded-md border border-slate-300 px-3 py-2 focus:border-teal-600 focus:outline-none" required>
                @error('email') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="password" class="mb-1 block text-sm font-medium text-slate-700">Password</label>
                <input id="password" name="password" type="password" class="w-full rounded-md border border-slate-300 px-3 py-2 focus:border-teal-600 focus:outline-none" required>
                @error('password') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>

            <label class="flex items-center gap-2 text-sm text-slate-700">
                <input type="checkbox" name="remember" value="1" class="rounded border-slate-300 text-teal-600 focus:ring-teal-500">
                Remember me
            </label>

            <button type="submit" class="w-full rounded-md bg-teal-600 px-4 py-2 font-medium text-white hover:bg-teal-700">
                Login
            </button>
        </form>
    </div>
@endsection
