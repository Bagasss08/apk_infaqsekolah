<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fee_rates', function (Blueprint $table) {

            $table->id();

            $table->foreignId('academic_year_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('fee_category_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->unsignedTinyInteger('tingkat');

            $table->unsignedBigInteger('nominal');

            $table->timestamps();

            $table->unique([
                'academic_year_id',
                'fee_category_id',
                'tingkat'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fee_rates');
    }
};