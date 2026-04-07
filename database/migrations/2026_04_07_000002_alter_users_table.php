// database/migrations/2024_01_01_000002_alter_users_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->nullable()->after('id');
            $table->foreign('role_id')->references('role_id')->on('roles')->nullOnDelete();
            $table->renameColumn('name', 'full_name');
            $table->string('phone')->nullable()->after('email');
            $table->string('gender')->nullable()->after('phone');
            $table->date('date_of_birth')->nullable()->after('gender');
            $table->string('status')->default('active')->after('date_of_birth');
        });
    }

    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn(['role_id', 'phone', 'gender', 'date_of_birth', 'status']);
            $table->renameColumn('full_name', 'name');
        });
    }
};
