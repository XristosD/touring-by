<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTouringBiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('touring_bies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('tour_id');
            $table->boolean('completed')->default(false);
            $table->integer('curent_touring_by_point')->nullable()->default(null);
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
        Schema::dropIfExists('touring_bies');
    }
}
