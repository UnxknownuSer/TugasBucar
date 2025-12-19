@extends('layouts.app')

@section('content')
  <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
    <h2 class="text-2xl font-semibold">Daftar Jurnal</h2>
      <div class="flex items-center gap-3">
      <a href="{{ route('journals.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm rounded">Tambah Jurnal</a>
      <a href="{{ route('journals.index', [], false) }}" class="inline-flex items-center px-3 py-2 bg-gray-100 text-sm rounded">Refresh</a>
    </div>
  </div>

  <div class="mb-4 grid grid-cols-1 md:grid-cols-3 gap-3">
    <form method="get" class="md:col-span-2 flex gap-3">
      <input type="text" name="q" class="flex-1 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-3 py-2" placeholder="Cari judul/penulis/kata kunci" value="{{ request('q') }}">
      <select name="status" class="rounded-md border-gray-300 shadow-sm px-3 py-2">
        <option value="">Semua status</option>
        <option value="draft" {{ request('status')=='draft' ? 'selected' : '' }}>Draft</option>
        <option value="published" {{ request('status')=='published' ? 'selected' : '' }}>Published</option>
      </select>
      <button class="px-4 py-2 bg-indigo-600 text-white rounded">Filter</button>
    </form>
    <div class="p-3 bg-white rounded shadow-md">
      <div class="text-sm text-gray-600">Total jurnal</div>
      <div class="text-2xl font-semibold">{{ $journals->total() }}</div>
    </div>
  </div>

  <div class="overflow-x-auto bg-white shadow sm:rounded-lg">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
          <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
          <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Penulis</th>
          <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
          <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tahun</th>
          <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        @forelse($journals as $j)
          <tr class="hover:bg-gray-50">
            <td class="px-4 py-3 text-sm text-gray-700">{{ $j->id }}</td>
            <td class="px-4 py-3 text-sm text-indigo-600"><a href="{{ route('journals.show', $j) }}" class="hover:underline">{{ $j->title }}</a>
              <div class="text-xs text-gray-500 mt-1">{{ \Illuminate\Support\Str::limit($j->keywords, 80) }}</div>
            </td>
            <td class="px-4 py-3 text-sm text-gray-700">{{ $j->authors }}</td>
            <td class="px-4 py-3 text-sm">
              @if($j->status=='published')
                <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs">Published</span>
              @else
                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-xs">Draft</span>
              @endif
            </td>
            <td class="px-4 py-3 text-sm text-gray-700">{{ $j->year }}</td>
            <td class="px-4 py-3 text-sm text-gray-700 space-x-2">
              @if(auth()->check() && auth()->id() === $j->user_id)
                <a href="{{ route('journals.edit', $j) }}" class="px-3 py-1 bg-yellow-400 text-white rounded text-xs">Edit</a>
                <form action="{{ route('journals.destroy', $j) }}" method="post" style="display:inline" onsubmit="return confirm('Hapus jurnal ini?')">
                  @csrf
                  @method('DELETE')
                  <button class="px-3 py-1 bg-red-600 text-white rounded text-xs">Hapus</button>
                </form>
              @endif
            </td>
          </tr>
        @empty
          <tr><td class="px-4 py-8 text-center" colspan="6">Belum ada jurnal.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-4">
    {{ $journals->links() }}
  </div>
@endsection
