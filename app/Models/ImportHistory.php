<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImportHistory extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nama_file',
        'jumlah_data',
        'berhasil',
        'gagal',
        'user_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}