<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('maintenance_requests', function (Blueprint $table) {
            $table->softDeletes();
            $table->index(['status', 'deleted_at']);
            $table->index(['location', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::table('maintenance_requests', function (Blueprint $table) {
            $table->dropIndex(['status', 'deleted_at']);
            $table->dropIndex(['location', 'created_at']);
            $table->dropSoftDeletes();
        });
    }
};
