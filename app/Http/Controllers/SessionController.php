<?php

namespace App\Http\Controllers;

use App\Helpers\ToastrHelper;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    public function login()
    {
        return view('pages.auth.login');
    }

    public function process_log(Request $request)
    {
        if ($request->isMethod("POST")) {
            Session::flash('username', $request->username);

            $request->validate([
                'username' => 'required',
                'password' => 'required',
            ], [
                'username.required' => 'Username is required',
                'password.required' => 'Password is required'
            ]);

            $infologin = [
                'username' => $request->username,
                'password' => $request->password,
            ];

            if (Auth::attempt($infologin)) {
                //? Kalo authentication success

                $datauser = User::where('username', $request->username)->first();
                session(['username' => $datauser->username]);

                ToastrHelper::successMessage("Login successfully");
                return redirect()->route('dashboard');
            } else {
                //! Kalo authentication gagal
                return redirect()->route('sign-in')
                    ->withErrors('Username and password you entered are invalid')
                    ->withInput();
            }
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect()->route('sign-in')->with('success', 'You have successfully logged out');
    }
}
