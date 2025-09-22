<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('motors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
            $table->string('brand');
            $table->enum('type_cc', ['100', '125', '150']);
            $table->string('plate_number')->unique();
            $table->enum('status', ['tersedia', 'disewa', 'pending_verification', 'dibatalkan'])->default('pending_verification');
            $table->string('photo_url')->nullable();
            $table->string('dokumen_kepemilikan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motors');
    }
};
