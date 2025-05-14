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
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('roles', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('sites', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('nodes', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('branches', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('roles', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('sites', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('nodes', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('branches', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
