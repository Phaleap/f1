// database/migrations/2024_01_01_000011_create_payments_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('payments', function (Blueprint $table) {
            $table->id('payment_id');
            $table->foreignId('order_id')->constrained('orders', 'id')->cascadeOnDelete();
            $table->unsignedBigInteger('payment_method_id');
            $table->foreign('payment_method_id')->references('payment_method_id')->on('payment_methods');
            $table->string('transaction_code')->nullable();
            $table->decimal('amount', 12, 2);
            $table->string('payment_status')->default('pending');
            $table->dateTime('payment_date')->nullable();
            $table->string('notes')->nullable();
        });
    }

    public function down(): void {
        Schema::dropIfExists('payments');
    }
};
