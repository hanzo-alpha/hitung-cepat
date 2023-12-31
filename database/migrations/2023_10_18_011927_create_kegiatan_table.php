<?php

declare(strict_types=1);

use App\Models\Relawan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kegiatan', static function (Blueprint $table) {
            $table->id();
            $table->string('nama_kegiatan');
            $table->string('deskripsi');
            $table->dateTime('tanggal');
            $table->foreignIdFor(Relawan::class)
                ->nullable()
                ->constrained('relawan')
                ->cascadeOnUpdate();
            $table->string('status_kegiatan')->nullable();
            $table->timestamps(); //
        });
    }
};
