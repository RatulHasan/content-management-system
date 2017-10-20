<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('post_id');
            $table->string('post_author',20);
            $table->longText('post_content')->nullable();
            $table->text('post_title')->nullable();
            $table->string('post_status',20)->default('publish');
            $table->string('comment_status',20)->default('open');
            $table->string('post_name',200)->nullable();
            $table->string('post_password',20)->nullable();
            $table->string('parent_id',10)->nullable();
            $table->string('slug',75);
            $table->string('is_menu_show',10)->default('no');
            $table->string('menu_order',11)->default('0');
            $table->string('post_type',20)->nullable();
            $table->string('post_category',200)->nullable();
            $table->string('post_tags',200)->nullable();
            $table->string('post_image',200)->nullable();
            $table->string('comment_count',20)->default('0');
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
        Schema::dropIfExists('posts');
    }
}
