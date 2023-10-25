<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatanRelawanTable extends Migration
{
    public function up(): void
    {
        Schema::create('kegiatan_relawan', static function (Blueprint $table) {
            $table->foreignId('kegiatan_id')->constrained('kegiatan')->cascadeOnDelete();
            $table->foreignId('relawan_id')->constrained('relawan')->cascadeOnDelete();
        });
    }
}
