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
            $table->string('provinsi');
            $table->string('kabupaten');
            $table->string('kecamatan')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('nama_dapil');
            $table->unsignedInteger('jumlah_dapil')->nullable()->default(0);
            $table->unsignedInteger('jumlah_kursi')->nullable()->default(0);
            $table->timestamps(); //
        });
    }
};
