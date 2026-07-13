<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'class_id',
        'keterangan',
        'status',
    ];

    public function class()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function studentFeeStatuses()
    {
        return $this->hasMany(StudentFeeStatus::class);
    }
}