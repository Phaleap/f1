// database/migrations/2024_01_01_000017_create_activity_logs_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id('log_id');
            $table->foreignId('user_id')->constrained('users', 'id')->cascadeOnDelete();
            $table->string('action');
            $table->string('table_name')->nullable();
            $table->integer('record_id')->nullable();
            $table->string('description')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down(): void {
        Schema::dropIfExists('activity_logs');
    }
};
