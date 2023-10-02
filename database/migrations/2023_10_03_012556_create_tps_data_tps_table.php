<?php

declare(strict_types=1);

use App\Models\DataTps;
use App\Models\Tps;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tps_data_tps', static function (Blueprint $table) {
            $table->foreignIdFor(Tps::class)->constrained('tps')->cascadeOnDelete();
            $table->foreignIdFor(DataTps::class)->constrained('data_tps')->cascadeOnDelete();
        });
    }
};
