<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTouringByPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('touring_by_points', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('point_id');
            $table->foreignId('touring_by_id');
            $table->boolean('like')->default(false);
            $table->boolean('skiped')->default(false);
            $table->boolean('hasImage')->default(false);
            $table->string('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('touring_by_points');
    }
}