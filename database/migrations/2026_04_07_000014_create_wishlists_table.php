// database/migrations/2024_01_01_000014_create_wishlists_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id('wishlist_id');
            $table->foreignId('user_id')->constrained('users', 'id')->cascadeOnDelete();
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('wishlist_items', function (Blueprint $table) {
            $table->id('wishlist_item_id');
            $table->unsignedBigInteger('wishlist_id');
            $table->foreign('wishlist_id')->references('wishlist_id')->on('wishlists')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products', 'id')->cascadeOnDelete();
            $table->timestamp('added_at')->nullable();
        });
    }

    public function down(): void {
        Schema::dropIfExists('wishlist_items');
        Schema::dropIfExists('wishlists');
    }
};
