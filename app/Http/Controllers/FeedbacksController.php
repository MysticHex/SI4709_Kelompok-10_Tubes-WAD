<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbacksController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::all()->where('user_id', auth()->id());
        return view('mahasiswa.feedback.index', compact('feedbacks'));
    }

    public function create()
    {
        return view('mahasiswa.feedback.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'type' => 'required|in:saran,kritik',
            'name' => 'nullable|string|max:255',
        ]);
        Feedback::create([
            'user_id' => auth()->id(),
            'type' => $request->type,
            'title' => $request->title,
            'message' => $request->message,
        ]);
        return redirect()->route('feedbacks.create')->with('success', 'Terima kasih atas masukan Anda!');
    }

    public function destroy(Feedback $feedback)
    {
        $feedback->delete();
        return redirect()->route('feedbacks.index')->with('success', 'Feedback berhasil dihapus.');
    }
    
    public function edit($id)
    {
        $feedback = Feedback::findOrFail($id);
        return view('mahasiswa.feedback.edit', compact('feedback'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
        $feedback = Feedback::findOrFail($id);
        $feedback->update([
            'title' => $request->title,
            'message' => $request->message,
        ]);
        return redirect()->route('mahasiswa.feedback')->with('success', 'Feedback berhasil diupdate.');
    }
}
