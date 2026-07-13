<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FeeCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'urutan',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];

    public function feeRates()
    {
        return $this->hasMany(FeeRate::class);
    }

    public function studentFeeStatuses()
    {
        return $this->hasMany(StudentFeeStatus::class);
    }
}