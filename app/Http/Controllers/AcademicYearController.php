<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    /**
     * Menampilkan daftar tahun ajaran
     */
    public function index()
    {
        $academicYears = AcademicYear::orderByDesc('id')
            ->paginate(10);

        return view('academic-years.index', compact('academicYears'));
    }

    /**
     * Form tambah tahun ajaran
     */
    public function create()
    {
        return view('academic-years.create');
    }

    /**
     * Simpan tahun ajaran
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:100',
            'is_active' => 'required|boolean',
        ]);

        // Jika memilih aktif,
        // maka tahun ajaran lain dibuat tidak aktif
        if ($validated['is_active']) {
            AcademicYear::query()->update([
                'is_active' => false
            ]);
        }

        AcademicYear::create($validated);

        return redirect()
            ->route('academic-years.index')
            ->with('success', 'Tahun ajaran berhasil ditambahkan.');
    }

    /**
     * Form edit
     */
    public function edit(string $id)
    {
        $academicYear = AcademicYear::findOrFail($id);

        return view('academic-years.edit', compact('academicYear'));
    }

    /**
     * Update tahun ajaran
     */
    public function update(Request $request, string $id)
    {
        $academicYear = AcademicYear::findOrFail($id);

        $validated = $request->validate([
            'name'      => 'required|string|max:100',
            'is_active' => 'required|boolean',
        ]);

        if ($validated['is_active']) {
            AcademicYear::where('id', '!=', $academicYear->id)
                ->update([
                    'is_active' => false
                ]);
        }

        $academicYear->update($validated);

        return redirect()
            ->route('academic-years.index')
            ->with('success', 'Tahun ajaran berhasil diperbarui.');
    }

    /**
     * Hapus tahun ajaran
     */
    public function destroy(string $id)
    {
        $academicYear = AcademicYear::findOrFail($id);

        $academicYear->delete();

        return redirect()
            ->route('academic-years.index')
            ->with('success', 'Tahun ajaran berhasil dihapus.');
    }
}