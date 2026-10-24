<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('maintenance_requests', function (Blueprint $table) {
            $table->index('created_at', 'maintenance_requests_created_at_idx');
            $table->index(['status', 'created_at'], 'maintenance_requests_status_created_at_idx');
        });
    }

    public function down(): void
    {
        Schema::table('maintenance_requests', function (Blueprint $table) {
            $table->dropIndex('maintenance_requests_created_at_idx');
            $table->dropIndex('maintenance_requests_status_created_at_idx');
        });
    }
};
