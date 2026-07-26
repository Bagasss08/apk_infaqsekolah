<?php

namespace App\Http\Controllers;

use App\Models\FeeCategory;
use Illuminate\Http\Request;

class FeeCategoryController extends Controller
{
    /**
     * Menampilkan daftar kategori
     */
    public function index()
    {
        $categories = FeeCategory::orderBy('nama')->paginate(10);

        return view('fee-categories.index', compact('categories'));
    }

    /**
     * Form tambah kategori
     */
    public function create()
    {
        return view('fee-categories.create');
    }

    /**
     * Simpan kategori
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'urutan' => 'nullable|integer|min:1',
            'aktif' => 'nullable|boolean',
        ]);

        FeeCategory::create([
            'nama'   => $validated['nama'],
            'urutan' => $validated['urutan'] ?? 1,
            'aktif'  => $request->has('aktif'),
        ]);

        return redirect()
            ->route('fee-categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Form edit
     */
    public function edit(string $id)
    {
        $category = FeeCategory::findOrFail($id);

        return view('fee-categories.edit', compact('category'));
    }

    /**
     * Update kategori
     */
    public function update(Request $request, string $id)
    {
        $category = FeeCategory::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'urutan' => 'nullable|integer|min:1',
            'aktif' => 'nullable|boolean',
        ]);

        $category->update([
            'nama'   => $validated['nama'],
            'urutan' => $validated['urutan'] ?? 1,
            'aktif'  => $request->has('aktif'),
        ]);

        return redirect()
            ->route('fee-categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Hapus kategori
     */
    public function destroy(string $id)
    {
        $category = FeeCategory::findOrFail($id);

        $category->delete();

        return redirect()
            ->route('fee-categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}