// database/migrations/2024_01_01_000007_create_inventory_stock_movements_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('inventory', function (Blueprint $table) {
            $table->id('inventory_id');
            $table->foreignId('product_id')->constrained('products', 'id')->cascadeOnDelete();
            $table->unsignedBigInteger('variant_id')->nullable();
            $table->foreign('variant_id')->references('variant_id')->on('product_variants')->nullOnDelete();
            $table->integer('stock_quantity')->default(0);
            $table->integer('minimum_stock')->default(0);
            $table->integer('maximum_stock')->nullable();
            $table->string('warehouse_location')->nullable();
            $table->timestamp('last_updated')->nullable();
        });

        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id('movement_id');
            $table->unsignedBigInteger('inventory_id');
            $table->foreign('inventory_id')->references('inventory_id')->on('inventory')->cascadeOnDelete();
            $table->string('movement_type')->comment('IN, OUT, RETURN, DAMAGE, ADJUSTMENT');
            $table->integer('quantity');
            $table->string('reference_type')->nullable()->comment('order, return, purchase, manual');
            $table->integer('reference_id')->nullable();
            $table->string('notes')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down(): void {
        Schema::dropIfExists('stock_movements');
        Schema::dropIfExists('inventory');
    }
};
