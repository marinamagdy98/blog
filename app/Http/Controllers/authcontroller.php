<?php

namespace App\Http\Controllers;
use App\Http\Controllers\controller;
use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class authcontroller extends Controller
{
    //
public function githubredirect (Request $_request)
{
    return Socialite::driver('github')->redirect();
}

public function githubcallback (Request $_request)
{
    $userdata = Socialite::driver('github')->user();
    $user= User::where('name' , $userdata->name)->where('auth_type' , 'github')->first();
if ($user)
{
    Auth::login($user);
    return redirect('/dashboard');

}else{
    $uuid = Str::uuid()->tostring();

    $user = new User();
    $user->name =$userdata->name;
    $user->email =$userdata->email;
    $user->password = Hash::make($uuid.now());
    $user->auth_type ='github';
    $user->save();
    Auth::login($user);
    return redirect('/dashboard');
}

}



public function googleredirect (Request $_request)
{
    return Socialite::driver('google')->redirect();
}

public function googlecallback (Request $_request)
{
    $userdata = Socialite::driver('google')->user();
    $user= User::where('name' , $userdata->name)->where('auth_type' , 'google')->first();
if ($user)
{
    Auth::login($user);
    return redirect('/dashboard');

}else{
    $uuid = Str::uuid()->tostring();

    $user = new User();
    $user->name =$userdata->name;
    $user->email =$userdata->email;
    $user->password = Hash::make($uuid.now());
    $user->auth_type ='google';
    $user->save();
    Auth::login($user);
    return redirect('/dashboard');
}

}



}
