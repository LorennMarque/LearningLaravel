<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    // Show register/Create form
    public function create(){
        return view("users.register");
    }

    # Store new user
    public function store(Request $request){
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users','email')],
            'password' => 'required|confirmed|min:6',
        ]);
        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);
        auth()->login($user);
        return redirect('/listings')->with('message', 'User created with'. $user->name);
    }

    public function logout(Request $request){
        auth()->logout();

        #Regenerate token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/listings')->with('message', 'You have been logged out!');
    }

    # Login function
    public function login(){
        return view("users.login");
    }

    public function authenticate(Request $request){
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        if(auth()->attempt($formFields)){
            $request->session()->regenerate();
            return redirect("/listings")->with('message','You are logged in!');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }
}
