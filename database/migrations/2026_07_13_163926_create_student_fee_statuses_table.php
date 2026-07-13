<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_fee_statuses', function (Blueprint $table) {

            $table->id();

            $table->foreignId('student_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('fee_category_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('academic_year_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->unsignedTinyInteger('bulan');

            $table->year('tahun');

            $table->unsignedBigInteger('nominal');

            $table->enum('status', [
                'Belum Lunas',
                'Lunas'
            ])->default('Belum Lunas');

            $table->date('tanggal_input')->nullable();

            $table->text('catatan')->nullable();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->timestamps();

            $table->unique([
                'student_id',
                'fee_category_id',
                'academic_year_id',
                'bulan'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_fee_statuses');
    }
};