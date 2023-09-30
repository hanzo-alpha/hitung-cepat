<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_tps', static function (Blueprint $table) {
            $table->id();
            $table->string('nama_tps');
            $table->unsignedTinyInteger('jumlah_suara')->nullable()->default(0);
            $table->json('data_tps')->nullable();
            $table->timestamps();
        });
    }
};
