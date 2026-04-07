// database/migrations/2024_01_01_000012_create_shipments_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id('shipment_id');
            $table->foreignId('order_id')->constrained('orders', 'id')->cascadeOnDelete();
            $table->string('tracking_number')->nullable();
            $table->string('courier_name')->nullable();
            $table->dateTime('shipped_date')->nullable();
            $table->dateTime('delivered_date')->nullable();
            $table->string('shipment_status')->default('processing');
            $table->decimal('shipping_cost', 12, 2)->nullable();
            $table->string('notes')->nullable();
        });
    }

    public function down(): void {
        Schema::dropIfExists('shipments');
    }
};
