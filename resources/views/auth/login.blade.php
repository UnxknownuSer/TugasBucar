@extends('layouts.app', ['title' => 'Login'])

@section('content')

<div class="min-h-[70vh] flex items-center justify-center">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-6">
            @if (session('status'))
            <div class="mb-4 p-3 rounded bg-green-50 border border-green-200 text-green-800">{{ session('status') }}</div>
            @endif

            <h3 class="text-xl font-semibold mb-4">Masuk ke JurnalApp</h3>

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="alamat@email.com">
                    @error('email')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="********">
                    @error('password')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="flex items-center justify-between">
                    <div class="text-sm"><a href="{{ route('password.request') ?? '#' }}" class="text-indigo-600 hover:underline">Lupa password?</a></div>
                </div>

                <div>
                    <button type="submit" class="w-full inline-flex justify-center py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded">LOGIN</button>
                </div>
            </form>

            <p class="mt-4 text-center text-sm text-gray-600">Belum punya akun? <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Daftar</a></p>
        </div>
    </div>
</div>

@endsection