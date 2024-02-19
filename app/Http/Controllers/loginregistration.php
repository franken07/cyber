<?php

namespace App\Http\Controllers;

use App\Models\usercommerce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class loginregistration extends Controller
{
    public function login()
    {
        return view('login');
    }

    function loginPost(Request $request){
        $request->validate([
            
            'name' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {

            if ($request->is('api/*') || $request->wantsJson()) {

                return response()->json(Auth::user());
            } else {

                return redirect()->intended(route('index'));
            }
        }

        return redirect(route('login'))->with("error", "Invalid credentials");
    }


    public function registration()
    {
        return view('registration');
    }

    public function registrationPost(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
        ]);

        $user = usercommerce::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        // Log the user in (optional)
        //auth()->login($user);

        // Redirect to a specific route after registration
        return redirect(route('login')); // Change 'dashboard' to the intended route
    }
}
