// database/migrations/2024_01_01_000009_create_discounts_promotions_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('discounts', function (Blueprint $table) {
            $table->id('discount_id');
            $table->string('discount_name');
            $table->string('discount_type')->comment('percentage or fixed');
            $table->decimal('discount_value', 12, 2);
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->integer('min_quantity')->default(1);
            $table->string('status')->default('active');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('product_discounts', function (Blueprint $table) {
            $table->id('product_discount_id');
            $table->foreignId('product_id')->constrained('products', 'id')->cascadeOnDelete();
            $table->unsignedBigInteger('discount_id');
            $table->foreign('discount_id')->references('discount_id')->on('discounts')->cascadeOnDelete();
        });

        Schema::create('promotions', function (Blueprint $table) {
            $table->id('promotion_id');
            $table->string('promotion_name');
            $table->text('description')->nullable();
            $table->string('promotion_type')->nullable()->comment('seasonal, bundle, free_shipping, race_event');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->string('status')->default('active');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('product_promotions', function (Blueprint $table) {
            $table->id('product_promotion_id');
            $table->foreignId('product_id')->constrained('products', 'id')->cascadeOnDelete();
            $table->unsignedBigInteger('promotion_id');
            $table->foreign('promotion_id')->references('promotion_id')->on('promotions')->cascadeOnDelete();
        });
    }

    public function down(): void {
        Schema::dropIfExists('product_promotions');
        Schema::dropIfExists('promotions');
        Schema::dropIfExists('product_discounts');
        Schema::dropIfExists('discounts');
    }
};
