<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('orders', function (Blueprint $table) {
            // Drop old columns
            $table->dropColumn(['name', 'email', 'phone', 'address', 'city', 'total']);

            // Add proper columns
            $table->unsignedBigInteger('address_id')->nullable()->after('user_id');
            $table->foreign('address_id')->references('address_id')->on('user_addresses')->nullOnDelete();

            $table->unsignedBigInteger('shipping_method_id')->nullable()->after('address_id');
            $table->foreign('shipping_method_id')->references('shipping_method_id')->on('shipping_methods')->nullOnDelete();

            $table->decimal('subtotal', 12, 2)->after('shipping_method_id');
            $table->decimal('discount_amount', 12, 2)->default(0)->after('subtotal');
            $table->decimal('shipping_fee', 12, 2)->default(0)->after('discount_amount');
            $table->decimal('total_amount', 12, 2)->after('shipping_fee');
            $table->string('order_status')->default('pending')->after('total_amount');
            $table->dateTime('order_date')->nullable()->after('order_status');
            $table->string('notes')->nullable()->after('order_date');

            // Drop old status column (replaced by order_status)
            $table->dropColumn('status');
        });
    }

    public function down(): void {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['address_id', 'shipping_method_id']);
            $table->dropColumn(['address_id', 'shipping_method_id', 'subtotal', 'discount_amount', 'shipping_fee', 'total_amount', 'order_status', 'order_date', 'notes']);
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->text('address');
            $table->string('city');
            $table->decimal('total', 10, 2);
            $table->string('status')->default('pending');
        });
    }
};
