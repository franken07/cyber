<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;


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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        try {
            Log::info('Before creating user record');
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
            Log::info('After creating user record');
        } catch (\Exception $e) {
            Log::error('Error creating user record: ' . $e->getMessage());
            return response()->json(["error" => "Failed to create user"], 500);
        }

        return response()->json(["message" => "Successfully created the user's data"]);
    }
    }

   
    function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'));    
    }



