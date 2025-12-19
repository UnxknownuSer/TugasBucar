@extends('layouts.app')

@section('content')
  <div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-semibold">Detail Jurnal</h2>
    <div class="flex gap-2">
      <a href="{{ route('journals.index') }}" class="px-3 py-2 bg-gray-200 rounded">Kembali</a>
      @if(auth()->check() && auth()->id() === $journal->user_id)
        <a href="{{ route('journals.edit', $journal) }}" class="px-3 py-2 bg-yellow-400 rounded text-white">Edit</a>
      @endif
    </div>
  </div>

  <div class="bg-white p-6 rounded shadow">
    <h3 class="text-xl font-semibold mb-2">{{ $journal->title }}</h3>
    <dl class="grid grid-cols-1 gap-2 text-sm text-gray-700">
      <div><span class="font-medium">Penulis:</span> {{ $journal->authors }}</div>
      <div><span class="font-medium">Tahun:</span> {{ $journal->year }}</div>
      <div><span class="font-medium">Status:</span> {{ ucfirst($journal->status) }}</div>
      <div><span class="font-medium">Kata Kunci:</span> {{ $journal->keywords }}</div>
      @if($journal->pdf_path)
        <div class="mt-2 flex items-center gap-3"><span class="font-medium">File PDF:</span>
          <a href="{{ route('journals.download', $journal) }}" target="_blank" class="px-3 py-2 bg-indigo-600 text-white rounded text-sm">Download / Lihat</a>
          <span class="text-sm text-gray-600">Downloads: <strong>{{ $journal->download_count ?? 0 }}</strong></span>
          <span class="text-sm text-gray-600">Unique viewers: <strong>{{ $journal->views()->count() }}</strong></span>
        </div>
      @endif
    </dl>
  </div>
@endsection
