<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Menampilkan daftar siswa
     */
    public function index(Request $request)
    {
        $query = Student::with(['class.academicYear']);

        // Search
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        // Filter kelas
        if ($request->filled('class_id')) {
            $query->where('class_id', $request->class_id);
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $students = $query
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        $classes = SchoolClass::with('academicYear')
            ->orderBy('tingkat')
            ->orderBy('name')
            ->get();

        return view('students.index', compact(
            'students',
            'classes'
        ));
    }

    /**
     * Form tambah siswa
     */
    public function create()
    {
        $classes = SchoolClass::with('academicYear')
            ->orderBy('tingkat')
            ->orderBy('name')
            ->get();

        return view('students.create', compact('classes'));
    }

    /**
     * Simpan data siswa
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|max:255',
            'class_id' => 'required|exists:classes,id',
            'status' => 'required|in:Aktif,Lulus,Pindah',
            'keterangan' => 'nullable|max:255',
        ]);

        Student::create($validated);

        return redirect()
            ->route('students.index')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    /**
     * Detail siswa
     */
    public function show(string $id)
    {
        $student = Student::with([
            'class.academicYear',
            'studentFeeStatuses.feeCategory'
        ])->findOrFail($id);

        return view('students.show', compact('student'));
    }

    /**
     * Form edit siswa
     */
    public function edit(string $id)
    {
        $student = Student::findOrFail($id);

        $classes = SchoolClass::with('academicYear')
            ->orderBy('tingkat')
            ->orderBy('name')
            ->get();

        return view('students.edit', compact(
            'student',
            'classes'
        ));
    }

    /**
     * Update data siswa
     */
    public function update(Request $request, string $id)
    {
        $student = Student::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|max:255',
            'class_id' => 'required|exists:classes,id',
            'status' => 'required|in:Aktif,Lulus,Pindah',
            'keterangan' => 'nullable|max:255',
        ]);

        $student->update($validated);

        return redirect()
            ->route('students.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    /**
     * Hapus siswa
     */
    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);

        $student->delete();

        return redirect()
            ->route('students.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }
}