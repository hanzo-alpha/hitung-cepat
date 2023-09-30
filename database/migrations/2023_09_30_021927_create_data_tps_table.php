<?php

declare(strict_types=1);

use App\Models\Tps;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_tps', static function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Tps::class)->nullable()->constrained('tps')->cascadeOnDelete();
            $table->string('nama_tps');
            $table->unsignedTinyInteger('jumlah_suara')->nullable()->default(0);
            $table->timestamps();
        });
    }
};
