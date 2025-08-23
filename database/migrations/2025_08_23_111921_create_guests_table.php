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
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name', 255);
            $table->string('phone', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->text('address')->nullable();
            $table->string('id_proof_type', 255)->nullable();
            $table->string('id_proof_number', 255)->nullable();
            $table->string('id_proof_image', 255)->nullable();
            $table->string('emergency_contact_name', 255)->nullable();
            $table->string('emergency_contact_phone', 255)->nullable();
            $table->text('special_requests')->nullable();
            $table->softDeletes();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
