<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointTourTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_tour', function (Blueprint $table) {
            $table->id();
            $table->foreignId('point_id')->constrained()->onDelete('cascade');
            $table->foreignId('tour_id')->constrained()->onDelete('cascade');
            $table->smallInteger('route')->unsigned();
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
        Schema::dropIfExists('point_tour');
    }
}
