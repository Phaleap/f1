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
    Schema::create('car_order_status_histories', function (Blueprint $table) { // <- add 's'
    $table->id('history_id');
    $table->unsignedBigInteger('car_order_id');
    $table->string('status');
    $table->unsignedBigInteger('changed_by');
    $table->datetime('changed_at');
    $table->string('remarks')->nullable();

    $table->foreign('car_order_id')->references('car_order_id')->on('car_orders');
    $table->foreign('changed_by')->references('id')->on('users');
});
}

public function down(): void
{
    Schema::dropIfExists('car_order_status_history');
}
};
