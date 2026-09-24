<?php

namespace App\Http\Controllers;

use App\Imports\StudentImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StudentImportController extends Controller
{
    public function create()
    {
        return view('students.import');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        Excel::import(
            new StudentImport,
            $request->file('file')
        );

        return redirect()
            ->route('students.index')
            ->with('success', 'Data siswa dan tagihan berhasil diimport.');
    }
}