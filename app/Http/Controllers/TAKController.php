<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TAKSubmission;

class TAKController extends Controller
{

    public function updateTakStatus($id, Request $request)
    {
        $takSubmission = TAKSubmission::findOrFail($id);
        $takSubmission->approval_status_id = $request->approval_status_id;
        $takSubmission->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Status updated to ' . $request->approval_status_id,
            'status_id' => $takSubmission->approval_status_id
        ]);
    }
    public function updatePoint($id, Request $request)
    {
        $takSubmission = TAKSubmission::findOrFail($id);
        $takSubmission->point = $request->point;
        $takSubmission->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Point updated successfully',
            'point' => $takSubmission->point
        ]);
    }
    public function store(Request $request)
    {
        if ($request->hasFile('activity_files')) {
            $file = $request->file('activity_files');
            $path = $file->store('tak_files', 'public'); // Store in public/tak_files
            $request->merge(['file_path' => $path]);
        } else {
            $request->merge(['file_path' => null]);
        }

        $request->validate([
            'mahasiswa_id' => 'required|exists:users,id',
            'activity_names' => 'required|string|max:255',
            'categories' => 'required|string|max:255|in:Lomba,Organisasi,Seminar',
            'levels' => 'required|string|max:255|in:Nasional,Internasional,Regional',
            'activity_dates' => 'required|date',
            'activity_files' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $takSubmission = new TAKSubmission();
        $takSubmission->user_id = $request->mahasiswa_id;
        $takSubmission->activity_name = $request->activity_names;
        $takSubmission->category = $request->categories;
        $takSubmission->level = $request->levels;
        $takSubmission->activity_date = $request->activity_dates;
        $takSubmission->approval_status_id = 1;
        $takSubmission->file_path = $request->file_path;
        $takSubmission->point = 0;
        $takSubmission->save();

        if (!$takSubmission) {
            return redirect()->back()->with('error', 'Failed to create TAK submission.');
        } else {
            return redirect()->route('mahasiswa.dashboard')->with('success', 'TAK submission created successfully.');
        }
    }
    public function edit(Request $request, $id)
    {
        $takSubmission = TAKSubmission::findOrFail($id);

        if ($request->hasFile('activity_files')) {
            $file = $request->file('activity_files');
            $path = $file->store('tak_files', 'public');
            $request->merge(['file_path' => $path]);
        } else {
            $request->merge(['file_path' => null]);
        }
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx', // Adjust file validation as needed
        ]);

        $takSubmission->update([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'location' => $request->location,
            'file_path' => $request->file_path,
        ]);
        if (!$takSubmission) {
            return redirect()->back()->with('error', 'Failed to update TAK submission.');
        }
        return redirect()->route('mahasiswa.tak')->with('success', 'TAK submission updated successfully.');
    }
    public function destroy($id)
    {
        $takSubmission = TAKSubmission::findOrFail($id);
        $takSubmission->delete();

        return redirect()->route('mahasiswa.tak')->with('success', 'TAK submission deleted successfully.');
    }
}
