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
        ]);
        Feedback::create([
            'user_id' => auth()->id(),
            'type' => $request->type,
            'message' => $request->message,
        ]);
        return redirect()->route('mahasiswa.feedback')->with('success', 'Terima kasih atas masukan Anda!');
    }

    public function destroy(Feedback $feedback)
    {
        $feedback->delete();
        return redirect()->route('mahasiswa.feedback')->with('success', 'Feedback berhasil dihapus.');
    }
    
    public function edit($id)
    {
        $feedback = Feedback::findOrFail($id);
        return view('mahasiswa.feedback.edit', compact('feedback'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string',
            'type' => 'required|in:saran,kritik',
        ]);
        $feedback = Feedback::findOrFail($id);
        $feedback->update([
            'message' => $request->message,
            'type' => $request->type,
        ]);
        return redirect()->route('mahasiswa.feedback')->with('success', 'Feedback berhasil diupdate.');
    }
}
