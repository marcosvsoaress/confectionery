<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCakesInterestListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cakes_interest_list', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cake_id');
            $table->string('email', 255)->nullable(false);
            $table->timestamps();

            $table->foreign('cake_id')->references('id')->on('cakes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cakes_interest_list');
    }
}
