// database/migrations/2024_01_01_000013_create_order_status_history_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('order_status_history', function (Blueprint $table) {
            $table->id('history_id');
            $table->foreignId('order_id')->constrained('orders', 'id')->cascadeOnDelete();
            $table->string('status');
            $table->unsignedBigInteger('changed_by')->nullable()->comment('user/admin id');
            $table->foreign('changed_by')->references('id')->on('users')->nullOnDelete();
            $table->dateTime('changed_at')->nullable();
            $table->string('remarks')->nullable();
        });
    }

    public function down(): void {
        Schema::dropIfExists('order_status_history');
    }
};
