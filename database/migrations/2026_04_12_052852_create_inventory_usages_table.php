<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inventory_usages', function (Blueprint $table) {
            $table->id();

            $table->foreignId('request_id')
                ->constrained('maintenance_requests')
                ->cascadeOnDelete();

            $table->foreignId('item_id')
                ->constrained('inventory_items')
                ->cascadeOnDelete();

            $table->integer('quantity_used');

            $table->foreignId('used_by')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->timestamp('used_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_usages');
    }
};
