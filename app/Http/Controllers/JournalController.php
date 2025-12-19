<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class JournalController extends Controller
{
    public function index(Request $request)
    {
        $query = Journal::query();

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhere('authors', 'like', "%{$q}%")
                    ->orWhere('keywords', 'like', "%{$q}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $journals = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('journals.index', compact('journals', 'request'));
    }

    public function create()
    {
        return view('journals.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'authors' => 'nullable|string|max:255',
            'year' => 'nullable|string|max:10',
            'keywords' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published',
            'pdf' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        if ($request->hasFile('pdf')) {
            $data['pdf_path'] = $request->file('pdf')->store('journals', 'public');
        }
        if (Auth::check()) {
            $data['user_id'] = Auth::id();
        }

        $data['download_count'] = $data['download_count'] ?? 0;

        Journal::create($data);

        return redirect()->route('journals.index')->with('success', 'Jurnal berhasil ditambahkan');
    }

    public function show(Journal $journal)
    {
        try {
            \App\Models\JournalView::create([
                'journal_id' => $journal->id,
                'user_id' => auth()->check() ? auth()->id() : null,
                'ip' => request()->ip(),
            ]);
        } catch (\Exception $e) {
        }

        return view('journals.show', compact('journal'));
    }

    public function download(Journal $journal)
    {
        if (! $journal->pdf_path || ! Storage::disk('public')->exists($journal->pdf_path)) {
            abort(404);
        }

        $journal->increment('download_count');

        $path = Storage::disk('public')->path($journal->pdf_path);
        return Response::download($path, basename($journal->pdf_path));
    }

    public function edit(Journal $journal)
    {
        $this->authorize('update', $journal);
        return view('journals.edit', compact('journal'));
    }

    public function update(Request $request, Journal $journal)
    {
        $this->authorize('update', $journal);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'authors' => 'nullable|string|max:255',
            'year' => 'nullable|string|max:10',
            'keywords' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published',
            'pdf' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        if ($request->hasFile('pdf')) {
            if ($journal->pdf_path) {
                Storage::disk('public')->delete($journal->pdf_path);
            }
            $data['pdf_path'] = $request->file('pdf')->store('journals', 'public');
        }

        $journal->update($data);

        return redirect()->route('journals.index')->with('success', 'Jurnal berhasil diupdate');
    }

    public function destroy(Journal $journal)
    {
        $this->authorize('delete', $journal);

        if ($journal->pdf_path) {
            Storage::disk('public')->delete($journal->pdf_path);
        }
        $journal->delete();
        return redirect()->route('journals.index')->with('success', 'Jurnal berhasil dihapus');
    }
}
