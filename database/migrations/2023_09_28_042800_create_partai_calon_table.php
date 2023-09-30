<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('partai_calon', function (Blueprint $table) {
            $table->foreignId('partai_id')->constrained('partai')->cascadeOnDelete();
            $table->foreignId('calon_id')->constrained('kandidat_calon')->cascadeOnDelete();
        });
    }
};
