// database/migrations/2024_01_01_000008_create_shipping_payment_methods_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('shipping_methods', function (Blueprint $table) {
            $table->id('shipping_method_id');
            $table->string('method_name');
            $table->string('description')->nullable();
            $table->decimal('fee', 12, 2);
            $table->integer('estimated_days')->nullable();
            $table->string('status')->default('active');
        });

        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id('payment_method_id');
            $table->string('method_name');
            $table->string('provider')->nullable();
            $table->string('description')->nullable();
            $table->string('status')->default('active');
        });
    }

    public function down(): void {
        Schema::dropIfExists('payment_methods');
        Schema::dropIfExists('shipping_methods');
    }
};
