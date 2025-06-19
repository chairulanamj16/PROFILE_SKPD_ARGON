<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pejabat_tapins', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('nama');
            $table->string('jabatan');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('istri')->nullable();
            $table->string('agama')->nullable();
            $table->text('alamat')->nullable();
            $table->string('periode');
            $table->enum('status', ['aktif', 'tidak_aktif']);
            $table->text('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pejabat_tapins');
    }
};
