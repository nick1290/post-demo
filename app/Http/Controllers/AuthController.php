<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;

class AuthController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }


    public function register()
    {
        return view('auth.register');
    }


    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                ->withSuccess('You have Successfully loggedin');
        }

        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }


    public function postRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'contact' => 'required',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect("welcome")->withSuccess('Great! You have Successfully loggedin');
    }


    public function dashboard()
    {
        if (Auth::check()) {
            return view('welcome');
        }

        return redirect("login")->withSuccess('Opps! You do not have access');
    }


    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'contact' => $data['contact'],
        ]);
    }


    public function logout()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
