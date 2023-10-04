<?php

declare(strict_types=1);

use App\Models\Dapil;
use App\Models\JenisPemilihan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dapil_jenis_pemilihan', static function (Blueprint $table) {
            $table->foreignIdFor(Dapil::class)->constrained('dapil')->cascadeOnDelete();
            $table->foreignIdFor(JenisPemilihan::class)->constrained('jenis_pemilihan')->cascadeOnDelete();
            $table->unsignedInteger('jumlah_suara')->nullable()->default(0);
            $table->unsignedInteger('jumlah_dapil')->nullable()->default(0);
        });
    }
};
