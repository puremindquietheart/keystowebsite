<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;

class AdminLoginController extends Controller
{   
    public function userLogin() {
        if(Auth::check()) {
            return redirect()->intended('/keysto-admin-dashboard');
        } else {
            return view('user-login.login');
        }
    }

    public function loginAuthentication() {
        $userdata = array(
            'email' => Input::get('admin_email'),
            'password' => Input::get('admin_password')
        );
    
        if (Auth::attempt($userdata)) {
            if (Auth::user()) {  
                return redirect()->intended('/keysto-admin-dashboard');
            }
        }

        else if(Auth::validate([
                'email' => Input::get('admin_email'),
                'password' => Input::get('admin_password')
            ]))
        {
            return redirect('/keysto-admin-login')->with('failed','Your account is Deactivated. Please Contact The Administrator As Possible')->withInput();
        }
        
        else{
            return redirect('/keysto-admin-login')->with('failed','Incorrect Username or Password!')->withInput();
        }
    }
    
    public function userLogout() {
        Auth::logout();
        return redirect()->intended('/keysto-admin-login');
    }
}
