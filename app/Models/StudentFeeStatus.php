<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentFeeStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'fee_category_id',
        'academic_year_id',
        'bulan',
        'tahun',
        'nominal',
        'status',
        'tanggal_input',
        'catatan',
        'user_id',
    ];

    protected $casts = [
        'tanggal_input' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function feeCategory()
    {
        return $this->belongsTo(FeeCategory::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}