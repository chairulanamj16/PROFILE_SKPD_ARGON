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
        Schema::create('ppids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('office_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('ppid_category_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('uuid')->unique();
            $table->string('title');
            $table->string('terbitkan_sebagai');
            $table->string('jenis');
            $table->string('type_file')->default('text');
            $table->text('file');
            $table->enum('status', ['publikasi', 'rahasia'])->default('publikasi');
            $table->enum('status_file', ['ajukan', 'terima', 'tolak'])->default('ajukan');
            $table->integer('didownload')->default(0);
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
        Schema::dropIfExists('ppids');
    }
};
