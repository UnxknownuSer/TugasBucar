@extends('layouts.app')

@section('content')
  <div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-semibold">Tambah Jurnal</h2>
    <a href="{{ route('journals.index') }}" class="px-3 py-2 bg-gray-200 rounded">Kembali</a>
  </div>

  <div class="bg-white p-6 rounded shadow">
    <form action="{{ route('journals.store') }}" method="post" enctype="multipart/form-data">
      @include('journals._form')
    </form>
  </div>
@endsection
