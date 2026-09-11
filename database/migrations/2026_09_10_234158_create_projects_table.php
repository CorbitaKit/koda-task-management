<?php

use App\Enums\Project\ProjectPriority;
use App\Enums\Project\ProjectStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('client_name');
            $table->string('project_name');
            $table->longText('description')->nullable();
            $table->enum('status', array_column(ProjectStatus::cases(), 'value'));
            $table->enum('priority', array_column(ProjectPriority::cases(), 'value'));
            $table->date('start_date');
            $table->date('due_date');

            $table->foreignId('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
