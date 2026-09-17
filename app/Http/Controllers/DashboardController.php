<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Student;
use App\Models\StudentFeeStatus;
use App\Models\ImportHistory;

class DashboardController extends Controller
{
    public function index()
    {
        $activeYear = AcademicYear::where('is_active', 1)->first();

        $totalSiswa = Student::where('status', 'Aktif')->count();

        $baseQuery = StudentFeeStatus::query()
            ->when($activeYear, fn ($q) => $q->where('academic_year_id', $activeYear->id));

        $sudahLunas = (clone $baseQuery)
            ->where('status', 'Lunas')
            ->select('student_id')->distinct()->count();

        $belumLunas = (clone $baseQuery)
            ->where('status', 'Belum Lunas')
            ->select('student_id')->distinct()->count();

        // Total per kategori (hanya yang berstatus Lunas)
        $totalPerKategori = StudentFeeStatus::selectRaw('fee_categories.nama, SUM(student_fee_statuses.nominal) as total')
            ->join('fee_categories', 'fee_categories.id', '=', 'student_fee_statuses.fee_category_id')
            ->where('student_fee_statuses.status', 'Lunas')
            ->when($activeYear, fn ($q) => $q->where('student_fee_statuses.academic_year_id', $activeYear->id))
            ->groupBy('fee_categories.nama')
            ->pluck('total', 'fee_categories.nama');

        $totalInfaq  = $totalPerKategori['Infaq']  ?? 0;
        $totalLKS    = $totalPerKategori['LKS']    ?? 0;
        $totalSarpas = $totalPerKategori['Sarpas'] ?? 0;

        // Grafik pembayaran per bulan (Jan-Des) untuk tahun ajaran aktif
        $grafikBulanan = StudentFeeStatus::selectRaw('bulan, SUM(nominal) as total')
            ->where('status', 'Lunas')
            ->when($activeYear, fn ($q) => $q->where('academic_year_id', $activeYear->id))
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        $bulanLabel = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        $grafikData = [];
        foreach ($bulanLabel as $i => $label) {
            $grafikData[] = (int) ($grafikBulanan[$i + 1] ?? 0);
        }

        $aktivitasTerbaru = ImportHistory::latest()->take(5)->get();

        return view('dashboard.index', compact(
            'totalSiswa', 'sudahLunas', 'belumLunas', 'activeYear',
            'totalInfaq', 'totalLKS', 'totalSarpas',
            'bulanLabel', 'grafikData', 'aktivitasTerbaru'
        ));
    }
}