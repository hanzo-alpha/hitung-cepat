<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jenis_pemilihan', static function (Blueprint $table) {
            $table->id();
            $table->string('nama_institusi');
            $table->string('tingkat_pemilihan')->nullable();
            $table->unsignedInteger('jumlah_dapil')->nullable()->default(0);
            $table->unsignedInteger('jumlah_kursi')->nullable()->default(0);
            $table->unsignedInteger('total_dapil')->nullable()->default(0);
            $table->unsignedInteger('total_kursi')->nullable()->default(0);
            $table->text('deskripsi')->nullable();
            $table->boolean('status_pemilihan')->nullable()->default(true);
            $table->timestamps(); //
        });
    }
};
