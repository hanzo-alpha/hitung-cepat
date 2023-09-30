<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jenis_calon', static function (Blueprint $table) {
            $table->unsignedInteger('jumlah_dapil')->nullable()->default(0);
            $table->unsignedInteger('total_dapil')->nullable()->default(0);
            $table->unsignedInteger('total_kursi')->nullable()->default(0);
        });
    }
};
