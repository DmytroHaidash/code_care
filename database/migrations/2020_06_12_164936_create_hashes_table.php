<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hashes', function (Blueprint $table) {
            $table->id();
            $table->string('algorithm');
            $table->string('hash');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('vocabulary_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('vocabulary_id')->references('id')->on('vocabularies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hashes');
    }
}
