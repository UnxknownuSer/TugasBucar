@extends('layouts.app', ['title' => 'Register'])

@section('content')

<div class="min-h-[70vh] flex items-center justify-center">
  <div class="w-full max-w-2xl bg-white rounded-lg shadow-md overflow-hidden">
    <div class="px-6 py-6">
      <h3 class="text-xl font-semibold mb-4">Buat Akun Baru</h3>

      <form action="{{ route('register') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @csrf

        <div class="col-span-1 md:col-span-2">
          <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
          <input type="text" name="name" value="{{ old('name') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
          @error('name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Email</label>
          <input type="email" name="email" value="{{ old('email') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
          @error('email')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Password</label>
          <input type="password" name="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
          @error('password')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
          <input type="password" name="password_confirmation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <div class="md:col-span-2">
          <button type="submit" class="w-full inline-flex justify-center py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded">REGISTER</button>
        </div>
      </form>

      <p class="mt-4 text-center text-sm text-gray-600">Sudah punya akun? <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Login</a></p>
    </div>
  </div>
</div>

@endsection
