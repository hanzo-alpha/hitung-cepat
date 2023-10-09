<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daftar_pemilih', static function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('nik');
            $table->string('no_kk');
            $table->string('notelp');
            $table->text('alamat')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kode_pos')->nullable();
            $table->unsignedTinyInteger('status_pemilih')->nullable()->default(0);
            $table->enum(
                'status_daftar',
                ['Pemilih Tetap', 'Pemilih Sementara']
            )->nullable()->default('Pemilih Sementara');
            $table->timestamps(); //
        });
    }
};
