<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('partai', function (Blueprint $table) {
            $table->string('alias')->after('nama_partai')->nullable();
            $table->string('warna')->after('alias')->nullable();
            $table->string('logo')->after('warna')->nullable();
        });
    }
};
