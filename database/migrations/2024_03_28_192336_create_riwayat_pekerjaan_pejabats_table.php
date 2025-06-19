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
        Schema::create('riwayat_pekerjaan_pejabats', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('pejabat_tapin_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('pekerjaan');
            $table->string('tahun_masuk');
            $table->string('tahun_keluar');
            $table->string('jabatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_pekerjaan_pejabats');
    }
};
