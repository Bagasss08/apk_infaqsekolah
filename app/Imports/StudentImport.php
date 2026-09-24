<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\SchoolClass;
use App\Models\FeeRate;
use App\Models\StudentFeeStatus;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Cari kelas berdasarkan ASAL KELAS
        $class = SchoolClass::where('name', trim($row['asal_kelas']))
            ->first();

        // Jika kelas tidak ditemukan, lewati baris
        if (!$class) {
            return null;
        }

        // Buat data siswa
        $student = Student::create([
            'nama' => trim($row['nama_siswa']),
            'jenis_kelamin' => strtoupper(trim($row['keterangan'])),
            'class_id' => $class->id,
            'status' => 'Aktif',
        ]);

        // Cari tarif berdasarkan tahun ajaran dan tingkat
        $feeRates = FeeRate::where('academic_year_id', $class->academic_year_id)
            ->where('tingkat', $class->tingkat)
            ->get();

        // Generate tagihan otomatis
        foreach ($feeRates as $feeRate) {

            StudentFeeStatus::create([
                'student_id' => $student->id,
                'fee_category_id' => $feeRate->fee_category_id,
                'academic_year_id' => $class->academic_year_id,
                'bulan' => now()->month,
                'tahun' => now()->year,
                'nominal' => $feeRate->nominal,
                'status' => 'Belum Lunas',
                'tanggal_input' => now(),
                'user_id' => Auth::id(),
            ]);
        }

        return $student;
    }
}