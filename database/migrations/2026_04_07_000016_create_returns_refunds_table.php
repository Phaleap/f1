// database/migrations/2024_01_01_000016_create_returns_refunds_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('returns', function (Blueprint $table) {
            $table->id('return_id');
            $table->foreignId('order_item_id')->constrained('order_items', 'id')->cascadeOnDelete();
            $table->string('return_reason')->nullable();
            $table->string('return_status')->default('requested');
            $table->dateTime('requested_at')->nullable();
            $table->dateTime('approved_at')->nullable();
        });

        Schema::create('refunds', function (Blueprint $table) {
            $table->id('refund_id');
            $table->unsignedBigInteger('return_id');
            $table->foreign('return_id')->references('return_id')->on('returns')->cascadeOnDelete();
            $table->decimal('amount', 12, 2);
            $table->string('refund_method')->nullable();
            $table->string('refund_status')->default('pending');
            $table->dateTime('refunded_at')->nullable();
        });
    }

    public function down(): void {
        Schema::dropIfExists('refunds');
        Schema::dropIfExists('returns');
    }
};
