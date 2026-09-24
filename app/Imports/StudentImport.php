<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\SchoolClass;
use App\Models\FeeRate;
use App\Models\StudentFeeStatus;
use App\Models\AcademicYear;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToModel, WithHeadingRow
{
    /**
     * Header Excel berada di baris ke-2
     */
    public function headingRow(): int
    {
        return 2;
    }

    /**
     * Proses setiap baris Excel
     */
    public function model(array $row): ?Student
    {
        // Ambil data dari Excel
        $nama = trim($row['nama_siswa'] ?? '');
        $asalKelas = strtoupper(trim($row['asal_kelas'] ?? ''));
        $jenisKelamin = strtoupper(trim($row['keterangan'] ?? ''));

        /*
        |--------------------------------------------------------------------------
        | 1. Lewati baris kosong
        |--------------------------------------------------------------------------
        */

        if ($nama === '' || $asalKelas === '') {
            return null;
        }

        /*
        |--------------------------------------------------------------------------
        | 2. Lewati data PINDAHAN
        |--------------------------------------------------------------------------
        */

        if ($asalKelas === 'PINDAHAN') {
            return null;
        }

        /*
        |--------------------------------------------------------------------------
        | 3. Cari tahun ajaran aktif
        |--------------------------------------------------------------------------
        */

        $academicYear = AcademicYear::where('is_active', true)->first();

        if (!$academicYear) {
            throw new \Exception(
                'Belum ada tahun ajaran yang aktif.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | 4. Tentukan tingkat berdasarkan nama kelas
        |--------------------------------------------------------------------------
        */

        $tingkat = $this->getTingkat($asalKelas);

        if (!$tingkat) {
            throw new \Exception(
                "Tingkat dari kelas '{$asalKelas}' tidak dapat ditentukan."
            );
        }

        /*
        |--------------------------------------------------------------------------
        | 5. Cari kelas
        |--------------------------------------------------------------------------
        | Jika kelas belum ada, otomatis dibuat.
        |--------------------------------------------------------------------------
        */

        $class = SchoolClass::where(
            'academic_year_id',
            $academicYear->id
        )
            ->where('name', $asalKelas)
            ->first();

        if (!$class) {
            $class = SchoolClass::create([
                'academic_year_id' => $academicYear->id,
                'name' => $asalKelas,
                'tingkat' => $tingkat,
                'wali_kelas' => '-',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | 6. Cek apakah siswa sudah ada
        |--------------------------------------------------------------------------
        | Supaya ketika Excel di-upload ulang, siswa tidak dibuat dua kali.
        |--------------------------------------------------------------------------
        */

        $student = Student::where('nama', $nama)
            ->where('class_id', $class->id)
            ->first();

        if ($student) {

            // Update jenis kelamin jika data sudah ada
            $student->update([
                'jenis_kelamin' => $jenisKelamin ?: $student->jenis_kelamin,
                'status' => 'Aktif',
            ]);

        } else {

            /*
            |--------------------------------------------------------------------------
            | 7. Buat siswa baru
            |--------------------------------------------------------------------------
            */

            $student = Student::create([
                'nama' => $nama,
                'jenis_kelamin' => $jenisKelamin,
                'class_id' => $class->id,
                'status' => 'Aktif',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | 8. Ambil tarif berdasarkan tingkat
        |--------------------------------------------------------------------------
        */

        $feeRates = FeeRate::where(
            'academic_year_id',
            $academicYear->id
        )
            ->where('tingkat', $tingkat)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | 9. Buat status tagihan
        |--------------------------------------------------------------------------
        */

        foreach ($feeRates as $feeRate) {

            // Cek apakah tagihan bulan ini sudah ada
            $existingFee = StudentFeeStatus::where(
                'student_id',
                $student->id
            )
                ->where(
                    'fee_category_id',
                    $feeRate->fee_category_id
                )
                ->where(
                    'academic_year_id',
                    $academicYear->id
                )
                ->where(
                    'bulan',
                    now()->month
                )
                ->first();

            /*
            |--------------------------------------------------------------------------
            | 10. Jika belum ada, buat tagihan
            |--------------------------------------------------------------------------
            */

            if (!$existingFee) {

                StudentFeeStatus::create([
                    'student_id' => $student->id,
                    'fee_category_id' => $feeRate->fee_category_id,
                    'academic_year_id' => $academicYear->id,
                    'bulan' => now()->month,
                    'tahun' => now()->year,
                    'nominal' => $feeRate->nominal,
                    'status' => 'Belum Lunas',
                    'tanggal_input' => now(),
                    'user_id' => 1,
                ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | 11. Kembalikan data siswa
        |--------------------------------------------------------------------------
        */

        return $student;
    }

    /**
     * Menentukan tingkat dari nama kelas
     *
     * Contoh:
     * I A   -> 1
     * II A  -> 2
     * III A -> 3
     * IV A  -> 4
     * V A   -> 5
     * VI A  -> 6
     */
    private function getTingkat(string $namaKelas): ?int
    {
        $namaKelas = strtoupper(trim($namaKelas));

        if (str_starts_with($namaKelas, 'I ')) {
            return 1;
        }

        if (str_starts_with($namaKelas, 'II ')) {
            return 2;
        }

        if (str_starts_with($namaKelas, 'III ')) {
            return 3;
        }

        if (str_starts_with($namaKelas, 'IV ')) {
            return 4;
        }

        if (str_starts_with($namaKelas, 'V ')) {
            return 5;
        }

        if (str_starts_with($namaKelas, 'VI ')) {
            return 6;
        }

        return null;
    }
}