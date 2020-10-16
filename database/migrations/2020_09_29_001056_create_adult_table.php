<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adult_roles', function (Blueprint $table) {
            $table->id()->comment('Primiry key');
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->timestamps();
        });


        Schema::create('adults', function (Blueprint $table) {
            $table->id()->comment('Primiry key');
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('phone', 25);
            $table->string('email', 50);
            $table->text('address')->nullable();

            $table->foreignId('adult_role_id')->index('adult_role_id');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('adult_role_id')->references('id')->on('adult_roles');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adult_roles');
        Schema::dropIfExists('adults');
    }
}
