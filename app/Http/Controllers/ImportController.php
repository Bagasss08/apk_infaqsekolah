<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function index()
    {
        return view('students.import');
    }

    public function store(Request $request)
    {

    }

    public function history()
    {
        return view('imports.history');
    }
}