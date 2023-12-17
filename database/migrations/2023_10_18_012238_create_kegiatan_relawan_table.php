<?php

declare(strict_types=1);

use App\Models\Kegiatan;
use App\Models\Relawan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kegiatan_relawan', static function (Blueprint $table) {
            $table->foreignIdFor(Kegiatan::class)->constrained('kegiatan')->cascadeOnUpdate();
            $table->foreignIdFor(Relawan::class)->constrained('relawan')->cascadeOnUpdate();
        });
    }
};
