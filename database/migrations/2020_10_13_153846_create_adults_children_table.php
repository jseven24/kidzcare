<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdultsChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('children_adults', function (Blueprint $table) {
            $table->foreignId('child_id')->index('child_id');
            $table->foreignId('adult_id')->index('adult_id');

            $table->foreign('child_id')->references('id')->on('children')->onDelete('cascade');
            $table->foreign('adult_id')->references('id')->on('adults')->onDelete('cascade');
            $table->primary(['child_id', 'adult_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('children_adults');
    }
}
