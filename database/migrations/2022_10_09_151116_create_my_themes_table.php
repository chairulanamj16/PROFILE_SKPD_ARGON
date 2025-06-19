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
        Schema::create('my_themes', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('theme_gallery_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('office_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('is_active')->default(0);
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
        Schema::dropIfExists('my_themes');
    }
};
