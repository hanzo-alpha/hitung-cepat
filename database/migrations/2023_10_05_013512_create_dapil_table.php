<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dapil', static function (Blueprint $table) {
            $table->id();
            $table->char('provinsi', 2);
            $table->char('kabupaten', 4);
            $table->char('kecamatan', 7)->nullable();
            $table->char('kelurahan', 10)->nullable();
            $table->string('nama_dapil');
            $table->foreignId('jenis_pemilihan')->constrained('jenis_pemilihan')->cascadeOnDelete();
            $table->json('daerah_pemilihan')->nullable();
            $table->unsignedInteger('jumlah_dapil')->nullable()->default(0);
            $table->unsignedInteger('jumlah_kursi')->nullable()->default(0);
            $table->timestamps(); //
        });
    }
};
