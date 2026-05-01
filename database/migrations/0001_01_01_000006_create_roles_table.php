<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\UserManagement\Enums\OrganizationType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->enum('organization_type', OrganizationType::values());
            $table->ulid('organization_id')->nullable();
            $table->foreign('organization_id')->references('id')->on('organizations')->nullOnDelete();
            $table->string('name');
            $table->string('slug');
            $table->string('description');
            $table->boolean('is_system_role')->default(false);
            $table->boolean('is_editable')->default(true);
            $table->foreignUlid('created_by')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
