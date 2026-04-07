// database/migrations/2024_01_01_000015_create_reviews_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('review_id');
            $table->foreignId('user_id')->constrained('users', 'id')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products', 'id')->cascadeOnDelete();
            $table->integer('rating');
            $table->text('comment')->nullable();
            $table->string('review_status')->default('visible');
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down(): void {
        Schema::dropIfExists('reviews');
    }
};
