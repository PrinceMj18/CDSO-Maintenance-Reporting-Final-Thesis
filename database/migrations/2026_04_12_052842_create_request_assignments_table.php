<?php

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
        Schema::create('request_assignments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('request_id')
                ->constrained('maintenance_requests')
                ->cascadeOnDelete();

            $table->foreignId('personnel_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('assigned_by')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('assigned_to')->nullable()->constrained('users');

            $table->timestamp('assigned_at')->useCurrent();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_assignments');
    }
};
