// database/migrations/2024_01_01_000010_create_coupons_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id('coupon_id');
            $table->string('code')->unique();
            $table->string('description')->nullable();
            $table->string('discount_type')->comment('percentage or fixed');
            $table->decimal('discount_value', 12, 2);
            $table->decimal('min_order_amount', 12, 2)->default(0);
            $table->integer('usage_limit')->nullable();
            $table->integer('used_count')->default(0);
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->string('status')->default('active');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('order_coupons', function (Blueprint $table) {
            $table->id('order_coupon_id');
            $table->foreignId('order_id')->constrained('orders', 'id')->cascadeOnDelete();
            $table->unsignedBigInteger('coupon_id');
            $table->foreign('coupon_id')->references('coupon_id')->on('coupons')->cascadeOnDelete();
            $table->decimal('discount_amount', 12, 2)->default(0);
        });
    }

    public function down(): void {
        Schema::dropIfExists('order_coupons');
        Schema::dropIfExists('coupons');
    }
};
