// database/migrations/2024_01_01_000006_alter_products_add_product_images_variants.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
   public function up(): void {
    Schema::table('products', function (Blueprint $table) {
        if (Schema::hasColumn('products', 'stock')) $table->dropColumn('stock');
        if (Schema::hasColumn('products', 'image')) $table->dropColumn('image');
        if (Schema::hasColumn('products', 'category')) $table->dropColumn('category');
        if (Schema::hasColumn('products', 'name')) $table->renameColumn('name', 'product_name');
        if (Schema::hasColumn('products', 'price')) $table->renameColumn('price', 'base_price');

        if (!Schema::hasColumn('products', 'category_id')) {
            $table->unsignedBigInteger('category_id')->nullable()->after('id');
        }
        if (!Schema::hasColumn('products', 'brand_id')) {
            $table->unsignedBigInteger('brand_id')->nullable()->after('category_id');
            $table->foreign('brand_id')->references('brand_id')->on('brands')->nullOnDelete();
        }
        if (!Schema::hasColumn('products', 'supplier_id')) {
            $table->unsignedBigInteger('supplier_id')->nullable()->after('brand_id');
            $table->foreign('supplier_id')->references('supplier_id')->on('suppliers')->nullOnDelete();
        }
        if (!Schema::hasColumn('products', 'car_model_id')) {
            $table->unsignedBigInteger('car_model_id')->nullable()->after('supplier_id');
            $table->foreign('car_model_id')->references('car_model_id')->on('car_models')->nullOnDelete();
        }
        if (!Schema::hasColumn('products', 'sku')) {
            $table->string('sku')->unique()->after('product_name');
        }
        if (!Schema::hasColumn('products', 'cost_price')) {
            $table->decimal('cost_price', 12, 2)->nullable()->after('base_price');
        }
        if (!Schema::hasColumn('products', 'product_type')) {
            $table->string('product_type')->after('cost_price')->comment('car or merchandise');
        }
        if (!Schema::hasColumn('products', 'material')) {
            $table->string('material')->nullable();
        }
        if (!Schema::hasColumn('products', 'weight')) {
            $table->decimal('weight', 10, 2)->nullable();
        }
        if (!Schema::hasColumn('products', 'warranty_id')) {
            $table->unsignedBigInteger('warranty_id')->nullable();
            $table->foreign('warranty_id')->references('warranty_id')->on('warranties')->nullOnDelete();
        }
        if (!Schema::hasColumn('products', 'status')) {
            $table->string('status')->default('active');
        }
    });

    if (!Schema::hasTable('product_images')) {
        Schema::create('product_images', function (Blueprint $table) {
            $table->id('image_id');
            $table->foreignId('product_id')->constrained('products', 'id')->cascadeOnDelete();
            $table->string('image_url');
            $table->string('alt_text')->nullable();
            $table->boolean('is_main')->default(false);
            $table->integer('sort_order')->default(1);
            $table->timestamp('created_at')->nullable();
        });
    }

    if (!Schema::hasTable('product_variants')) {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id('variant_id');
            $table->foreignId('product_id')->constrained('products', 'id')->cascadeOnDelete();
            $table->string('variant_name')->nullable();
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->string('edition')->nullable();
            $table->decimal('extra_price', 12, 2)->default(0);
            $table->string('sku')->unique()->nullable();
            $table->string('status')->default('active');
            $table->timestamp('created_at')->nullable();
        });
    }
}

};
