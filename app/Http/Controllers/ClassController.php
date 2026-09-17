<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * Menampilkan daftar kelas
     */
    public function index()
    {
        $classes = SchoolClass::with('academicYear')
            ->orderBy('tingkat')
            ->orderBy('name')
            ->paginate(10);

        return view('classes.index', compact('classes'));
    }

    /**
     * Form tambah kelas
     */
    public function create()
    {
        $academicYears = AcademicYear::orderByDesc('id')->get();

        return view('classes.create', compact('academicYears'));
    }

    /**
     * Simpan data kelas
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'academic_year_id' => 'required|exists:academic_years,id',
            'tingkat'          => 'required|integer|min:1|max:3',
            'name'             => 'required|string|max:100',
            'wali_kelas'       => 'nullable|string|max:100',
        ]);

        SchoolClass::create($validated);

        return redirect()
            ->route('classes.index')
            ->with('success', 'Data kelas berhasil ditambahkan.');
    }

    /**
     * Form edit kelas
     */
    public function edit(string $id)
    {
        $class = SchoolClass::findOrFail($id);

        $academicYears = AcademicYear::orderByDesc('id')->get();

        return view('classes.edit', compact(
            'class',
            'academicYears'
        ));
    }

    /**
     * Update data kelas
     */
    public function update(Request $request, string $id)
    {
        $class = SchoolClass::findOrFail($id);

        $validated = $request->validate([
            'academic_year_id' => 'required|exists:academic_years,id',
            'tingkat'          => 'required|integer|min:1|max:3',
            'name'             => 'required|string|max:100',
            'wali_kelas'       => 'nullable|string|max:100',
        ]);

        $class->update($validated);

        return redirect()
            ->route('classes.index')
            ->with('success', 'Data kelas berhasil diperbarui.');
    }

    /**
     * Hapus data kelas
     */
    public function destroy(string $id)
    {
        $class = SchoolClass::findOrFail($id);

        $class->delete();

        return redirect()
            ->route('classes.index')
            ->with('success', 'Data kelas berhasil dihapus.');
    }
}