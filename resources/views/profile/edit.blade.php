@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-2xl rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
        <h1 class="mb-6 text-2xl font-semibold text-slate-900">My Profile</h1>

        <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="mb-1 block text-sm font-medium text-slate-700">Name</label>
                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" class="w-full rounded-md border border-slate-300 px-3 py-2 focus:border-teal-600 focus:outline-none" required>
                @error('name') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="email" class="mb-1 block text-sm font-medium text-slate-700">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" class="w-full rounded-md border border-slate-300 px-3 py-2 focus:border-teal-600 focus:outline-none" required>
                @error('email') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="phone" class="mb-1 block text-sm font-medium text-slate-700">Phone</label>
                <input id="phone" name="phone" type="text" value="{{ old('phone', $user->phone) }}" class="w-full rounded-md border border-slate-300 px-3 py-2 focus:border-teal-600 focus:outline-none">
                @error('phone') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>

            <div class="rounded-md border border-slate-200 bg-slate-50 p-4">
                <p class="mb-3 text-sm font-medium text-slate-700">Change password (optional)</p>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label for="password" class="mb-1 block text-sm font-medium text-slate-700">New Password</label>
                        <input id="password" name="password" type="password" class="w-full rounded-md border border-slate-300 px-3 py-2 focus:border-teal-600 focus:outline-none">
                        @error('password') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="mb-1 block text-sm font-medium text-slate-700">Confirm New Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" class="w-full rounded-md border border-slate-300 px-3 py-2 focus:border-teal-600 focus:outline-none">
                    </div>
                </div>
            </div>

            <button type="submit" class="rounded-md bg-teal-600 px-4 py-2 font-medium text-white hover:bg-teal-700">
                Save Profile
            </button>
        </form>
    </div>
@endsection
