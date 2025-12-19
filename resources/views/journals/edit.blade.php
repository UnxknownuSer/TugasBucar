@extends('layouts.app')

@section('content')
  <div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-semibold">Edit Jurnal</h2>
    <a href="{{ route('journals.index') }}" class="px-3 py-2 bg-gray-200 rounded">Kembali</a>
  </div>

  <div class="bg-white p-6 rounded shadow">
    <form action="{{ route('journals.update', $journal) }}" method="post" enctype="multipart/form-data">
      @method('PUT')
      @include('journals._form')
    </form>
  </div>
@endsection
