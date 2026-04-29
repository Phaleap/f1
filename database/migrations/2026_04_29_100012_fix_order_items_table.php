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
    Schema::table('order_items', function (Blueprint $table) {
        $table->unsignedBigInteger('variant_id')->nullable()->after('product_id');
        $table->decimal('unit_price', 12, 2)->nullable()->after('quantity');
        $table->decimal('discount_amount', 12, 2)->default(0)->after('unit_price');
        $table->decimal('subtotal', 12, 2)->nullable()->after('discount_amount');

        $table->foreign('variant_id')->references('variant_id')->on('product_variants')->onDelete('set null');
    });
}

public function down(): void
{
    Schema::table('order_items', function (Blueprint $table) {
        $table->dropForeign(['variant_id']);
        $table->dropColumn(['variant_id', 'unit_price', 'discount_amount', 'subtotal']);
    });
}
};
