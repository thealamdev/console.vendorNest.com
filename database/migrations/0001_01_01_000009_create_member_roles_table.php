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
        Schema::create('member_roles', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('organization_member_id')->constrained('organization_members');
            $table->foreignUlid('role_id')->constrained('roles');
            $table->foreignUlid('assigned_by')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_roles');
    }
};
