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
            $table->string('priority')->default('medium')->after('due_date');
            $table->string('category', 100)->nullable()->after('priority');
            $table->string('tags')->nullable()->after('category');
            $table->unsignedInteger('estimated_minutes')->nullable()->after('tags');
            $table->timestamp('reminder_at')->nullable()->after('estimated_minutes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn([
                'priority',
                'category',
                'tags',
                'estimated_minutes',
                'reminder_at',
            ]);
        });
    }
};
