<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class Authentication extends Controller
{
    function indexs(){


        return view('index');
             
      
      }

      function login(){

        return view('login');
           
    
    }

    function loginPost(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {

            if ($request->is('api/*') || $request->wantsJson()) {

                return response()->json(Auth::user());
            } else {

                return redirect()->intended(route('index'));
            }
        }
    
        return redirect(route('login'))->with("error", "Invalid credentials");
    }
    

    function registration(){
       
        return view('registration');
           
    
    }

    function registrationPost(Request $request){
        $request->validate([
            	'name' => 'required',
            	'email' => 'required|email|unique:users',
                'phone' => 'required',
		        'address' => 'required',
            	'password' => 'required',
                'password_confirmation' => 'required|same:password'

            

        ]);
    
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
	    $data['address'] = $request->address;
        $data['password'] = Hash::make($request->password);
        $data['password_confirmation'] = $request->password_confirmation;
	    
    
        $user = User::create($data);
    
        if (!$user) {

            return redirect()->route('registration')->with("error", "unable to create an account");
            } else {

            if ($request->is('api/*') || $request->wantsJson()) {

                return response()->json($user, 201);
            } else {

                return redirect()->route('login')->with("success", "Registration successful. Login to access the app.");
            }
        }
    }

   
    function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'));    
    }
}


