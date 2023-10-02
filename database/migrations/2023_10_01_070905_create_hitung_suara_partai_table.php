<?php

declare(strict_types=1);

use App\Models\JenisPemilihan;
use App\Models\Partai;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hitung_suara_partai', static function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Partai::class)->constrained('partai')->cascadeOnDelete();
            $table->foreignIdFor(JenisPemilihan::class)->constrained('jenis_pemilihan')->cascadeOnDelete();
            $table->unsignedInteger('jumlah_suara_partai')->nullable()->default(0);
            $table->unsignedInteger('jumlah_dapil')->nullable()->default(0);
            $table->unsignedInteger('jumlah_kursi')->nullable()->default(0);
            $table->unsignedInteger('total_suara')->nullable()->default(0);
            $table->unsignedInteger('total_kursi')->nullable()->default(0);
            $table->unsignedInteger('total_dapil')->nullable()->default(0);
            $table->unsignedInteger('persentase_suara')->nullable()->default(0);
            $table->unsignedTinyInteger('status_hitung')->nullable()->default(0);
            $table->timestamps(); //
        });
    }
};
