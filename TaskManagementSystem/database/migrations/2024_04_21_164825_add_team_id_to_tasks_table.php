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
        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            // 1. Drop foreign key constraints
            $table->dropForeign(['team_id']);
            $table->dropColumn('team_id');
        });
    }
};
