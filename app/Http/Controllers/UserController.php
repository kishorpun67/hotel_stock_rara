<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;
use Session;
use Hash;
use Auth;
use App\Member;

class UserController extends Controller
{
    public function login(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            //return Hash::make(12345);
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                $session = Str::random(50);
                Session::put('session', $session);
                return redirect('/');
            }else{
                Session::flash('error_message', 'Invalid Email or Password');
                return redirect()->back();
            }
        }else{
            return view('front.login');
        }
       //return redirect('/');
    }
    public function register(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = request()->all();
            //return $data;
            $count = User::where('email', $data['email'])->count();
            if($count >=1){
                Session::flash('error_message', 'Email already exists');
            }
            $newUser = new User();
            $newUser->name = $data['name'];
            $newUser->email = $data['email'];
            $newUser->password = Hash::make($data['password']);
            $newUser->save();
            Session::flash('success_message', 'Your account has created sucessfully');
            return redirect()->back();
        }
        // return view('admin.user_member_form');
    }

    public function forgotPassword()
    {
        if(request()->method('post')){

        }
        return view('front.password_forgot');
    }
    public function logout () {
        auth()->logout();
        return redirect('/');
    }
}
