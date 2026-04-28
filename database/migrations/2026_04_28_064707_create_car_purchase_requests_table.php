<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('car_purchase_requests', function (Blueprint $table) {
            $table->id('request_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id');
            $table->string('full_name');
            $table->string('phone');
            $table->text('message')->nullable();
            $table->string('payment_preference');
            $table->string('request_status')->default('pending');
            $table->unsignedBigInteger('reviewed_by')->nullable();
            $table->datetime('reviewed_at')->nullable();
            $table->string('rejection_reason')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
$table->foreign('product_id')->references('id')->on('products');
$table->foreign('reviewed_by')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('car_purchase_requests');
    }
};