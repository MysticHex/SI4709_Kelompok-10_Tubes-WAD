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
}
