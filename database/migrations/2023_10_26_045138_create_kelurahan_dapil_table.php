<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kelurahan_dapil', function (Blueprint $table) {
            $table->char('code')->primary();
            $table->foreign('code')
                ->on('kelurahan')
                ->references('code')
                ->cascadeOnDelete();
            $table->foreignId('dapil_id')->constrained('dapil')->cascadeOnDelete();
        });
    }
};
