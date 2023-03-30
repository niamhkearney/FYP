<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->dateTime('created_at', $precision = 0);
            $table->string('message');
            $table->unsignedBigInteger('upload_id'); //id of the user who made the comment
            $table->unsignedBigInteger('user_id'); //id of the user who made the comment
            $table->unsignedBigInteger('reply_id')->nullable(); //user they're replying to

            $table->foreign('upload_id')->references('upload_id')->on('uploads');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('reply_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
