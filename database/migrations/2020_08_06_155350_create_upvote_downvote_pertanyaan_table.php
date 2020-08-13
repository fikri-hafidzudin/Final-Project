<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpvoteDownvotePertanyaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upvote_downvote_pertanyaan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pertanyaan_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('poin');
            $table->foreign('pertanyaan_id')->references('id')->on('pertanyaan');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('upvote_downvote_pertanyaan');
    }
}
