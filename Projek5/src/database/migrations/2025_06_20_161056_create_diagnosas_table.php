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
        Schema::create('diagnosas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appointment_id'); // Foreign Key ke appointments
            $table->unsignedBigInteger('dokter_id'); // Foreign Key ke dokters
            $table->text('keluhan')->nullable();
            $table->enum('status', ['Belum diperiksa', 'Sudah diperiksa'])->default('Belum diperiksa');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('cascade');
            $table->foreign('dokter_id')->references('id')->on('dokters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnosas');
    }
};
