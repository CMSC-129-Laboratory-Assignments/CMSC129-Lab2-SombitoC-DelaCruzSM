<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    // Display dashboard
    public function index()
    {
        $journals = Journal::where('user_id', Auth::id())->latest()->get();
        $totalJournals = $journals->count();

        return view('layouts/dashboard', [
            'journals' => $journals,
            'totalJournals' => $totalJournals,
            'filteredJournals' => $journals,
            'isLoading' => false
        ]);
    }

    // Show create page
    public function create()
    {
        return view('journals/create');
    }

    // Store new journal
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Journal::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Journal created!');
    }

    // Update journal
    public function update(Request $request, $id)
    {
        $journal = Journal::findOrFail($id);

        $this->authorizeJournal($journal);

        $journal->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('dashboard')->with('success', 'Journal updated!');
    }

    // Delete journal
    public function destroy($id)
    {
        $journal = Journal::findOrFail($id);

        $this->authorizeJournal($journal);

        $journal->delete();

        return redirect()->route('dashboard')->with('success', 'Journal deleted!');
    }

    // Optional: security check
    private function authorizeJournal($journal)
    {
        if ($journal->user_id !== Auth::id()) {
            abort(403);
        }
    }
}
