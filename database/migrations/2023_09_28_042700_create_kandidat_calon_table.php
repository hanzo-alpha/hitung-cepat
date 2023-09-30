<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kandidat_calon', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partai_id')->constrained('partai')->cascadeOnDelete();
            $table->string('nama_kandidat_1');
            $table->string('nama_kandidat_2');
            $table->bigInteger('jenis_calon_id');
            $table->unsignedTinyInteger('status_kandidat')->nullable(); //
        });
    }
};
