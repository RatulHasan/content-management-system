<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\ResetPassword;
use App\Mail\Registration;
session_start();
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->session()->get('user')){
            return redirect('admin/dashboard');
        }else {
            return view('admin.login');
        }
    }
    public function register(Request $request)
    {
        if($request->session()->get('user')){
            return redirect('admin/dashboard');
        }else {
            return view('admin.register');
        }
    }
    public function reset(Request $request)
    {
        if($request->session()->get('user')){
            return redirect('admin/dashboard');
        }else {
            return view('admin.reset');
        }
    }

    public function requestReset(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email',
        ]);
        $data = request()->all();
        unset($data['_token']);
        $all_users=DB::table('users')->where('email',$data['email'])->first();
        if(count($all_users)>0){
            $users=DB::table('users')->where('email',$data['email'])->where('status','active')->first();
            if(count($users)>0) {
                $data['remember_token'] = md5(md5($request->email) . 'b1a652f7');
                $data['status'] = 'pending';
                DB::table('users')->where('email', $data['email'])->update($data);
                // SEND MAIL
                \Mail::send(new ResetPassword());
                //SEND MAIL

                $request->session()->flash('message.content', '<span class="text-success"><strong>Success!</strong> confirmation email sent.</span> ');

                return redirect('/admin/login');
            }else{
                $request->session()->flash('message.content', '<span class="text-danger"><strong>Sorry!</strong> Your account not active yet! please active first.</span> ');
                return redirect('admin/login');
            }
        }else{
            $request->session()->flash('message.content', '<span class="text-danger"><strong>Sorry!</strong> You are not valid user! please signup first.</span> ');
            return redirect('admin/register');
        }
    }
    public  function resetConfirm(Request $request, $slug){
        $check=DB::table('users')->where('remember_token',$slug)->first();
        if(count($check)>0){
            return view('admin.reset_password')->with('slug',$slug);
        }else{
            $request->session()->flash('message.content', '<span class="text-danger"><strong>Sorry!</strong> ERROR occurred. This link is invalid!</span> ');
            return redirect('/admin/login');
        }
    }
    public  function resetPassword(Request $request){
        $this->validate($request,[
            'password' => 'required|min:6|confirmed',
        ]);
        $data=$request->all();
        unset($data['_token']);
        unset($data['password_confirmation']);
        $check=DB::table('users')->where('remember_token',$data['remember_token'])->first();
        if(count($check)>0){
            $slug=$data['remember_token'];
            $data['remember_token']='';
            $data['status']='active';
            $data['password']=md5($request->input('password'));
            DB::table('users')->where(['remember_token'=>$slug])->update($data);
            $request->session()->flash('message.content', '<span class="text-success"><strong>Please login.</strong></span> ');
            return redirect('/admin/login');
        }else{
            $request->session()->flash('message.content', '<span class="text-danger"><strong>Sorry!</strong> ERROR occurred. This link is invalid!</span> ');
            return redirect('/admin/login');
        }
    }

    public function loginCheck(Request $request)
    {
        $email=$request->input('email');
        $password=md5($request->input('password'));
        $check=DB::table('users')->where(['email'=>$email,'password'=>$password,'status'=>'active'])->first();

        if(count($check)>0){
            $request->session()->put('user.email',$check->email);
            $request->session()->put('user.name',$check->name);
            $request->session()->put('user.user_role',$check->user_role);
            $request->session()->put('user.id',$check->id);
            return redirect('/admin/dashboard');
        }else{
            $request->session()->flash('message.content', '<span class="text-danger"><strong>Sorry!</strong> Login credentials not matched.</span> ');

            return redirect('/admin/login');
        }
    }
    public function signUp(Request $request)
    {
         $this->validate($request,[
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);
        $data = request()->all();
        unset($data['_token']);
        unset($data['password_confirmation']);
        $data['password']=md5($data['password']);
        $data['remember_token']=md5(md5($request->email).'b1a652f7');

        $all_options=DB::table('options')->get();
        foreach($all_options as $all_option){
            if($all_option->option_name=='default_user_role') {
                $default_user_role = $all_option->option_value;
            }
        }
        $data['user_role']=$default_user_role;

        if (DB::table('users')->insert($data)) {
            $request->session()->flash('message.content', '<span class="text-success"><strong>Success!</strong> confirmation email sent.</span> ');
//SEND MAIL
            \Mail::send(new Registration());
//SEND MAIL

            return redirect('/admin/login');
        } else {
            $request->session()->flash('message.content', '<span class="text-danger"><strong>Sorry!</strong> Error occurred.</span> ');

            return redirect('/admin/login');
        }
    }

    public function activeUser(Request $request,$remember_token)
    {
        $check=DB::table('users')->where(['remember_token'=>$remember_token,'status'=>'pending'])->first();
        if(count($check)>0){
            $data['remember_token']='';
            $data['status']='active';
            DB::table('users')->where(['remember_token'=>$remember_token])->update($data);
            return redirect('/admin/login');
        }else{
            $request->session()->flash('message.content', '<span class="text-danger"><strong>Sorry!</strong> ERROR occurred. This link is invalid!</span> ');
            return redirect('/admin/login');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->pull('user');
        return redirect('/');
    }
}
