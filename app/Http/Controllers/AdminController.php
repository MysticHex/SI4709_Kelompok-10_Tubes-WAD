<?php

namespace App\Http\Controllers;

use App\Models\TAKSubmission;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $tak=TAKSubmission::with('user')->latest()->paginate(10);
        return view('admin.dashboard',compact('tak'));
    }

}
