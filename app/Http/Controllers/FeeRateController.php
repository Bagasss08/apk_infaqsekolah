<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\FeeCategory;
use App\Models\FeeRate;
use Illuminate\Http\Request;

class FeeRateController extends Controller
{
    /**
     * Daftar tarif tagihan
     */
    public function index()
    {
        $feeRates = FeeRate::with([
            'academicYear',
            'feeCategory'
        ])
        ->latest()
        ->paginate(10);

        return view('fee-rates.index', compact('feeRates'));
    }

    /**
     * Form tambah
     */
    public function create()
    {
        $academicYears = AcademicYear::orderBy('name')->get();

        $categories = FeeCategory::where('aktif', true)
            ->orderBy('urutan')
            ->get();

        return view('fee-rates.create', compact(
            'academicYears',
            'categories'
        ));
    }

    /**
     * Simpan
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'academic_year_id' => 'required|exists:academic_years,id',
            'fee_category_id'  => 'required|exists:fee_categories,id',
            'tingkat'          => 'required|integer|min:1|max:3',
            'nominal'          => 'required|numeric|min:0',
        ]);

        FeeRate::create($validated);

        return redirect()
            ->route('fee-rates.index')
            ->with('success', 'Tarif berhasil ditambahkan.');
    }

    /**
     * Form edit
     */
    public function edit(string $id)
    {
        $feeRate = FeeRate::findOrFail($id);

        $academicYears = AcademicYear::orderBy('name')->get();

        $categories = FeeCategory::where('aktif', true)
            ->orderBy('urutan')
            ->get();

        return view('fee-rates.edit', compact(
            'feeRate',
            'academicYears',
            'categories'
        ));
    }

    /**
     * Update
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'academic_year_id' => 'required|exists:academic_years,id',
            'fee_category_id'  => 'required|exists:fee_categories,id',
            'tingkat'          => 'required|integer|min:1|max:3',
            'nominal'          => 'required|numeric|min:0',
        ]);

        $feeRate = FeeRate::findOrFail($id);

        $feeRate->update($validated);

        return redirect()
            ->route('fee-rates.index')
            ->with('success', 'Tarif berhasil diperbarui.');
    }

    /**
     * Hapus
     */
    public function destroy(string $id)
    {
        FeeRate::findOrFail($id)->delete();

        return redirect()
            ->route('fee-rates.index')
            ->with('success', 'Tarif berhasil dihapus.');
    }
}