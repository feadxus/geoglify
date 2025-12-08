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
        Schema::table('permissions', function (Blueprint $table) {
            // Add code column as nullable first
            $table->string('code')->after('id')->nullable();
        });

        // Migrate existing data: copy title to code
        DB::statement('UPDATE permissions SET code = title WHERE code IS NULL');

        // Now make it NOT NULL and unique
        Schema::table('permissions', function (Blueprint $table) {
            $table->string('code')->nullable(false)->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn('code');
        });
    }
};
