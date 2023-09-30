<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('suara_kandidat_calon', function (Blueprint $table) {
            $table->foreignId('hitung_suara_id')->constrained('hitung_suara')->cascadeOnDelete();
            $table->foreignId('kandidat_calon_id')->constrained('kandidat_calon')->cascadeOnDelete();
            $table->unsignedInteger('jumlah_suara_sah')->nullable()->default(0);
            $table->unsignedInteger('jumlah_suara_tidak_sah')->nullable()->default(0);
            $table->unsignedFloat('persentase_suara')->nullable()->default(0.0);
        });
    }
};
