<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('caleg', static function (Blueprint $table) {
            $table->unsignedTinyInteger('jenis_kelamin')->nullable()->default(0)->after('nama_caleg');
        });
    }
};
