<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversion_id')
                ->constrained('conversions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('name',255)->nullable();
            $table->string('encrypted_id',255)->nullable();
            $table->string('route',255)->nullable();
            $table->timestamps();
        });

        DB::statement('ALTER TABLE images ADD raw MEDIUMBLOB DEFAULT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
