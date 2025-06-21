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
        Schema::table('appointments', function (Blueprint $table) {
        $table->unsignedBigInteger('dokter_id')->nullable()->after('id');

        // Jika ingin relasi database juga:
        $table->foreign('dokter_id')->references('id')->on('dokters')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
        $table->dropForeign(['dokter_id']);
        $table->dropColumn('dokter_id');
        });
    }
};
