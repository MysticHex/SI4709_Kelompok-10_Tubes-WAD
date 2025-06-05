<?php

namespace App\Http\Controllers;

use App\Models\TAKSubmission;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index()
    {
        // Logika untuk menampilkan dashboard admin
        $tak=TAKSubmission::orderBy("created_at","desc")->get();
        return view('admin.dashboard',compact('tak'));
    }

}
