<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicYear extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function classes()
    {
        return $this->hasMany(SchoolClass::class);
    }

    public function feeRates()
    {
        return $this->hasMany(FeeRate::class);
    }

    public function studentFeeStatuses()
    {
        return $this->hasMany(StudentFeeStatus::class);
    }
}