<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('partai', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('no_urut');
            $table->string('nama_partai');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partai');
    }
};
