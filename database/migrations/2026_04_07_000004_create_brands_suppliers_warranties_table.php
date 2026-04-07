// database/migrations/2024_01_01_000004_create_brands_suppliers_warranties_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('brands', function (Blueprint $table) {
            $table->id('brand_id');
            $table->string('brand_name')->unique();
            $table->string('description')->nullable();
            $table->string('country')->nullable();
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('suppliers', function (Blueprint $table) {
            $table->id('supplier_id');
            $table->string('supplier_name');
            $table->string('contact_person')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('status')->default('active');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('warranties', function (Blueprint $table) {
            $table->id('warranty_id');
            $table->string('warranty_name');
            $table->string('warranty_type')->nullable()->comment('manufacturer, seller, limited');
            $table->integer('duration_months');
            $table->text('terms')->nullable();
            $table->string('start_from')->nullable()->comment('purchase date or delivery date');
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down(): void {
        Schema::dropIfExists('warranties');
        Schema::dropIfExists('suppliers');
        Schema::dropIfExists('brands');
    }
};
