@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-1 bg-white p-6 rounded shadow">
        <h3 class="text-lg font-semibold mb-2">Profile</h3>
        <p class="text-sm text-gray-700"><strong>Nama:</strong> {{ auth()->user()->name }}</p>
        <p class="text-sm text-gray-700"><strong>Email:</strong> {{ auth()->user()->email }}</p>
        <div class="mt-4 border-t pt-4">
            <div class="text-sm text-gray-600">Total publikasi</div>
            <div class="text-2xl font-semibold">{{ $journals->count() }}</div>
            <div class="text-sm text-gray-600 mt-3">Total downloads</div>
            <div class="text-2xl font-semibold">{{ $totalDownloads }}</div>
            <div class="text-sm text-gray-600 mt-3">Total unique viewers</div>
            <div class="text-2xl font-semibold">{{ $totalUnique }}</div>
        </div>
    </div>

    <div class="lg:col-span-2 bg-white p-6 rounded shadow">
        <h3 class="text-lg font-semibold mb-4">Published Journals</h3>
        @if($journals->isEmpty())
            <div class="text-sm text-gray-600">Belum ada jurnal publik.</div>
        @else
            <div class="space-y-4">
                @foreach($journals as $j)
                    <div class="p-4 border rounded hover:shadow">
                        <div class="flex justify-between items-start">
                            <div>
                                <a href="{{ route('journals.show', $j) }}" class="text-indigo-600 font-semibold">{{ $j->title }}</a>
                                <div class="text-sm text-gray-600 mt-1">{{ \Illuminate\Support\Str::limit($j->keywords, 120) }}</div>
                            </div>
                            <div class="text-right text-sm text-gray-600">
                                <div>Downloads: <strong>{{ $j->download_count ?? 0 }}</strong></div>
                                <div>Unique: <strong>{{ $perJournalUnique[$j->id] ?? 0 }}</strong></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                <h6 class="font-semibold mb-2">Grafik: Unique viewers per journal</h6>
                <canvas id="viewChart" height="140"></canvas>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    (function(){
        const labels = {!! json_encode($chartLabels ?? []) !!};
        const data = {!! json_encode($chartData ?? []) !!};
        const ctx = document.getElementById('viewChart');
        if (!ctx) return;
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Unique Viewers',
                    data: data,
                    backgroundColor: labels.map(() => 'rgba(59,130,246,0.8)'),
                    borderRadius: 4,
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true, precision:0 } }
            }
        });
    })();
</script>
@endpush
