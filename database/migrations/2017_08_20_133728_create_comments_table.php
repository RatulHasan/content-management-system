<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('comment_ID');
            $table->bigInteger('comment_post_ID');
            $table->mediumText('comment_author');
            $table->string('comment_author_email',100);
            $table->string('comment_author_url',200);
            $table->string('comment_author_IP',100);
            $table->text('comment_content');
            $table->string('comment_approved',20)->default('unapproved');
            $table->string('comment_agent',256);
            $table->string('comment_type',20)->default('comment');
            $table->bigInteger('comment_parent')->default(0);
            $table->bigInteger('user_id')->default(0);
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
        Schema::dropIfExists('comments');
    }
}
