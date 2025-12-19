@extends('layouts.app')

@section('content')
	<div class="hero-bg py-16">
		<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
			<div class="grid grid-cols-1 lg:grid-cols-1 gap-8 items-center">
				<div>
					<h1 class="text-4xl font-extrabold text-gray-900 mb-4">JurnalApp — Platform Manajemen Jurnal</h1>
					<p class="text-lg text-gray-600 mb-6">Selamat datang di JurnaApp tempat mempublikasikan jurnal mu dan
						memanajemen jurnalmu setiap waktu</p>
					<div class="py-10">
						<div class="max-w-4xl mx-auto soft-card rounded p-8">
							<h1 class="text-3xl font-bold mb-2">Selamat datang di JurnalApp</h1>
							<p class="text-gray-700">Kelola, publikasikan, dan pantau statistik jurnal Anda dengan mudah.</p>
							<div class="mt-6 flex gap-3 flex-col sm:flex-row">
								<form method="get" action="{{ route('journals.index') }}" class="w-full sm:flex gap-2">
									<input name="q" value="{{ request('q') }}" placeholder="Cari judul/penulis/kata kunci" class="w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-3 py-2" />
									<select name="status" class="mt-2 sm:mt-0 rounded-md border-gray-300 shadow-sm px-3 py-2">
										<option value="">Semua status</option>
										<option value="draft" {{ request('status')=='draft' ? 'selected' : '' }}>Draft</option>
										<option value="published" {{ request('status')=='published' ? 'selected' : '' }}>Published</option>
									</select>
									<button type="submit" class="mt-2 sm:mt-0 sm:ml-2 px-4 py-2 bg-indigo-600 text-white rounded">Cari</button>
								</form>
								<div class="flex gap-3">
									@if(auth()->check())
										<a href="{{ route('journals.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded">Unggah Jurnal</a>
									@else
										<a href="{{ route('login') }}" class="px-4 py-2 bg-indigo-600 text-white rounded">Unggah Jurnal</a>
									@endif
									<a href="{{ route('journals.index') }}" class="px-4 py-2 border border-indigo-600 text-indigo-600 rounded">Telusuri Jurnal</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="bg-white">
		<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
			<h3 class="text-xl font-semibold mb-4"></h3>
			<div class="bg-white p-6 rounded-lg shadow">
				<h2 class="text-lg font-semibold mb-4">Jurnal Terbaru</h2>

				@if(isset($journals) && $journals->count())
					<div class="space-y-4">
						@foreach($journals as $journal)
							<article class="flex items-start justify-between">
								<div>
									<a href="{{ route('journals.show', $journal) }}"
										class="text-sm font-semibold text-indigo-700">{{ \Illuminate\Support\Str::limit($journal->title, 80) }}</a>
									<div class="text-xs text-gray-500">{{ $journal->authors }} • {{ $journal->year }}</div>
								</div>
								<div class="text-right">
									<a href="{{ route('journals.show', $journal) }}"
										class="text-xs text-indigo-600 underline">Lihat</a>
								</div>
							</article>
						@endforeach
					</div>
                		@else
                        <p class="text-sm text-gray-500">Belum ada jurnal. @if(auth()->check()) <a href="{{ route('journals.create') }}" class="text-indigo-600 underline">Tambahkan sekarang</a> @else <a href="{{ route('login') }}" class="text-indigo-600 underline">Tambahkan sekarang</a> @endif.</p>
				@endif
			</div>
		</div>
	</div>

@endsection