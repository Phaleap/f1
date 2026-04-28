<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('products', function (Blueprint $table) {
        $table->boolean('requires_approval')->default(false)->after('product_type');
        $table->boolean('is_purchasable_online')->default(true)->after('requires_approval');
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn(['requires_approval', 'is_purchasable_online']);
    });
}
};
