<?php

namespace App\Http\Controllers;

use Socialite;

class GoogleController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->user();

        // $user->token;
        /*dd($user);*/
        echo "<h3>You are loged in with google</h3>";
        echo $user->name."<br/>";
        echo $user->email."<br/>";
        echo "<img src='". $user->avatar."' /><br/>";
    }
}