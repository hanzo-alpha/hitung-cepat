<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tps', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('data_tps_id')->nullable();
            $table->string('nama_tps')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->unsignedMediumInteger('jumlah_tps')->nullable()->default(0);
            $table->json('data_tps')->nullable();
            $table->text('keterangan')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tps');
    }
};
