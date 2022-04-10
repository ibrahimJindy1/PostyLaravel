<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware(['guest']);
    }

    function index()
    {
        return view('auth.login');
    }

    function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email |max:255',
            'password' => 'required',
        ]);

        if (!auth::attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('status', 'Invalid Login Details');
        }
        return redirect()->route('dashboard');
    }
}
