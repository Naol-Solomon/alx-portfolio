<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PhpParser\Node\Stmt\Else_;

class UserController extends Controller
{
    public function logout(){
        auth()->logout();
        return redirect('/')->with('success', "You are successfully logged out.");
    }
    public function showCorrectPage(){

        if(auth()->check()){
            return view('homepage-feed');
        }else{
            return view('homepage');
        }
    }
    public function login(Request $request){
        $incomingFields = $request->validate([
            'loginusername' => 'required',
            'loginpassword' => 'required'
        ]);

        if (Auth()->attempt(['username'=> $incomingFields['loginusername'] ,'password'=> $incomingFields['loginpassword']])){
            $request->session()->regenerate();
            return redirect('/')->with('success', 'You are successfully logged in.');
            
        } else{
            return view('homepage');
        }
    }
    public function register(Request $request){
        $incomingFields = $request->validate([
            'username' => ['required', 'min:3', 'max:20', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed']
        ]);
        $incomingFields['password'] = bcrypt($incomingFields['password']);
        User::create($incomingFields);
    }

    // public function homepage(){
    //     return view('homepage');
    // }

    public function singlePost(){
        return view('single-post');
    }
}
