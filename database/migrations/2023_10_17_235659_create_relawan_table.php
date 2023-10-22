<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('relawan', static function (Blueprint $table) {
            $table->id();
            $table->string('nama_relawan');
            $table->unsignedInteger('umur')->nullable();
            $table->date('tgl_lahir');
            $table->string('notelp', 14);
            $table->string('alamat');
            $table->unsignedBigInteger('kegiatan_id')->nullable()->default(1);
            $table->unsignedBigInteger('kampanye_id')->nullable()->default(1);
            $table->unsignedBigInteger('anggaran_id')->nullable()->default(1);
            $table->string('provinsi', 2)->nullable();
            $table->string('kabupaten', 5)->nullable();
            $table->string('kecamatan', 7)->nullable();
            $table->string('kelurahan', 8)->nullable();
            $table->string('rt_rw', 10)->nullable();
            $table->string('kodepos', 6)->nullable();
            $table->unsignedTinyInteger('status_relawan')->nullable()->default(1);
            $table->timestamps(); //
        });
    }
};
