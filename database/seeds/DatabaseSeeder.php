<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        //Users table
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'user_role' => '1',
            'password' => md5('123456'),
            'status' => 'active',
            'created_at' => date("Y-m-d H:i:s"),
        ]);


        //Options table
        DB::table('options')->insert([
            'option_name' => 'blogname',
            'option_value' => 'BeSofty',
            'autoload' => 'yes',
        ]);
        DB::table('options')->insert([
            'option_name' => 'blogdescription',
            'option_value' => 'Software Ltd.',
            'autoload' => 'yes',
        ]);
        DB::table('options')->insert([
            'option_name' => 'template',
            'option_value' => 'default',
            'autoload' => 'yes',
        ]);
        DB::table('options')->insert([
            'option_name' => 'default_user_role',
            'option_value' => '0',
            'autoload' => 'yes',
        ]);
        DB::table('options')->insert([
            'option_name' => 'header_image',
            'option_value' => '',
            'autoload' => 'no',
        ]);

        //Posts table

        DB::table('posts')->insert([
            'post_author' => 'Ratul Hasan',
            'post_content' => '<h1>This is Home page</h1>',
            'post_title' => 'Home',
            'post_status' => 'publish',
            'comment_status' => 'close',
            'post_name' => 'home-page',
            'slug' => '',
            'is_menu_show' => 'yes',
            'menu_order' => '1',
            'post_type' => 'home',
            'created_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('posts')->insert([
            'post_author' => 'Ratul Hasan',
            'post_content' => 'This is Blog page',
            'post_title' => 'Blog',
            'post_status' => 'publish',
            'comment_status' => 'close',
            'post_name' => 'blog',
            'slug' => 'blog',
            'is_menu_show' => 'yes',
            'menu_order' => '2',
            'post_type' => 'blog',
            'created_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('posts')->insert([
            'post_author' => 'Ratul Hasan',
            'post_content' => '<h1>First blog post. You can delete this post.</h1>',
            'post_title' => 'First post',
            'post_status' => 'publish',
            'comment_status' => 'open',
            'post_name' => 'first-post',
            'slug' => 'first-post',
            'is_menu_show' => 'no',
            'menu_order' => '0',
            'post_type' => 'post',
            'post_category' => 'Unrecognized',
            'comment_count' => '1',
            'created_at' => date("Y-m-d H:i:s"),
        ]);

        //postmeta

        DB::table('postmeta')->insert([
            'post_id' => '2',
            'meta_key' => 'blog',
            'meta_value' => 'post',
        ]);

        //comments
        DB::table('comments')->insert([
            'comment_post_ID' => '3',
            'comment_author' => 'Ratul Hasan',
            'comment_author_email' => 'ratuljh@gmail.com',
            'comment_author_url' => 'https://besofty.com',
            'comment_author_IP' => '3',
            'comment_content' => 'This is first comment',
            'comment_approved' => 'approved',
            'comment_agent' => 'none',
            'created_at' => date("Y-m-d H:i:s"),
        ]);

        //categories
        DB::table('categories')->insert([
            'category_name' => 'Unrecognized',
            'category_slug' => 'unrecognized',
        ]);
    }
}
