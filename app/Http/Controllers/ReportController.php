<?php

namespace App\Http\Controllers;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function student()
    {
        return view('reports.student');
    }

    public function monthly()
    {
        return view('reports.monthly');
    }

    public function yearly()
    {
        return view('reports.yearly');
    }
}