<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('maintenance_requests', function (Blueprint $table) {
            $table->foreignId('assigned_to')
                ->nullable()
                ->after('user_id')
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('assigned_by')
                ->nullable()
                ->after('assigned_to')
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('assigned_at')
                ->nullable()
                ->after('assigned_by');
        });

        // Backfill the new direct assignment fields from the existing assignment history.
        DB::table('request_assignments')
            ->orderBy('assigned_at')
            ->orderBy('id')
            ->get()
            ->each(function ($assignment) {
                DB::table('maintenance_requests')
                    ->where('id', $assignment->request_id)
                    ->update([
                        'assigned_to' => $assignment->personnel_id,
                        'assigned_by' => $assignment->assigned_by,
                        'assigned_at' => $assignment->assigned_at,
                    ]);
            });
    }

    public function down(): void
    {
        Schema::table('maintenance_requests', function (Blueprint $table) {
            $table->dropForeign(['assigned_to']);
            $table->dropForeign(['assigned_by']);
            $table->dropColumn(['assigned_to', 'assigned_by', 'assigned_at']);
        });
    }
};
