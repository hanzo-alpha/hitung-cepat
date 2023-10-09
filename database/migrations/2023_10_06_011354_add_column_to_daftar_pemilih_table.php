<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('daftar_pemilih', static function (Blueprint $table) {
            $table->unsignedTinyInteger('jenis_kelamin')->nullable()->default(1)->after('notelp');
            $table->string('attachment')->nullable()->after('status_daftar');
        });
    }
};
