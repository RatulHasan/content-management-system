<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use ZipArchive;
use App\Mail\Registration;

session_start();

class AdminController extends Controller
{

    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->middleware('usersession');

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard()
    {
        return view('admin.pages.main_content');
    }

    /**
     * @return $this
     */
    public function users()
    {
        $all_users = DB::table('users')->orderby('id','DESC')->simplePaginate(20);
        $main_content = view('admin.all_contents.all_users')->with('all_users',$all_users);
        $cdata = ['main_content'=>$main_content];
        return view('admin.master')->with($cdata);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function createUser(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);
        $data = request()->all();
        unset($data['_token']);
        unset($data['password_confirmation']);
        $data['password'] = md5($data['password']);
        $data['remember_token'] = md5(md5($request->email).'b1a652f7');

        if (DB::table('users')->insert($data)) {
            // SEND MAIL
            \Mail::send(new Registration());
            // SEND MAIL

            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', '<strong>Well done!</strong> confirmation email sent.
            <script>
                $(".alert1-success").delay(350).addClass("in").fadeOut(4000);
            </script>');
            return Redirect::back();

            return Redirect::back();
        } else {
            $request->session()->flash('message.content', '<span class="text-danger"><strong>Sorry!</strong> Error occurred.</span> ');

            return Redirect::back();
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function editUser(Request $request)
    {
        $data = request()->all();
        $this->validate($request,[
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$data['id'],
            'password' => 'required|min:6|confirmed',
        ]);
        unset($data['_token']);
        unset($data['_method']);
        unset($data['password_confirmation']);
        $data['password'] = md5($data['password']);

        if (DB::table('users')->where('id',$data['id'])->update($data)) {

            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', '<strong>Well done!</strong> confirmation email sent.
            <script>
                $(".alert1-success").delay(350).addClass("in").fadeOut(4000);
            </script>');
        } else {
            $request->session()->flash('message.content', '<span class="text-danger"><strong>Sorry!</strong> Error occurred.</span> ');

        }

        return Redirect::back();
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function deleteUser(Request $request, $id)
    {

        if (DB::table('users')->where('id',$id)->delete()) {

            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', '<strong>Well done!</strong> User deleted!.
            <script>
                $(".alert1-success").delay(350).addClass("in").fadeOut(4000);
            </script>');
        } else {
            $request->session()->flash('message.content', '<span class="text-danger"><strong>Sorry!</strong> Error occurred.</span> ');

        }

        return Redirect::back();
    }

    /**
     * @return $this
     */
    public function getMedia()
    {
        $all_media = DB::table('posts')->where('post_image','!=', Null)->where('post_image','!=', '')->orderBy("created_at","desc")->get();

        $main_content = view('admin.all_contents.media_library')->with('all_media',$all_media);
        $cdata = ['main_content'=>$main_content];

        return view('admin.master')->with($cdata);
    }

    /**
     * @param Request $request
     */
    public function getMediaAjax(Request $request)
    {
        $all_media = DB::table('posts')->where('post_image','!=', Null)->where('post_image','!=', '')->orderBy("post_id","desc")->get();
        foreach ($all_media as $media){
            $url=\URL::to("public/$media->post_image");
                        echo "<img
                                data-toggle=\"modal\"
                                data-target=\"#media\"
                                data-id=\"{{ $media->post_id }}\"
                                data-photo=\"$url\"
                                data-src=\"$media->post_image\"
                                src=\"$url\"
                                class=\"img-thumbnail img-responsive photo\"
                                alt=\"$media->post_title\"
                          />";

                }
    }

    /**
     * @return $this
     */
    public function posts()
    {
        $all_trash = DB::table('posts')->where('post_type', 'post')->where('post_status', 'trash')->get();
        $all_posts = DB::table('posts')->where('post_type', 'post')->where('post_status', 'publish')->orderby('post_id','DESC')->simplePaginate(20);
        $main_content = view('admin.all_contents.all_posts')->with('all_posts',$all_posts)->with('all_trash',$all_trash);
        $cdata = ['main_content'=>$main_content];
        return view('admin.master')
            ->with($cdata);
    }

    /**
     * @return $this
     */
    public function comments()
    {
        $all_trash = DB::table('comments')->where('comment_approved' ,'trash')->get();
        $all_comments = DB::table('comments')
            ->join('posts','posts.post_id','=','comments.comment_post_ID')
            ->where('comments.comment_approved','!=' ,'trash')
            ->orderBy('comments.comment_ID','DESC')
            ->simplePaginate(20);
        $main_content = view('admin.all_contents.all_comments')->with('all_comments',$all_comments)->with('all_trash',$all_trash);
        $cdata = ['main_content'=>$main_content];
        return view('admin.master')
            ->with($cdata);
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function approve(Request $request, $id)
    {
        $data['comment_approved'] = 'approved';
        if (DB::table('comments')->where('comment_ID',$id)->update($data)) {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', '<strong>Well done!</strong> Task successfully done.
            <script>
                $(".alert1-success").delay(350).addClass("in").fadeOut(4000);
            </script>');
        } else {
            $request->session()->flash('message.content', '<strong>Sorry!</strong> ERROR occurred.
            <script>
                $(".alert1-danger").delay(350).addClass("in").fadeOut(4000);
            </script>');
        }

        return Redirect::back();
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function unapprove(Request $request, $id)
    {
        $data['comment_approved'] = 'unapproved';
        if (DB::table('comments')->where('comment_ID',$id)->update($data)) {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', '<strong>Well done!</strong> Task successfully done.
            <script>
                $(".alert1-success").delay(350).addClass("in").fadeOut(4000);
            </script>');
        } else {
            $request->session()->flash('message.content', '<strong>Sorry!</strong> ERROR occurred.
            <script>
                $(".alert1-danger").delay(350).addClass("in").fadeOut(4000);
            </script>');
        }

        return Redirect::back();
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function trashComment(Request $request, $id)
    {
        if (DB::table('comments')->where('comment_ID',$id)->delete()) {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', '<strong>Well done!</strong> Task successfully done.
            <script>
                $(".alert1-success").delay(350).addClass("in").fadeOut(4000);
            </script>');
        } else {
            $request->session()->flash('message.content', '<strong>Sorry!</strong> ERROR occurred.
            <script>
                $(".alert1-danger").delay(350).addClass("in").fadeOut(4000);
            </script>');
        }

        return Redirect::back();
    }

    /**
     * @return $this
     */
    public function trashPost()
    {
        $all_trash = DB::table('posts')->where('post_type', 'post')->where('post_status', 'publish')->get();
        $all_posts = DB::table('posts')->where('post_type', 'post')->where('post_status', 'trash')->simplePaginate(20);
        $main_content = view('admin.all_contents.trash_posts')->with('all_posts',$all_posts)->with('all_trash',$all_trash);
        $cdata = ['main_content'=>$main_content];
        return view('admin.master')
            ->with($cdata);
    }

    /**
     * @return $this
     */
    public function newPost()
    {
        $all_tags = DB::table('tags')->get();
        $all_categories = DB::table('categories')->get();
        $main_content = view('admin.all_contents.new_post')
            ->with('all_tags',$all_tags)
            ->with('all_categories',$all_categories);
        $cdata = ['main_content'=>$main_content];

        return view('admin.master')
            ->with($cdata);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function savePost(Request $request)
    {
        $this->validate($request, [
            'post_title' => 'required|max:255',
            'post_content' => 'required',
        ]);
        $data = request()->all();
        if(!empty($data['post_tags'])) {
            $data['post_tags'] = serialize ($data['post_tags']);
        }
        unset($data['_token']);
        unset($data['category_name']);
        unset($data['tag_id']);
        unset($data['tag_name']);

        $post['author_name'] = $request->session()->get('user.name');
        $data['post_author'] = $post['author_name'];
        $data['post_name'] = request()->input('slug');
        $data['slug'] = str_slug(request()->input('slug'));

        $slug= $data['slug'];
        $slugs = DB::table('posts')->where('slug', $slug)->get();
        $count_slugs = count($slugs);
        if($count_slugs>0){
            $data['slug'] = $slug."-".($count_slugs+1);
        }else{
            $data['slug'] = $slug;
        }

        $data['post_content'] = request()->input('post_content');
        $data['post_type'] = "post";
        if (DB::table('posts')->insert($data)) {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', '<strong>Well done!</strong> Task successfully done.
            <script>
                $(".alert1-success").delay(350).addClass("in").fadeOut(4000);
            </script>');
        } else {
            $request->session()->flash('message.content', '<strong>Sorry!</strong> ERROR occurred.
            <script>
                $(".alert1-danger").delay(350).addClass("in").fadeOut(4000);
            </script>');
        }

        return redirect('/admin/new-post');
    }

    /**
     * @param $post_id
     * @return $this
     */
    public function editPage($post_id)
    {
        $all_post = DB::table('posts')->where('post_type','!=', 'post')->where('post_status', 'publish')->get();
        $posts = DB::table('posts')->where('post_id',$post_id)->where('post_status', 'publish')->first();
        $all_categories = DB::table('categories')->get();
        $main_content = view('admin.all_contents.edit_page')
            ->with('all_categories',$all_categories)
            ->with(['all_post'=>$all_post,'posts'=>$posts]);
        $cdata = ['main_content'=>$main_content];

        return view('admin.master')
            ->with($cdata);
    }

    /**
     * @param $post_id
     * @return $this
     */
    public function editPost($post_id)
    {
        $all_post = DB::table('posts')->where('post_id',$post_id)->where('post_status', 'publish')->first();
        $all_tags = DB::table('tags')->get();
        $all_categories = DB::table('categories')->get();
        $main_content = view('admin.all_contents.edit_post')
            ->with('all_tags',$all_tags)
            ->with('all_categories',$all_categories)
            ->with('all_post',$all_post);
        $cdata = ['main_content'=>$main_content];

        return view('admin.master')
            ->with($cdata);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function bulkActionDelete(Request $request)
    {
        $data=$request->input('post_id');
        $datas['post_status'] = "trash";
        $action=false;
        foreach($data as $post_id){
            if (DB::table('posts')->where('post_id', $post_id)->update($datas)) {
                $action = true;
            }
        }
        if ($action = true) {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', '<strong>Well done!</strong> Task successfully done.
            <script>
                $(".alert1-success").delay(350).addClass("in").fadeOut(4000);
            </script>');
        } else {
            $request->session()->flash('message.content', '<strong>Sorry!</strong> ERROR occurred.
            <script>
                $(".alert1-danger").delay(350).addClass("in").fadeOut(4000);
            </script>');
        }

        return Redirect::back();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function bulkActionDeleteOrRestore(Request $request)
    {
        $data=$request->input('post_id');
        $action=$request->input('action');
        if($action=='restore'){
            $action = false;
            $datas['post_status'] = "publish";
            foreach($data as $post_id){
                if (DB::table('posts')->where('post_id', $post_id)->update($datas)) {
                    $action = true;
                }
            }
            if ($action = true) {
                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', '<strong>Well done!</strong> Task successfully done.
                <script>
                    $(".alert1-success").delay(350).addClass("in").fadeOut(4000);
                </script>');
            } else {
                $request->session()->flash('message.content', '<strong>Sorry!</strong> ERROR occurred.
                <script>
                    $(".alert1-danger").delay(350).addClass("in").fadeOut(4000);
                </script>');
            }
            return Redirect::back();
        }else if($action=='delete'){
            $action = false;
            foreach($data as $post_id){
                if (DB::table('posts')->where('post_id', $post_id)->delete()) {
                    $action = true;
                }
            }
            if ($action = true) {
                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', '<strong>Well done!</strong> Task successfully done.
                <script>
                    $(".alert1-success").delay(350).addClass("in").fadeOut(4000);
                </script>');
            } else {
                $request->session()->flash('message.content', '<strong>Sorry!</strong> ERROR occurred.
                <script>
                    $(".alert1-danger").delay(350).addClass("in").fadeOut(4000);
                </script>');
            }

            return Redirect::back();
        }

    }

    /**
     * @param Request $request
     * @param $post_id
     * @return mixed
     */
    public function actionTrash(Request $request, $post_id)
    {
        $data['post_status'] = "trash";
        if (DB::table('posts')->where('post_id', $post_id)->update($data)) {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', '<strong>Well done!</strong> Task successfully done.
            <script>
                $(".alert1-success").delay(350).addClass("in").fadeOut(4000);
            </script>');
        } else {
            $request->session()->flash('message.content', '<strong>Sorry!</strong> ERROR occurred.
            <script>
                $(".alert1-danger").delay(350).addClass("in").fadeOut(4000);
            </script>');
        }

        return Redirect::back();
    }

    /**
     * @param Request $request
     * @param $post_id
     * @return Redirect
     */
    public function deletePermanently(Request $request, $post_id)
    {
        if (DB::table('posts')->where('post_id', $post_id)->delete()) {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', '<strong>Well done!</strong> Task successfully done.
            <script>
                $(".alert1-success").delay(350).addClass("in").fadeOut(4000);
            </script>');
        } else {
            $request->session()->flash('message.content', '<strong>Sorry!</strong> ERROR occurred.
            <script>
                $(".alert1-danger").delay(350).addClass("in").fadeOut(4000);
            </script>');
        }
        return redirect('/admin/trashPost');
    }

    /**
     * @param Request $request
     * @param $post_id
     * @return mixed
     */
    public function restorePost(Request $request, $post_id)
    {
        $data['post_status'] = "publish";
        if (DB::table('posts')->where('post_id', $post_id)->update($data)) {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', '<strong>Well done!</strong> Task successfully done.
            <script>
                $(".alert1-success").delay(350).addClass("in").fadeOut(4000);
            </script>');
        } else {
            $request->session()->flash('message.content', '<strong>Sorry!</strong> ERROR occurred.
            <script>
                $(".alert1-danger").delay(350).addClass("in").fadeOut(4000);
            </script>');
        }

        return Redirect::back();
    }

    /**
     * @param Request $request
     * @param $post_id
     * @return mixed
     */
    public function updatePost(Request $request, $post_id){
        $data=$request->all();
        if(!empty($data['post_tags'])) {
            $data['post_tags'] = serialize ($data['post_tags']);
        }
        unset($data['_token']);
        unset($data['_method']);
        unset($data['slug']);
        unset($data['category_name']);
        unset($data['tag_name']);
        //dd($data);
        if (DB::table('posts')->where('post_id', $post_id)->update($data)) {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', '<strong>Well done!</strong> Task successfully done.
            <script>
                $(".alert1-success").delay(350).addClass("in").fadeOut(4000);
            </script>');
        } else {
            $request->session()->flash('message.content', '<strong>Sorry!</strong> ERROR occurred.
            <script>
                $(".alert1-danger").delay(350).addClass("in").fadeOut(4000);
            </script>');
        }

        return Redirect::back();
    }

    /**
     * @return $this
     */
    public function pages()
    {
        $all_trash = DB::table('posts')->where('post_type','!=', 'post')->where('post_type','!=', 'image')->where('post_status', 'trash')->get();
        $all_posts = DB::table('posts')->where('post_type','!=', 'post')->where('post_type','!=', 'image')->where('post_status', 'publish')->orderby('post_id','DESC')->simplePaginate(20);
        $main_content = view('admin.all_contents.all_pages')->with(['all_posts'=>$all_posts,'all_trash'=>$all_trash]);
        $cdata = ['main_content'=>$main_content];

        return view('admin.master')
            ->with($cdata);
    }

    /**
     * @param $author
     * @return $this
     */
    public function getAuthorPages($author)
    {
        $all_trash = DB::table('posts')->where('post_type','!=', 'post')->where('post_status', 'trash')->get();
        $all_posts = DB::table('posts')->where('post_author', $author)->where('post_type','!=', 'post')->where('post_status', 'publish')->simplePaginate(20);
        $main_content = view('admin.all_contents.all_pages')->with(['all_posts'=>$all_posts,'all_trash'=>$all_trash]);
        $cdata = ['main_content'=>$main_content];
        return view('admin.master')
            ->with($cdata);
    }

    /**
     * @param $author
     * @return $this
     */
    public function getAuthorPosts($author)
    {
        $all_trash = DB::table('posts')->where('post_type', 'post')->where('post_status', 'trash')->get();
        $all_posts = DB::table('posts')->where('post_author', $author)->where('post_type', 'post')->where('post_status', 'publish')->simplePaginate(20);
        $main_content = view('admin.all_contents.all_posts')->with('all_posts',$all_posts)->with('all_trash',$all_trash);
        $cdata = ['main_content'=>$main_content];

        return view('admin.master')
            ->with($cdata);
    }

    /**
     * @return $this
     */
    public function trashPage()
    {
        $all_trash = DB::table('posts')->where('post_type','!=', 'post')->where('post_status', 'publish')->get();
        $all_posts = DB::table('posts')->where('post_type','!=', 'post')->where('post_status', 'trash')->simplePaginate(20);
        $main_content = view('admin.all_contents.trash_pages')->with('all_posts',$all_posts)->with('all_trash',$all_trash);
        $cdata = ['main_content'=>$main_content];

        return view('admin.master')
            ->with($cdata);
    }

    /**
     * @return $this
     */
    public function newPage()
    {
        $pages = DB::table('posts')->where('post_type','!=','post')->where('post_type','!=','page')->where('post_status', 'publish')->get();
        $main_content = view('admin.all_contents.new_page')->with('pages',$pages);
        $cdata = ['main_content'=>$main_content];

        return view('admin.master')
            ->with($cdata);
    }

    /**
     * @return $this
     */
    public function menus()
    {
        $pages = DB::table('posts')->where('post_status', 'publish')->where('post_type','!=', 'post')->orderby('menu_order','asc')->get();
        $child_menu = DB::table('posts')->where('post_status', 'publish')->where('parent_id','!=', 'NULL')->orWhere('parent_id','!=', '0')->orderby('menu_order','asc')->get();
        //dd($pages);
        $main_content = view('admin.all_contents.create_menu_page')->with(['pages'=>$pages,'child_menu'=>$child_menu]);
        $cdata = ['main_content'=>$main_content];

        return view('admin.master')
            ->with($cdata);
    }

    /**
     * @param Request $request
     * @return array|string
     */
    public function checkSlug(Request $request)
    {
        $slug= $request->input('slug');
        $slugs = DB::table('posts')->where('slug', $slug)->get();
        $count_slugs = count($slugs);
        if($count_slugs>0){
            $return_slug=$slug."-".($count_slugs+1);
        }else{
            $return_slug=$slug;
        }
        return $return_slug;
    }

    /**
     * @param Request $request
     * @return Redirect
     */
    public function savePage(Request $request)
    {
        $this->validate($request, [
            'post_title' => 'required|max:255',
            'post_content' => 'required',
        ]);
        $data = request()->all();
        $data['post_author'] = $request->session()->get('user.id');
        $data['comment_status'] = "closed";
        $data['post_name'] = request()->input('slug');
        $data['slug'] = /*$request->root()."/".*/str_slug(request()->input('slug'));

        $slug= $data['slug'];
        $slugs = DB::table('posts')->where('slug', $slug)->get();
        $count_slugs = count($slugs);
        if($count_slugs>0){
            $data['slug'] = $slug."-".($count_slugs+1);
        }else{
            $data['slug'] = $slug;
        }

        if(empty($data['slug'])){
            $data['slug'] = "/";
        }

        $data['post_content'] = (request()->input('post_content'));
        $data['post_type'] = "page";
        unset($data['_token']);
        if (DB::table('posts')->insert($data)) {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', '<strong>Well done!</strong> Task successfully done.
            <script>
                $(".alert1-success").delay(350).addClass("in").fadeOut(4000);
            </script>');
        } else {
            $request->session()->flash('message.content', '<strong>Sorry!</strong> ERROR occurred.
            <script>
                $(".alert1-danger").delay(350).addClass("in").fadeOut(4000);
            </script>');
        }

        return redirect('/admin/new-page');
    }

    /**
     * @param Request $request
     * @return Redirect
     */
    public function makeHome(Request $request){
        $pre_data['post_type'] = 'nav_menu_item';
        $post_id=request()->input('post_id');
        $data['post_type'] = 'home';
        $pages = DB::table('posts')->where('post_type','home')->where('post_status', 'publish')->get();
        $pre_slugs = DB::table('posts')->where('post_id',$post_id)->get();

        foreach($pre_slugs as $pre_slug){
            $pre_data['slug'] = $pre_slug->slug;
        }
        $count = count($pages);
        if($count>0){
            foreach($pages as $page){
                //dd($pre_data);
                DB::table('posts')->where('post_id', $page->post_id)->update($pre_data);
            }
        }
        $data['slug'] = '';
        if (DB::table('posts')->where('post_id', $post_id)->update($data)) {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', '<strong>Well done!</strong> Task successfully done.
            <script>
                $(".alert1-success").delay(350).addClass("in").fadeOut(4000);
            </script>');
        } else {
            $request->session()->flash('message.content', '<strong>Sorry!</strong> ERROR occurred.
            <script>
                $(".alert1-danger").delay(350).addClass("in").fadeOut(4000);
            </script>');
        }
        return redirect('/admin/menus');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function menuReOrder(Request $request){
        $data=$request->input('output');
        $i=1;
        $req=false;

        $data=json_decode($data,true);
        DB::table ('posts')->update (['parent_id' => NULL]);
        foreach($data as $post_id){

            $menu['menu_order'] = $i;

            if(!empty($post_id['children'])) {
                $c_menu['parent_id'] = $post_id['id'];
                $children=$post_id['children'];
                $c=1;
                $update_parent_id=1;
                if($update_parent_id==1) {
                    DB::table('posts')->where('post_id', $c_menu['parent_id'])->update(['parent_id'=>'sub-menu','menu_order'=>$menu['menu_order']]);
                    $update_parent_id=2;
                }
                foreach($children as $child) {
                    $c_menu['menu_order'] = $c_menu['parent_id'].".".$c;
                    $post_id=$child['id'];
                    DB::table('posts')->where('post_id', $post_id)->update($c_menu);
                    $c++;
                }
                $req = true;
            }else{

                DB::table('posts')->where('post_id', $post_id['id'])->update($menu);
                $req=true;
            }
            $i++;
        }
        if ($req=true){
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', '<strong>Well done!</strong> Task successfully done.
            <script>
                $(".alert1-success").delay(350).addClass("in").fadeOut(4000);
            </script>');
        } else {
            $request->session()->flash('message.content', '<strong>Sorry!</strong> ERROR occurred.
            <script>
                $(".alert1-danger").delay(350).addClass("in").fadeOut(4000);
            </script>');
        }

        return Redirect::back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function makeBlog(Request $request){
        $pre_data['post_type'] = 'nav_menu_item';
        $post_id=request()->input('post_id');
        $data['post_type'] = 'blog';
        $pages = DB::table('posts')->where('post_type','blog')->where('post_status', 'publish')->get();
        $pre_slugs = DB::table('posts')->where('post_id',$post_id)->first();
        $meta['post_id'] = $pre_slugs->post_id;
        DB::table('postmeta')->where('meta_key',$data['post_type'])->update($meta);

            $pre_data['slug'] = $pre_slugs->slug;
        $count = count($pages);
        if($count>0){
            foreach($pages as $page){
                //dd($pre_data);
                DB::table('posts')->where('post_id', $page->post_id)->update($pre_data);
            }
        }
        $data['slug'] = 'blog';
        if (DB::table('posts')->where('post_id', $post_id)->update($data)) {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', `<strong>Well done!</strong> Task successfully done.
            <script>
                $(".alert1-success").delay(350).addClass("in").fadeOut(4000);
            </script>`);
        } else {
            $request->session()->flash('message.content', `<strong>Sorry!</strong> ERROR occurred.
            <script>
                $(".alert1-danger").delay(350).addClass("in").fadeOut(4000);
            </script>`);
        }

        return redirect('/admin/menus');

    }

    /**
     * @param Request $request
     */
    public function makeCategory(Request $request){

        $data['category_name'] = $request->input('category_name');
        $data['category_slug'] = str_slug($data['category_name']);
        $c_category = DB::table('categories')->where('category_name', $data['category_name'])->get();
        $count = count($c_category);
        if($count<1) {
            if (DB::table('categories')->insert($data)) {
                $all_categories = DB::table('categories')->get();
                foreach ($all_categories as $all_category) {
                    echo "<option value=\"$all_category->category_id\">$all_category->category_name</option>";
                }
            } else {
                $all_categories = DB::table('categories')->get();
                foreach ($all_categories as $all_category) {
                    echo "<option value=\"$all_category->category_id\">$all_category->category_name</option>";
                }
            }
        }else{
            $all_categories = DB::table('categories')->get();
            foreach ($all_categories as $all_category) {
                echo "<option value=\"$all_category->category_id\">$all_category->category_name</option>";
            }
        }
    }

    /**
     * @param Request $request
     */
    public function makeTag(Request $request){

        $data['tag_name'] = $request->input('tag_name');
        $data['tag_slug'] = str_slug($data['tag_name']);
        $c_tag = DB::table('tags')->where('tag_name', $data['tag_name'])->get();
        $count = count($c_tag);
        if($count<1) {
            if (DB::table('tags')->insert($data)) {
                $all_tags = DB::table('tags')->get();
                foreach ($all_tags as $all_tag) {
                    echo "<option value=\"$all_tag->tag_id\">$all_tag->tag_name</option>";
                }
            } else {
                $all_tags = DB::table('tags')->get();
                foreach ($all_tags as $all_tag) {
                    echo "<option value=\"$all_tag->tag_id\">$all_tag->tag_name</option>";
                }
            }
        }else{
            $all_tags = DB::table('tags')->get();
            foreach ($all_tags as $all_tag) {
                echo "<option value=\"$all_tag->tag_id\">$all_tag->tag_name</option>";
            }
        }
    }

    /**
     * @param Request $request
     * @return Redirect
     */
    public function makeCustomMenu(Request $request){

        $slug=str_replace($request->root().'/',"",$request->input('slug'));
        $slug_data['is_menu_show'] = 'yes';
        $slug_data['post_type'] = 'nav_menu_item';
        $all_slug = DB::table('posts')->where('slug',$slug)->get();
        $count = count($all_slug);
        if($count>0){
            if (DB::table('posts')->where('slug', $slug)->update($slug_data)){
                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', '<strong>Well done!</strong> Task successfully done.
                <script>
                    $(".alert1-success").delay(350).addClass("in").fadeOut(4000);
                </script>');
            } else {
                $request->session()->flash('message.content', '<strong>Sorry!</strong> ERROR occurred.
                <script>
                    $(".alert1-danger").delay(350).addClass("in").fadeOut(4000);
                </script>');
            }
        }else{
            $slug_data['post_author'] = $request->session()->get('user.id');
            $slug_data['slug'] = $request->input('slug');
            $slug_data['post_title'] = ucfirst($request->input('post_title'));
            $slug_data['post_name'] = strtolower($request->input('post_title'));
            $slug_data['post_status'] = 'publish';
            $slug_data['comment_status'] = 'closed';
            if (DB::table('posts')->insert($slug_data)){
                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', '<strong>Well done!</strong> Task successfully done.
                <script>
                    $(".alert1-success").delay(350).addClass("in").fadeOut(4000);
                </script>');
            } else {
                $request->session()->flash('message.content', '<strong>Sorry!</strong> ERROR occurred.
                <script>
                    $(".alert1-danger").delay(350).addClass("in").fadeOut(4000);
                </script>');
            }
        }
        return redirect('/admin/menus');
    }

    /**
     * @param Request $request
     * @return Redirect
     */
    public function makeMenu(Request $request)
    {
        $ids=$request->all();
        $data['is_menu_show'] = 'yes';
        $data['post_type'] = 'nav_menu_item';
        unset($ids['_token']);
        $all_manu = DB::table('posts')->where('menu_order','!=', 0)->get();
        $req=false;
        $total_menu = count($all_manu);
        $i=1;
        foreach($ids as $id=>$value){
            $get_post_content = DB::table('posts')->where('post_id', $id)->first();
            $data['comment_status'] = 'close';
            $data['menu_order'] = $total_menu+$i;
            $check_pre_item = DB::table('posts')->where('post_type', 'nav_menu_item')->where('post_name', $get_post_content->post_name)->first();
            if(count($check_pre_item)<1) {
                $data['menu_order'] = $total_menu + $i;
                if (DB::table('posts')->where('post_id', $id)->update($data)) {
                    $req = true;
                    $i++;
                }
            }
        }
        if ($req=true){
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', '<strong>Well done!</strong> Task successfully done.
            <script>
                $(".alert1-success").delay(350).addClass("in").fadeOut(4000);
            </script>');
        } else {
            $request->session()->flash('message.content', '<strong>Sorry!</strong> ERROR occurred.
            <script>
                $(".alert1-danger").delay(350).addClass("in").fadeOut(4000);
            </script>');
        }
        return redirect('/admin/menus');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function restorePostFromMenu(Request $request){
        $post_id = $request->input('post_id');
        $data['post_type'] = $request->input('restore');
        $data['is_menu_show'] = 'no';
        $data['menu_order'] = '0';
        if (DB::table('posts')->where('post_id', $post_id)->update($data)){
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', '<strong>Well done!</strong> Task successfully done.
            <script>
                $(".alert1-success").delay(350).addClass("in").fadeOut(4000);
            </script>');
        } else {
            $request->session()->flash('message.content', '<strong>Sorry!</strong> ERROR occurred.
            <script>
                $(".alert1-danger").delay(350).addClass("in").fadeOut(4000);
            </script>');
        }

        return Redirect::back();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function deletePost(Request $request){
        $post_id=$request->input('post_id');
        $data['post_type'] = 'page';
        $data['post_status'] = 'trash';
        $data['is_menu_show'] = 'no';
        $data['menu_order'] = '0';
        if (DB::table('posts')->where('post_id', $post_id)->update($data)){
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', '<strong>Well done!</strong> Task successfully done.
            <script>
                $(".alert1-success").delay(350).addClass("in").fadeOut(4000);
            </script>');
        } else {
            $request->session()->flash('message.content', '<strong>Sorry!</strong> ERROR occurred.
            <script>
                $(".alert1-danger").delay(350).addClass("in").fadeOut(4000);
            </script>');
        }

        return Redirect::back();
    }

    /**
     * @return $this
     */
    public function customizeTheme(){
        $all_option = DB::table('options')->where('option_name','template')->first();
        $template=$all_option->option_value;
        $main_content = view('admin.all_contents.custom_theme')->with('template',$template);
        $cdata = ['main_content'=>$main_content];
        return view('admin.master')->with($cdata);
    }

    /**
     * @return $this
     */
    public function addTheme(){
        $main_content = view('admin.all_contents.add_theme');
        $cdata = ['main_content'=>$main_content];
        return view('admin.master')->with($cdata);
    }

    /**
     * @param Request $request
     * @return Redirect
     */
    public function themeUpload(Request $request){
        $this->validate($request, [
            'zip' => 'mimes:zip|max:20000'
        ]);
        $zip = new ZipArchive;
        $zip_file_path=$request->file('zip')->getPathName();
        $res = $zip->open($zip_file_path);
        if ($res === TRUE) {
            $zip->extractTo(base_path("/resources/views/blog/"));
            $zip->close();
                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', '<strong>Well done!</strong> Task successfully done.
            <script>
                $(".alert1-success").delay(350).addClass("in").fadeOut(4000);
            </script>');
            return redirect("admin/customize");
        } else {
            $request->session()->flash('message.content', '<strong>Sorry!</strong> ERROR occurred.
            <script>
                $(".alert1-danger").delay(350).addClass("in").fadeOut(4000);
            </script>');
            return redirect("admin/customize");
        }
    }

    /**
     * @return $this
     */
    public function customizeOptions(){
        $all_options = DB::table('options')->get();
        $header_image = '';
        foreach($all_options as $all_option){
            if($all_option->option_name==='header_image' && $all_option->autoload==='yes') {
                $header_image = $all_option->option_value;
            }
        }
        $main_content = view('admin.all_contents.custom_options')->with('header_image',$header_image);
        $cdata = ['main_content'=>$main_content];
        return view('admin.master')->with($cdata);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function changeOptions(Request $request){
        $datas = $request->all();
        //dd($datas);
        unset($datas['_token']);
        unset($datas['_method']);
        $req=false;

        foreach($datas as $key=>$data){
            if(!empty($data)) {
                $result["option_value"] = $data;
                $result["autoload"] = 'yes';
                DB::table('options')->where('option_name', $key)->update($result);
                $req = true;
            }else{
                $result["autoload"] = 'no';
                DB::table('options')->where('option_name', $key)->update($result);
                $req = true;
            }
        }
        if ($req=true){
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', '<strong>Well done!</strong> Task successfully done.
            <script>
                $(".alert1-success").delay(350).addClass("in").fadeOut(4000);
            </script>');
        } else {
            $request->session()->flash('message.content', '<strong>Sorry!</strong> ERROR occurred.
            <script>
                $(".alert1-danger").delay(350).addClass("in").fadeOut(4000);
            </script>');
        }

        return Redirect::back();

    }

    /**
     * @param Request $request
     * @param $theme_name
     * @return mixed
     */
    public function changeTheme(Request $request ,$theme_name)
    {

        $data['option_value'] = $theme_name;
        if (DB::table('options')->where('option_name','template')->update($data)){
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', '<strong>Well done!</strong> Task successfully done.
            <script>
                $(".alert1-success").delay(350).addClass("in").fadeOut(4000);
            </script>');
        } else {
            $request->session()->flash('message.content', '<strong>Sorry!</strong> ERROR occurred.
            <script>
                $(".alert1-danger").delay(350).addClass("in").fadeOut(4000);
            </script>');
        }

        return Redirect::back();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function upload(Request $request){
        $this->validate($request, [
            'file' => 'mimes:jpeg,png,jpg|max:2048',
        ]);
        $file = $request->file('file');
        if($file) {

            //File Name
            $file_name = $file->getClientOriginalName ();

            //File Mime Type
            $mime_type = $file->getMimeType ();

            //Make DIR
            date_default_timezone_set('asia/dhaka');
            $month = date('m');
            $year = date('Y');
            if (!file_exists("public/uploads/$year")) {
                mkdir("public/uploads/$year", 0777, true);
            }
            if (!file_exists("public/uploads/$year/$month")) {
                mkdir("public/uploads/$year/$month", 0777, true);
            }
            if ($mime_type == ('image/png' || 'image/jpeg')) {
                //Move Uploaded File
                $destinationPath = "public/uploads/$year/$month";
                $file->move ($destinationPath,$file->getClientOriginalName ());


                //----------------------------------//
                $data['post_author'] = $request->session()->get('user.id');
                $data['comment_status'] = "close";
                $data['post_name'] = $file_name;
                $data['slug'] = "uploads/$year/$month/".$file_name;
                $data['post_image'] = "uploads/$year/$month/".$file_name;

                $slug= $data['slug'];
                $slugs = DB::table('posts')->where('slug', $slug)->get();

                $data['post_title'] = $file_name;
                $data['post_type'] = "image";

                $count_slugs = count($slugs);
                if($count_slugs==0) {
                    DB::table('posts')->insert($data);
                }
            }
        }

        return Redirect::back();
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function destroyUpload(Request $request ,$id)
    {
        $data = DB::table('posts')->where('post_id', $id)->first();
        //dd($data);
        if (DB::table('posts')->where('post_id', $id)->delete()) {
            if(file_exists("public/$data->post_image")){
                @unlink("public/$data->post_image");
            }
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', '<strong>Well done!</strong> Task successfully done.
                        <script>
                            $(".alert1-success").delay(350).addClass("in").fadeOut(4000);
                        </script>');
        } else {
            $request->session()->flash('message.content', '<strong>Sorry!</strong> ERROR occurred.
                        <script>
                            $(".alert1-danger").delay(350).addClass("in").fadeOut(4000);
                        </script>');
        }

        return Redirect::back();
    }

}
