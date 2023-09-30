<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hitung_suara', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tps_id')->constrained('tps')->cascadeOnDelete();
            $table->foreignId('kandidat_calon_id')->constrained('kandidat_calon')->cascadeOnDelete();
            $table->unsignedInteger('jumlah_suara_sah')->nullable()->default(0);
            $table->unsignedInteger('jumlah_suara_tidak_sah')->nullable()->default(0);
            $table->unsignedInteger('total_suara')->nullable()->default(0);
            $table->unsignedFloat('persentase')->nullable()->default(0.0);
            $table->unsignedTinyInteger('status_suara')->nullable()->default(1);
            $table->timestamps();
        });
    }
};
