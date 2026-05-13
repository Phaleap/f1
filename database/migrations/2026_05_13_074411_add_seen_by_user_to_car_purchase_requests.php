<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('car_purchase_requests', function (Blueprint $table) {
        $table->boolean('seen_by_user')->default(false);
    });
}

public function down(): void
{
    Schema::table('car_purchase_requests', function (Blueprint $table) {
        $table->dropColumn('seen_by_user');
    });
}
    
};
