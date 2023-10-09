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
        Schema::create('caleg', static function (Blueprint $table) {
            $table->id();
            $table->string('nama_caleg');
            $table->foreignIdFor(Partai::class)->constrained('partai')->cascadeOnDelete();
            $table->foreignIdFor(JenisPemilihan::class)->constrained('jenis_pemilihan')->cascadeOnDelete();
            $table->boolean('status_aktif')->nullable();
            $table->timestamps(); //
        });
    }
};
