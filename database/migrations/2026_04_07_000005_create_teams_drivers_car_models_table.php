// database/migrations/2024_01_01_000005_create_teams_drivers_car_models_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('teams', function (Blueprint $table) {
            $table->id('team_id');
            $table->string('team_name')->unique();
            $table->string('country')->nullable();
            $table->integer('founded_year')->nullable();
            $table->string('team_principal')->nullable();
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('drivers', function (Blueprint $table) {
            $table->id('driver_id');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id')->references('team_id')->on('teams')->nullOnDelete();
            $table->string('driver_name');
            $table->string('nationality')->nullable();
            $table->integer('car_number')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->integer('championships')->default(0);
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('car_models', function (Blueprint $table) {
            $table->id('car_model_id');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id')->references('team_id')->on('teams')->nullOnDelete();
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->foreign('driver_id')->references('driver_id')->on('drivers')->nullOnDelete();
            $table->string('model_name');
            $table->integer('season_year');
            $table->string('engine')->nullable();
            $table->integer('horsepower')->nullable();
            $table->decimal('top_speed', 10, 2)->nullable();
            $table->string('color')->nullable();
            $table->string('description')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down(): void {
        Schema::dropIfExists('car_models');
        Schema::dropIfExists('drivers');
        Schema::dropIfExists('teams');
    }
};
