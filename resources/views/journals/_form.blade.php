@csrf

<div class="space-y-4">
  <div>
    <label class="block text-sm font-medium text-gray-700">Judul</label>
    <input type="text" name="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('title', $journal->title ?? '') }}" required>
    @error('title')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
  </div>

  <div>
    <label class="block text-sm font-medium text-gray-700">Penulis</label>
    <input type="text" name="authors" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('authors', $journal->authors ?? '') }}">
    @error('authors')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
      <label class="block text-sm font-medium text-gray-700">Tahun</label>
      <input type="text" name="year" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('year', $journal->year ?? '') }}">
      @error('year')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-700">Kata Kunci</label>
      <input type="text" name="keywords" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('keywords', $journal->keywords ?? '') }}">
      @error('keywords')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>
  </div>

  <div>
    <label class="block text-sm font-medium text-gray-700">Status</label>
    <select name="status" class="mt-1 block w-48 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
      <option value="draft" {{ old('status', $journal->status ?? '')=='draft' ? 'selected' : '' }}>Draft</option>
      <option value="published" {{ old('status', $journal->status ?? '')=='published' ? 'selected' : '' }}>Published</option>
    </select>
    @error('status')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
  </div>

  <div>
    <label class="block text-sm font-medium text-gray-700">Upload PDF</label>
    <input type="file" name="pdf" class="mt-1 block w-full text-sm text-gray-600">
    @if(!empty($journal->pdf_path))
      <p class="text-sm text-gray-600 mt-2">Existing file: <a href="{{ route('journals.download', $journal) }}" target="_blank" class="text-indigo-600 underline">Lihat PDF</a></p>
    @endif
    @error('pdf')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
  </div>

  <div>
    <button class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded">Submit</button>
  </div>
</div>
