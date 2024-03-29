<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class Authentication extends Controller
{

    public function getalluser()
    {
        // Fetch all users
        $users = User::all();

        // Return all users
        return response()->json($users);
    }
    function indexs(){


        return view('index');
             
      
      }

      function login(){

        return view('login');
           
    
    }

    public function loginPost(Request $request)
{
    $request->validate([
        'email' => 'required',
        'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        if ($request->expectsJson()) {
            // API request
            $token = $user->createToken('csd')->accessToken;
            return response()->json(['user' => $user, 'token' => $token]);
        } else {
            // Web request
            if ($user->usertype == 0) {
                // User is of type 0, redirect to index
                return redirect()->route('index');
            } elseif ($user->usertype == 1) {
                // User is of type 1, redirect to admin page
                return redirect()->route('edit_delete_products');
            }
        }
    }

    if ($request->expectsJson()) {
        return response()->json(['error' => 'Invalid credentials'], 401);
    } else {
        return redirect(route('login'))->with("error", "Invalid credentials");
    }
}

    

    function registration(){
       
        return view('registration');
           
    
    }

    public function registrationPost(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5|max:15',
            'email' => 'required|email|unique:users',
            'phone' => 'required|min:11|max:11',
            'address' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password'
        ], [
            'name.min' => 'The name must be at least 5 characters.',
            'name.max' => 'The name must be at max 15 characters.',
            'phone.max' => 'The phone number must be at least 11 characters.',
            'phone.min' => 'The phone number must be at max 11 characters.',
            'password.min' => 'The password must be at least 6 characters.',
        ]);
    
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['password'] = Hash::make($request->password);
    
        $user = User::create($data);
    
        if (!$user) {
            return redirect()->route('registration')->with("error", "Unable to create an account");
        } else {
            if ($request->expectsJson()) {
                // API request
                $token = $user->createToken('csd')->accessToken;
                return response()->json(['user' => $user, 'token' => $token], 201);
            } else {
                // Web request
                return redirect()->route('login')->with("success", "Registration successful. Login to access the app.");
            }
        }
    }
    

   
    function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'));    
    }

    public function updateUserType(Request $request, $id) {
        
        $request->validate([
            'usertype' => 'required|numeric', 
        ]);
    
        $user = User::findOrFail($id);
    

        $user->usertype = $request->input('usertype');
    

        $user->save();
    

        return response()->json(['message' => 'User type updated successfully', 'user' => $user]);
    }



}


