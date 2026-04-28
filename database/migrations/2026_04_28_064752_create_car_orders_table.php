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
    Schema::create('car_orders', function (Blueprint $table) {
        $table->id('car_order_id');
        $table->unsignedBigInteger('request_id');
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('address_id')->nullable();
        $table->unsignedBigInteger('payment_method_id')->nullable();
        $table->string('transaction_code')->nullable();
        $table->decimal('final_price', 12, 2);
        $table->string('car_order_status')->default('confirmed');
        $table->string('payment_preference');
        $table->unsignedBigInteger('payment_confirmed_by')->nullable();
        $table->datetime('payment_confirmed_at')->nullable();
        $table->string('payment_notes')->nullable();
        $table->date('expected_delivery')->nullable();
        $table->timestamps();

       $table->foreign('request_id')->references('request_id')->on('car_purchase_requests');
$table->foreign('user_id')->references('id')->on('users');
$table->foreign('address_id')->references('address_id')->on('user_addresses');
$table->foreign('payment_method_id')->references('payment_method_id')->on('payment_methods');
$table->foreign('payment_confirmed_by')->references('id')->on('users');
    });
}

public function down(): void
{
    Schema::dropIfExists('car_orders');
}
};
