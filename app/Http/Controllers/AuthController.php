<?php

namespace App\Http\Controllers;

use App\Models\Post;
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
            /* Find users having one or more post along with other users */
            $users = User::with(['posts'])->has('posts', '>', 1)->get();
            $otherUsers = User::whereNotIn('id',User::with(['posts'])->has('posts', '>', 1)->pluck('id'))->get();
            $users = $users->merge($otherUsers);
            $users->map(function($user){
                $user->postCount = Post::whereUserId($user->id)->count();
            });

            /* Find Users whose name includes letter m */
            $usersWithM = User::where('name', 'LIKE', '%m%')->get();
            $usersWithoutM  = User::where('name', 'NOT LIKE', '%m%')->get();
            $usersWithLetter = $usersWithM->merge($usersWithoutM);
            return view('welcome',compact('users','usersWithLetter'));
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
