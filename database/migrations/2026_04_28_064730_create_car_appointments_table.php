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
    Schema::create('car_appointments', function (Blueprint $table) {
        $table->id('appointment_id');
        $table->unsignedBigInteger('request_id');
        $table->unsignedBigInteger('user_id');
        $table->datetime('appointment_date');
        $table->string('location')->nullable();
        $table->string('appointment_status')->default('scheduled');
        $table->unsignedBigInteger('confirmed_by')->nullable();
        $table->datetime('confirmed_at')->nullable();
        $table->text('notes')->nullable();
        $table->timestamps();

       $table->foreign('request_id')->references('request_id')->on('car_purchase_requests');
$table->foreign('user_id')->references('id')->on('users');
$table->foreign('confirmed_by')->references('id')->on('users');
    });
}

public function down(): void
{
    Schema::dropIfExists('car_appointments');
}
};
