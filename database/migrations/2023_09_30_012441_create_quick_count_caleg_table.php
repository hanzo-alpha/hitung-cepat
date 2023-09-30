<?php

declare(strict_types=1);

use App\Models\Caleg;
use App\Models\QuickCount;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quick_count_caleg', static function (Blueprint $table) {
            $table->foreignIdFor(QuickCount::class)->constrained('quick_counts')->cascadeOnDelete();
            $table->foreignIdFor(Caleg::class)->constrained('calegs')->cascadeOnDelete();
        });
    }
};
