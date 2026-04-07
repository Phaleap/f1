// database/migrations/2024_01_01_000003_create_user_addresses_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id('address_id');
            $table->foreignId('user_id')->constrained('users', 'id')->cascadeOnDelete();
            $table->string('receiver_name');
            $table->string('phone');
            $table->string('street_address');
            $table->string('city');
            $table->string('province')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country');
            $table->string('address_type')->nullable()->comment('home, office, billing, shipping');
            $table->boolean('is_default')->default(false);
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down(): void {
        Schema::dropIfExists('user_addresses');
    }
};
