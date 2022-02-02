<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_views', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('blog_id')->index()->unsigned();
            $table->string('url');
            $table->string('session_id');
            $table->bigInteger('user_id')->nullable();
            $table->string('ip');
            $table->string('agent');
            $table->timestamps();
            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_views');
    }
}
