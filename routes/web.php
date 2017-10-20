<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
 * Website
 */
Route::get('/','BlogController@index' );
Route::get('/{slug}','BlogController@posts' );

Route::get('/category/{post_category}','BlogController@categorySearch' );
Route::get('/tag/{post_tag}','BlogController@tagSearch' );
Route::get('/author/{author}','BlogController@getAuthorPosts' );
Route::get('/blog/search_anything','BlogController@searchAnyWhere' );
Route::post('blog/comment_post','BlogController@commentPost' );
Route::post('blog/post_password','BlogController@postPassword' );
/*
 * Website
 */
/*
 * Admin GET
 */
Route::get('/admin/login','LoginController@index' );
Route::get('/admin/active/{remember_token}','LoginController@activeUser' );
Route::get('/admin/destroy','LoginController@logout' );
Route::get('/admin/register','LoginController@register' );
Route::get('/admin/reset','LoginController@reset' );
Route::get('/admin/reset_confirm/{slug}','LoginController@resetConfirm' );
Route::get('/admin/dashboard','AdminController@dashboard');
Route::get('/admin/users','AdminController@users');
Route::get('/admin/media','AdminController@getMedia');
Route::get('/admin/media_ajax','AdminController@getMediaAjax');
Route::get('/admin/add-theme','AdminController@addTheme');
Route::get('/admin/customize','AdminController@customizeTheme');
Route::get('/admin/options','AdminController@customizeOptions');
Route::get('/admin/change_theme/{theme_name}','AdminController@changeTheme');
Route::get('/admin/posts','AdminController@posts' );
Route::get('/admin/trashPost','AdminController@trashPost' );
Route::get('/admin/trashPage','AdminController@trashPage' );
Route::get('/admin/new-post','AdminController@newPost' );
Route::get('/admin/comments','AdminController@comments' );
Route::get('/admin/approve/{id}','AdminController@approve' );
Route::get('/admin/unapprove/{id}','AdminController@unapprove' );
Route::get('/admin/trash_comment/{id}','AdminController@trashComment' );
Route::get('/admin/pages','AdminController@pages' );
Route::get('/admin/new-page','AdminController@newPage' );
Route::get('/admin/menus','AdminController@menus' );
Route::get('/admin/edit-page/{post_id}','AdminController@editPage' );
Route::get('/admin/edit-post/{post_id}','AdminController@editPost' );
Route::get('/admin/author/pages/{author}','AdminController@getAuthorPages' );
Route::get('/admin/author/posts/{author}','AdminController@getAuthorPosts' );
Route::get('/admin/delete-post/{post_id}','AdminController@actionTrash' );//FOR SINGLE Trash PAGE AND POST
Route::get('/admin/restore_post/{post_id}','AdminController@restorePost' );//FOR SINGLE RESTORE RESTORE PAGE
Route::get('/admin/delete_permanently/{post_id}','AdminController@deletePermanently' );//FOR DELETE PERMANENTLY SINGLE RESTORE PAGE
Route::get('/admin/destroy_upload/{id}','AdminController@destroyUpload' );

/*
 * Admin POST
 */

Route::post('/admin/login_check', 'LoginController@loginCheck');
Route::post('/admin/auth_register', 'LoginController@signUp');
Route::post('/admin/create_user', 'AdminController@createUser');
Route::post('/admin/request_reset', 'LoginController@requestReset');
Route::post('/admin/reset_password', 'LoginController@resetPassword');
Route::post('/admin/save_post','AdminController@savePost' );
Route::post('/admin/save_page','AdminController@savePage' );
Route::post('/admin/theme-upload','AdminController@themeUpload' );
Route::post('/admin/make_menu','AdminController@makeMenu' );
Route::post('/admin/create_tag','AdminController@makeTag' );
Route::post('/admin/create_category','AdminController@makeCategory' );
Route::post('/admin/check_slug','AdminController@checkSlug' );
Route::post('/admin/upload','AdminController@upload' );

/*
 * Admin PATCH
 */

Route::patch('/admin/edit-user', 'AdminController@editUser');
Route::patch('/admin/change_options', 'AdminController@changeOptions');
Route::patch('/admin/is_home','AdminController@makeHome' );
Route::patch('/admin/is_blog','AdminController@makeBlog' );
Route::patch('/admin/menu_re_order','AdminController@menuReOrder' );
Route::patch('/admin/custom_menu','AdminController@makeCustomMenu' );
Route::patch('/admin/update_post/{post_id}','AdminController@updatePost' );
Route::patch('/admin/bulk_action','AdminController@bulkActionDelete' );//FOR BULK Trash
Route::patch('/admin/bulk_action_delete_or_restore','AdminController@bulkActionDeleteOrRestore' );//FOR BULK DELETE RESTORE PAGE
Route::patch('/admin/restore_post','AdminController@restorePostFromMenu' );

Route::delete('/admin/delete_post','AdminController@deletePost' );
Route::get('/admin/delete_user/{id}','AdminController@deleteUser' );
/*
 * Admin Panel
 */
