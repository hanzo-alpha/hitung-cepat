<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('import_daftar_pemilih', static function (Blueprint $table) {
            $table->id();
            $table->string('provinsi')->nullable();
            $table->string('kabupaten')->nullable();
            $table->unsignedInteger('jumlah_kecamatan')->nullable();
            $table->unsignedInteger('jumlah_kelurahan')->nullable();
            $table->unsignedInteger('jumlah_tps')->nullable();
            $table->unsignedInteger('jumlah_laki')->nullable();
            $table->unsignedInteger('jumlah_perempuan')->nullable();
            $table->unsignedInteger('total_pemilih')->nullable();
            $table->unsignedTinyInteger('status_import')->nullable();
            $table->string('attachment')->nullable();
            $table->timestamps(); //
        });
    }
};
