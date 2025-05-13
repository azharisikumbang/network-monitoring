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
        Schema::create('nodes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->index();
            $table->ipAddress()->index();
            $table->ipAddress('network_address')->nullable();
            $table->string('type');
            $table->text('description')->nullable();
            $table->unsignedInteger('config_snmp_port')->default(161);
            $table->string('config_snmp_version')->default('SNMPv2c');
            $table->string('config_snmp_key')->nullable();
            $table->unsignedInteger('config_ssh_port')->default(22);
            $table->text('config_ssh_public_key')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignUuid('site_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nodes');
    }
};
