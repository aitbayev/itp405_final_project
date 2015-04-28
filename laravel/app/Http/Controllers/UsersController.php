<?php namespace App\Http\Controllers;
use App\User;
use Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller{

    public function createUser(){
        return view('signup');
    }

    public function saveUser()
    {
        $validation = User::validate(Request::all());

        if ($validation->passes()) {
            $user = new User();
            $user->name = Request::input('name');
            $user->email = Request::input('email');
            $user->password = Hash::make(Request::input('password'));
            $user->save();

            Auth::loginUsingId($user->id);
            return redirect('search#login')->with('success', 'You account was successfully created');
        }
        return redirect('search#signup')->withErrors($validation->errors());
    }

    public function login(){
        return view('login');
    }

    public function loginUser(){
        $credentials = [
            'email' => Request::input('email'),
            'password' => Request::input('password')
        ];

        $remember_me = Request::input('remember_me') == 'on' ? true : false;

        if (Auth::attempt($credentials, $remember_me)) {
            return redirect('search#search');
        }

        return redirect('search#login')->with('error', 'Invalid login or password');
    }

    public function logout(){
        Auth::logout();
        return redirect('search');
    }
}