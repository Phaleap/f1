<?php

// FILE: database/migrations/YYYY_MM_DD_000002_add_photo_url_to_drivers_table.php
// Run: php artisan migrate

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('drivers', function (Blueprint $table) {
            if (!Schema::hasColumn('drivers', 'photo_url')) {
                $table->string('photo_url')->nullable()->after('nationality')
                    ->comment('External URL to driver portrait image');
            }
        });
    }

    public function down(): void
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->dropColumn('photo_url');
        });
    }
};
