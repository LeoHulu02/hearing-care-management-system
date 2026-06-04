@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-xl rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
        <h1 class="mb-6 text-2xl font-semibold text-slate-900">Create Customer Account</h1>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="mb-1 block text-sm font-medium text-slate-700">Name</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" class="w-full rounded-md border border-slate-300 px-3 py-2 focus:border-teal-600 focus:outline-none" required>
                @error('name') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="email" class="mb-1 block text-sm font-medium text-slate-700">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" class="w-full rounded-md border border-slate-300 px-3 py-2 focus:border-teal-600 focus:outline-none" required>
                @error('email') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="phone" class="mb-1 block text-sm font-medium text-slate-700">Phone</label>
                <input id="phone" name="phone" type="text" value="{{ old('phone') }}" class="w-full rounded-md border border-slate-300 px-3 py-2 focus:border-teal-600 focus:outline-none">
                @error('phone') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="password" class="mb-1 block text-sm font-medium text-slate-700">Password</label>
                <input id="password" name="password" type="password" class="w-full rounded-md border border-slate-300 px-3 py-2 focus:border-teal-600 focus:outline-none" required>
                @error('password') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="password_confirmation" class="mb-1 block text-sm font-medium text-slate-700">Confirm Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" class="w-full rounded-md border border-slate-300 px-3 py-2 focus:border-teal-600 focus:outline-none" required>
            </div>

            <button type="submit" class="w-full rounded-md bg-teal-600 px-4 py-2 font-medium text-white hover:bg-teal-700">
                Register
            </button>
        </form>
    </div>
@endsection
