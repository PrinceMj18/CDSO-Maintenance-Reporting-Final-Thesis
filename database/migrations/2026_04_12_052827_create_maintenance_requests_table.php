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
        Schema::create('maintenance_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            $table->string('title');
            $table->text('description');
            $table->string('location');
            $table->string('category');

            $table->enum('status', [
                'pending',
                'approved',
                'in_progress',
                'completed',
                'rejected'
            ])->default('pending');

            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_requests');
    }
};
