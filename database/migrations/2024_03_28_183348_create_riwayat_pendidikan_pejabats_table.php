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
        Schema::create('riwayat_pendidikan_pejabats', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('pejabat_tapin_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('sekolah');
            $table->string('tahun_masuk');
            $table->string('tahun_lulus');
            $table->string('jenis_sekolah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_pendidikan_pejabats');
    }
};
