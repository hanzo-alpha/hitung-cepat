<?php

declare(strict_types=1);

use App\Models\HitungSuaraPartai;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('suara_partai', static function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(HitungSuaraPartai::class)
                ->nullable()
                ->constrained('hitung_suara_partai')
                ->cascadeOnDelete();
            $table->unsignedInteger('jumlah_suara')->default(0);
            $table->timestamps();
        });
    }
};
