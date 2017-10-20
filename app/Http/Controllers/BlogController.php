<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class BlogController extends Controller
{
    /**
     * @param Request $request
     * @return $this
     */
    public function index(Request $request)
    {
        $all_options = DB::table('options')->get();
        foreach($all_options as $all_option){
            if($all_option->option_name=='template') {
                $template = $all_option->option_value;
            }
            if($all_option->option_name=='blogname') {
                $blogname = $all_option->option_value;
            }
            if($all_option->option_name=='blogdescription') {
                $blogdescription = $all_option->option_value;
            }
            if($all_option->option_name=='header_image') {
                $header_image = $all_option->option_value;
                $autoload = $all_option->autoload;
            }
        }
        $guid=$request->segment(1);
        $all_metas = DB::table("postmeta")->where("meta_key", $guid)->first();
        $comment_status = DB::table("posts")->where("slug", $guid)->first();
        $all_posts = DB::table("posts")->where("slug", "/")->orWhere("slug", "")->where("post_status", "publish")->get();
        $all_navbar = DB::table("posts")->where("is_menu_show", "yes")->where("post_status", "publish")->orderBy("menu_order","asc")->get();
        $child_menu = DB::table("posts")->where("post_status", "publish")->where("parent_id","!=", "NULL")->orWhere("parent_id","!=", "0")->orderby("menu_order","asc")->get();

        $top_bar=view("blog.$template.template.top_bar");
        $navbar=view("blog.$template.template.navbar")->with(["all_navbar"=>$all_navbar,"child_menu"=>$child_menu,"blogname"=>$blogname,"blogdescription"=>$blogdescription,"header_image"=>$header_image,"autoload"=>$autoload]);
        $slider=view("blog.$template.template.slider");
        $post_content=view("blog.$template.all_posts")->with(["all_posts"=>$all_posts,"all_metas"=>$all_metas,"comment_status"=>$comment_status]);
        $footer=view("blog.$template.template.footer");
        $cdata=["top_bar"=>$top_bar,
            "blogdescription"=>$blogdescription,
                "blogname"=>$blogname,
                "navbar"=>$navbar,
                "slider"=>$slider,
                "post_content"=>$post_content,
                "footer"=>$footer];

        return view("blog.$template.index")
            ->with($cdata);
    }

    /**
     * @param $author
     * @return $this
     */
    public function getAuthorPosts($author)
    {
        $all_options = DB::table('options')->get();
        foreach($all_options as $all_option){
            if($all_option->option_name=='template') {
                $template = $all_option->option_value;
            }
            if($all_option->option_name=='blogname') {
                $blogname = $all_option->option_value;
            }
            if($all_option->option_name=='blogdescription') {
                $blogdescription = $all_option->option_value;
            }
            if($all_option->option_name=='header_image') {
                $header_image = $all_option->option_value;
                $autoload = $all_option->autoload;
            }
        }
        $all_posts = DB::table("posts")->where("post_author", $author)->where("post_type", "post")->where("post_status", "publish")->get();
        $recent_posts = DB::table("posts")->where("post_type", "post")->where("post_status", "publish")->orderBy("created_at","desc")->take(5)->get();
        $child_menu = DB::table("posts")->where("post_status", "publish")->where("parent_id","!=", "NULL")->orWhere("parent_id","!=", "0")->orderby("menu_order","asc")->get();
        $all_categories = DB::table("categories")->get();
        $all_tags = DB::table("tags")->get();

        $all_navbar = DB::table("posts")->where("is_menu_show", "yes")->where("post_status", "publish")->orderBy("menu_order", "asc")->get();

        $top_bar = view("blog.$template.template.top_bar");
        $navbar = view("blog.$template.template.navbar")->with(["all_navbar"=>$all_navbar,"child_menu"=>$child_menu,"blogname"=>$blogname,"blogdescription"=>$blogdescription,"header_image"=>$header_image,"autoload"=>$autoload]);
        $slider2=view("blog.$template.template.slider2");
        $post_content = view("blog.$template.all_posts")->with("all_posts", $all_posts);
        $sidebar = view("blog.$template.template.sidebar")->with(["all_categories"=>$all_categories,"all_tags"=>$all_tags,"recent_posts"=>$recent_posts]);
        $footer = view("blog.$template.template.footer");
        $cdata = ["top_bar" => $top_bar,
            "blogname"=>$blogname,
            "blogdescription"=>$blogdescription,
            "navbar" => $navbar,
            "slider"=>$slider2,
            "post_content" => $post_content,
            "sidebar" => $sidebar,
            "footer" => $footer];

        return view("blog.$template.index")
            ->with($cdata);
    }

    /**
     * @param $guid
     * @return $this
     */
    public function posts($guid){

        $all_options = DB::table('options')->get();
        foreach($all_options as $all_option){
            if($all_option->option_name=='template') {
                $template = $all_option->option_value;
            }
            if($all_option->option_name=='blogname') {
                $blogname = $all_option->option_value;
            }
            if($all_option->option_name=='blogdescription') {
                $blogdescription = $all_option->option_value;
            }
            if($all_option->option_name=='header_image') {
                $header_image = $all_option->option_value;
                $autoload = $all_option->autoload;
            }
        }
        $all_posts = DB::table("posts")->where("slug", $guid)->where("post_status", "publish")->first();
        $recent_posts = DB::table("posts")->where("post_type", "post")->where("post_status", "publish")->orderBy("created_at","desc")->take(5)->get();
        $child_menu = DB::table("posts")->where("post_status", "publish")->where("parent_id","!=", "NULL")->orWhere("parent_id","!=", "0")->orderby("menu_order","asc")->get();
        $all_categories = DB::table("categories")->get();
        $all_tags = DB::table("tags")->get();
        $count_slug=count($all_posts);
        if($count_slug<1){//ERROR PAGE REDIRECT

            $all_navbar = DB::table("posts")->where("is_menu_show", "yes")->where("post_status", "publish")->orderBy("menu_order","asc")->get();

            $top_bar=view("blog.$template.template.top_bar");
            $navbar=view("blog.$template.template.navbar")->with(["all_navbar"=>$all_navbar,"child_menu"=>$child_menu,"blogname"=>$blogname,"blogdescription"=>$blogdescription,"header_image"=>$header_image,"autoload"=>$autoload]);
            $slider2=view("blog.$template.template.slider2");
            $sidebar=view("blog.$template.template.sidebar")->with(["all_categories"=>$all_categories,"all_tags"=>$all_tags,"recent_posts"=>$recent_posts]);
            $footer=view("blog.$template.template.footer");
            $cdata=["top_bar"=>$top_bar,
                "blogdescription"=>$blogdescription,
                "blogname"=>$blogname,
                "navbar"=>$navbar,
                "slider"=>$slider2,
                "sidebar"=>$sidebar,
                "footer"=>$footer];
            return view("blog.$template.404")
                ->with($cdata);
        }else {
            $all_metas = DB::table("postmeta")->where("meta_key", $guid)->first();
            $comment_status = DB::table("posts")->where("slug", $guid)->first();
            $post_id=$comment_status->post_id;
            $all_comments = DB::table('comments')
                ->where('comment_post_ID',$post_id)
                ->where('comment_approved','approved')
                ->get();
            $all_reply = DB::table('comments as c1')
                ->leftJoin('comments as c2','c1.comment_ID','=','c2.comment_parent')
                ->selectRaw('c1.*')
                ->selectRaw('c2.*')
                ->where('c1.comment_post_ID',$post_id)
                ->where('c1.comment_approved','approved')
                ->where('c2.comment_approved','approved')
                ->get();
            if (!empty($all_metas)) {//BLOG SHOP ETC PAGE REDIRECT

                $all_posts = DB::table("posts")->where("post_type", $all_metas->meta_value)->where("post_status", "publish")->orderby("post_id","DESC")->simplePaginate(10);
            } else {//SINGLE PAGE OR POST REDIRECT

                $all_posts = DB::table("posts")->where("slug", $guid)->where("post_status", "publish")->get();
            }
            $all_navbar = DB::table("posts")->where("is_menu_show", "yes")->where("post_status", "publish")->orderBy("menu_order", "asc")->get();

            $top_bar = view("blog.$template.template.top_bar");
            $navbar = view("blog.$template.template.navbar")->with(["all_navbar"=>$all_navbar,"child_menu"=>$child_menu,"blogname"=>$blogname,"blogdescription"=>$blogdescription,"header_image"=>$header_image,"autoload"=>$autoload]);
            $slider2=view("blog.$template.template.slider2");
            $post_content = view("blog.$template.all_posts")->with(["all_posts"=>$all_posts,"all_metas"=>$all_metas,"comment_status"=>$comment_status,"all_comments"=>$all_comments,"all_reply"=>$all_reply]);
            $sidebar = view("blog.$template.template.sidebar")->with(["all_categories"=>$all_categories,"all_tags"=>$all_tags,"recent_posts"=>$recent_posts]);
            $footer = view("blog.$template.template.footer");
            $cdata = ["top_bar" => $top_bar,
                "blogname"=>$blogname,
                "blogdescription"=>$blogdescription,
                "navbar" => $navbar,
                "slider"=>$slider2,
                "post_content" => $post_content,
                "sidebar" => $sidebar,
                "footer" => $footer];
            return view("blog.$template.index")
                ->with($cdata);
        }
    }

    /**
     * @param $post_category
     * @return $this
     */
    public function categorySearch($post_category){

        $all_options = DB::table('options')->get();
        foreach($all_options as $all_option){
            if($all_option->option_name=='template') {
                $template = $all_option->option_value;
            }
            if($all_option->option_name=='blogname') {
                $blogname = $all_option->option_value;
            }
            if($all_option->option_name=='blogdescription') {
                $blogdescription = $all_option->option_value;
            }
            if($all_option->option_name=='header_image') {
                $header_image = $all_option->option_value;
                $autoload = $all_option->autoload;
            }
        }

        $all_categorys = DB::table("posts")->where("post_category", $post_category)->where("post_status", "publish")->get();
        $recent_posts = DB::table("posts")->where("post_type", "post")->where("post_status", "publish")->orderBy("created_at","desc")->take(5)->get();
        $child_menu = DB::table("posts")->where("post_status", "publish")->where("parent_id","!=", "NULL")->orWhere("parent_id","!=", "0")->orderby("menu_order","asc")->get();
        $all_categories = DB::table("categories")->get();
        $all_tags = DB::table("tags")->get();
        $count_categorys=count($all_categorys);
        if($count_categorys<1){

            $all_navbar = DB::table("posts")->where("is_menu_show", "yes")->where("post_status", "publish")->orderBy("menu_order","asc")->get();

            $top_bar=view("blog.$template.template.top_bar");
            $navbar=view("blog.$template.template.navbar")->with(["all_navbar"=>$all_navbar,"child_menu"=>$child_menu,"blogname"=>$blogname,"blogdescription"=>$blogdescription,"header_image"=>$header_image,"autoload"=>$autoload]);
            $slider2=view("blog.$template.template.slider2");
            $sidebar=view("blog.$template.template.sidebar")->with(["all_categories"=>$all_categories,"all_tags"=>$all_tags,"recent_posts"=>$recent_posts]);
            $footer=view("blog.$template.template.footer");
            $cdata=["top_bar"=>$top_bar,
                "blogdescription"=>$blogdescription,
                "blogname"=>$blogname,
                "navbar"=>$navbar,
                "slider"=>$slider2,
                "sidebar"=>$sidebar,
                "footer"=>$footer];
            return view("blog.$template.404")
                ->with($cdata);
        }else {

            $all_navbar = DB::table("posts")->where("is_menu_show", "yes")->where("post_status", "publish")->orderBy("menu_order", "asc")->get();

            $top_bar = view("blog.$template.template.top_bar");
            $navbar = view("blog.$template.template.navbar")->with(["all_navbar"=>$all_navbar,"child_menu"=>$child_menu,"blogname"=>$blogname,"blogdescription"=>$blogdescription,"header_image"=>$header_image,"autoload"=>$autoload]);
            $slider2=view("blog.$template.template.slider2");
            $post_content = view("blog.$template.all_posts")->with("all_posts", $all_categorys);
            $sidebar = view("blog.$template.template.sidebar")->with(["all_categories"=>$all_categories,"all_tags"=>$all_tags,"recent_posts"=>$recent_posts]);
            $footer = view("blog.$template.template.footer");
            $cdata = ["top_bar" => $top_bar,
                "blogname"=>$blogname,
                "blogdescription"=>$blogdescription,
                "navbar" => $navbar,
                "slider"=>$slider2,
                "post_content" => $post_content,
                "sidebar" => $sidebar,
                "footer" => $footer];
            return view("blog.$template.index")
                ->with($cdata);
        }
    }

    /**
     * @param $post_tag
     * @return $this
     */
    public function tagSearch($post_tag){
        $all_options = DB::table('options')->get();
        foreach($all_options as $all_option){
            if($all_option->option_name=='template') {
                $template = $all_option->option_value;
            }
            if($all_option->option_name=='blogname') {
                $blogname = $all_option->option_value;
            }
            if($all_option->option_name=='blogdescription') {
                $blogdescription = $all_option->option_value;
            }
            if($all_option->option_name=='header_image') {
                $header_image = $all_option->option_value;
                $autoload = $all_option->autoload;
            }
        }
        $all_posts = DB::table("posts")->where("post_tags", "LIKE", "%$post_tag%")->where("post_status", "publish")->get();
        $recent_posts = DB::table("posts")->where("post_type", "post")->where("post_status", "publish")->orderBy("created_at","desc")->take(5)->get();
        $child_menu = DB::table("posts")->where("post_status", "publish")->where("parent_id","!=", "NULL")->orWhere("parent_id","!=", "0")->orderby("menu_order","asc")->get();
        $all_categories = DB::table("categories")->get();
        $count_categorys=count($all_posts);
        $all_tags = DB::table("tags")->get();
        if($count_categorys<1){
            $all_navbar = DB::table("posts")->where("is_menu_show", "yes")->where("post_status", "publish")->orderBy("menu_order","asc")->get();
            $top_bar=view("blog.$template.template.top_bar");
            $navbar=view("blog.$template.template.navbar")->with(["all_navbar"=>$all_navbar,"child_menu"=>$child_menu,"blogname"=>$blogname,"blogdescription"=>$blogdescription,"header_image"=>$header_image,"autoload"=>$autoload]);
            $slider2=view("blog.$template.template.slider2");
            $sidebar=view("blog.$template.template.sidebar")->with(["all_categories"=>$all_categories,"all_tags"=>$all_tags,"recent_posts"=>$recent_posts]);
            $footer=view("blog.$template.template.footer");
            $cdata=["top_bar"=>$top_bar,
                "blogdescription"=>$blogdescription,
                "blogname"=>$blogname,
                "navbar"=>$navbar,
                "slider"=>$slider2,
                "sidebar"=>$sidebar,
                "footer"=>$footer];
            return view("blog.$template.404")
                ->with($cdata);
        }else {

            $all_navbar = DB::table("posts")->where("is_menu_show", "yes")->where("post_status", "publish")->orderBy("menu_order", "asc")->get();
            $top_bar = view("blog.$template.template.top_bar");
            $navbar = view("blog.$template.template.navbar")->with(["all_navbar"=>$all_navbar,"child_menu"=>$child_menu,"blogname"=>$blogname,"blogdescription"=>$blogdescription,"header_image"=>$header_image,"autoload"=>$autoload]);
            $slider2=view("blog.$template.template.slider2");
            $post_content = view("blog.$template.all_posts")->with("all_posts", $all_posts);
            $sidebar = view("blog.$template.template.sidebar")->with(["all_categories"=>$all_categories,"all_tags"=>$all_tags,"recent_posts"=>$recent_posts]);
            $footer = view("blog.$template.template.footer");
            $cdata = ["top_bar" => $top_bar,
                "blogname"=>$blogname,
                "blogdescription"=>$blogdescription,
                "navbar" => $navbar,
                "slider"=>$slider2,
                "post_content" => $post_content,
                "sidebar" => $sidebar,
                "footer" => $footer];
            return view("blog.$template.index")
                ->with($cdata);
        }
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function searchAnyWhere(Request $request){

        $post_tag=$request->search;
        $all_options = DB::table('options')->get();
        foreach($all_options as $all_option){
            if($all_option->option_name=='template') {
                $template = $all_option->option_value;
            }
            if($all_option->option_name=='blogname') {
                $blogname = $all_option->option_value;
            }
            if($all_option->option_name=='blogdescription') {
                $blogdescription = $all_option->option_value;
            }
            if($all_option->option_name=='header_image') {
                $header_image = $all_option->option_value;
                $autoload = $all_option->autoload;
            }
        }

        $all_posts = DB::table("posts")
            ->orWhere("post_content", "LIKE", "%$post_tag%")
            ->orWhere("post_title", "LIKE", "%$post_tag%")
            ->orWhere("post_tags", "publish")
            ->simplePaginate(10);
        $recent_posts = DB::table("posts")->where("post_type", "post")->where("post_status", "publish")->orderBy("created_at","desc")->take(5)->get();
        $child_menu = DB::table("posts")->where("post_status", "publish")->where("parent_id","!=", "NULL")->orWhere("parent_id","!=", "0")->orderby("menu_order","asc")->get();
        $all_categories = DB::table("categories")->get();
        $count_categorys=count($all_posts);
        $all_tags = DB::table("tags")->get();
        if($count_categorys<1){
            $all_navbar = DB::table("posts")->where("is_menu_show", "yes")->where("post_status", "publish")->orderBy("menu_order","asc")->get();
            $top_bar=view("blog.$template.template.top_bar");
            $navbar=view("blog.$template.template.navbar")->with(["all_navbar"=>$all_navbar,"child_menu"=>$child_menu,"blogname"=>$blogname,"blogdescription"=>$blogdescription,"header_image"=>$header_image,"autoload"=>$autoload]);
            $slider2=view("blog.$template.template.slider2");
            $sidebar=view("blog.$template.template.sidebar")->with(["all_categories"=>$all_categories,"all_tags"=>$all_tags,"recent_posts"=>$recent_posts]);
            $footer=view("blog.$template.template.footer");
            $cdata=["top_bar"=>$top_bar,
                "blogdescription"=>$blogdescription,
                "blogname"=>$blogname,
                "navbar"=>$navbar,
                "slider"=>$slider2,
                "sidebar"=>$sidebar,
                "footer"=>$footer];

            return view("blog.$template.404")
                ->with($cdata);
        }else {

            $all_navbar = DB::table("posts")->where("is_menu_show", "yes")->where("post_status", "publish")->orderBy("menu_order", "asc")->get();
            $top_bar = view("blog.$template.template.top_bar");
            $navbar = view("blog.$template.template.navbar")->with(["all_navbar"=>$all_navbar,"child_menu"=>$child_menu,"blogname"=>$blogname,"blogdescription"=>$blogdescription,"header_image"=>$header_image,"autoload"=>$autoload]);
            $slider2=view("blog.$template.template.slider2");
            $post_content = view("blog.$template.all_posts")->with("all_posts", $all_posts);
            $sidebar = view("blog.$template.template.sidebar")->with(["all_categories"=>$all_categories,"all_tags"=>$all_tags,"recent_posts"=>$recent_posts]);
            $footer = view("blog.$template.template.footer");
            $cdata = ["top_bar" => $top_bar,
                "blogname"=>$blogname,
                "blogdescription"=>$blogdescription,
                "navbar" => $navbar,
                "slider"=>$slider2,
                "post_content" => $post_content,
                "sidebar" => $sidebar,
                "footer" => $footer];

            return view("blog.$template.index")
                ->with($cdata);
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function commentPost(Request $request){

        $this->validate($request, [
            'comment_author' => 'required|max:255',
            'comment_author_email' => 'required|email',
            'comment_content' => 'required',
            'comment_post_ID' => 'required',
        ]);
        $data=$request->all();
        if($data['comment_parent']!=Null){
            $data['comment_type']='reply';
        }
        $user_id=$request->session()->get('user.id');
        if($user_id!=null){
            $data['user_id']=$user_id;
        }
        unset($data['_token']);
        $data['comment_author_IP']=$request->ip();
        $data['comment_agent']=$request->server('HTTP_USER_AGENT');
        DB::table('comments')->insert($data);
        DB::table('posts')->where('post_id',$data['comment_post_ID'])->increment('comment_count',1);

        return Redirect::back();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function postPassword(Request  $request){
        $data=$request->all();
        $check = DB::table('posts')->where(['slug'=>$data['post_slug'],'post_password'=>$data['post_password']])->first();
        if(count($check)>0) {
            $request->session ()->put ('post_password',$data['post_password']);
            $request->session ()->put ('post_slug',$data['post_slug']);
        }else{
            $request->session()->flash('error', 'Incorrect Password');
        }

        return Redirect::back();
    }

}
