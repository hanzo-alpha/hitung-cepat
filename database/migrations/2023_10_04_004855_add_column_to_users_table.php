<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', static function (Blueprint $table) {
            $table->boolean('is_admin')->nullable()->default(false)->after('remember_token');
            $table->boolean('is_active')->nullable()->default(true)->after('is_admin');
        });
    }
};
