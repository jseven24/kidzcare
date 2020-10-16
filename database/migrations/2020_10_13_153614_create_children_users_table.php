<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildrenUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('children_users', function (Blueprint $table) {
            $table->foreignId('user_id')->index('user_id');
            $table->foreignId('child_id')->index('child_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');;
            $table->foreign('child_id')->references('id')->on('children')->onDelete('cascade');;
            $table->primary(['user_id', 'child_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('children_users');
    }
}
