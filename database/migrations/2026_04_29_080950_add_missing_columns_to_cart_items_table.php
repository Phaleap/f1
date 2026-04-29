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
    Schema::table('cart_items', function (Blueprint $table) {
        $table->unsignedBigInteger('variant_id')->nullable()->after('product_id');
        $table->decimal('unit_price', 10, 2)->nullable()->after('quantity');
        $table->timestamp('added_at')->nullable()->after('unit_price');

        $table->foreign('variant_id')->references('variant_id')->on('product_variants')->onDelete('set null');
    });
}

public function down(): void
{
    Schema::table('cart_items', function (Blueprint $table) {
        $table->dropForeign(['variant_id']);
        $table->dropColumn(['variant_id', 'unit_price', 'added_at']);
    });
}
};
