<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('calegs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_caleg');
            $table->unsignedBigInteger('partai_id');
            $table->unsignedBigInteger('jenis_calon_id');
            $table->unsignedInteger('jumlah_suara')->nullable();
            $table->string('status_caleg')->nullable();
            $table->boolean('status_aktif')->nullable();
            $table->timestamps(); //
        });
    }
};
