<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\JournalController;
use App\Models\Journal;

Route::get('/', function () {
    $published = \App\Models\Journal::where('status', 'published')
        ->orderBy('created_at', 'desc')
        ->take(10)
        ->get();

    if (auth()->check()) {
        $own = auth()->user()->journals()->orderBy('created_at', 'desc')->take(10)->get();
        $journals = $own->merge($published)->unique('id')->sortByDesc('created_at')->values()->take(10);
    } else {
        $journals = $published;
    }

    return view('welcome', compact('journals'));
});

Route::get('/home', function () {
    return redirect('/journals');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::post('/logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
})->name('logout');

Route::get('/profile', function () {
    $user = auth()->user();
    $journals = $user ? $user->journals()->where('status', 'published')->get() : collect();
    $totalDownloads = $journals->sum('download_count');

    $journalIds = $journals->pluck('id')->all();
    $views = \DB::table('journal_views')->whereIn('journal_id', $journalIds)->get();


    $perJournalUnique = [];
    foreach ($journals as $j) {
        $pv = $views->where('journal_id', $j->id)->map(function ($v) {
            return $v->user_id ? 'u:'.$v->user_id : 'ip:'.$v->ip;
        })->unique();
        $perJournalUnique[$j->id] = $pv->count();
    }


    $totalUnique = $views->map(function ($v) {
        return $v->user_id ? 'u:'.$v->user_id : 'ip:'.$v->ip;
    })->unique()->count();

  
    $chartLabels = $journals->pluck('title')->map(fn($t) => 
        strlen($t) > 40 ? substr($t, 0, 37).'...' : $t
    )->all();
    $chartData = array_map(function ($j) use ($perJournalUnique) {
        return $perJournalUnique[$j->id] ?? 0;
    }, $journals->all());

    return view('profile', compact('journals', 'totalDownloads', 'perJournalUnique', 'totalUnique', 'chartLabels', 'chartData'));
})->middleware('auth')->name('profile');


Route::get('/journals/{journal}/download', [\App\Http\Controllers\JournalController::class, 'download'])->name('journals.download');

Route::resource('journals', JournalController::class)->only(['index', 'show']);


Route::middleware('auth')->group(function () {
    Route::resource('journals', JournalController::class)->except(['index', 'show']);
});
