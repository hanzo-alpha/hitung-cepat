<?php

declare(strict_types=1);

use App\Models\Caleg;
use App\Models\Tps;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quick_counts', static function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Tps::class)->constrained('tps')->cascadeOnDelete();
            $table->foreignIdFor(Caleg::class)->constrained('calegs')->cascadeOnDelete();
            $table->unsignedInteger('jumlah_suara')->nullable()->default(0);
            $table->unsignedFloat('persentase')->nullable()->default(0.0);
            $table->unsignedTinyInteger('status_suara')->nullable()->default(0);
            $table->timestamps();
        });
    }
};
