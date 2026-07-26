<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentFeeStatus;
use App\Models\AcademicYear;
use App\Models\FeeCategory;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function index()
    {
        $billings = StudentFeeStatus::with([
            'student.class',
            'feeCategory',
            'academicYear'
        ])
        ->latest()
        ->paginate(10);

        return view('billings.index', compact('billings'));
    }

    public function create()
    {
        $students = Student::orderBy('nama')->get();

        $academicYears = AcademicYear::orderBy('name')->get();

        $categories = FeeCategory::orderBy('urutan')->get();

        return view('billings.create', compact(
            'students',
            'academicYears',
            'categories'
        ));
    }

    public function store(Request $request)
    {

    }

    public function show(string $id)
    {
        $billing = StudentFeeStatus::with([
            'student.class',
            'feeCategory',
            'academicYear'
        ])->findOrFail($id);

        return view('billings.show', compact('billing'));
    }

    public function edit(string $id)
    {
        $billing = StudentFeeStatus::findOrFail($id);

        $students = Student::orderBy('nama')->get();

        $academicYears = AcademicYear::orderBy('name')->get();

        $categories = FeeCategory::orderBy('urutan')->get();

        return view('billings.edit', compact(
            'billing',
            'students',
            'academicYears',
            'categories'
        ));
    }

    public function update(Request $request, string $id)
    {

    }

    public function destroy(string $id)
    {

    }

    public function generate()
    {
        $academicYears = AcademicYear::orderBy('name')->get();

        return view('billings.generate', compact('academicYears'));
    }
}