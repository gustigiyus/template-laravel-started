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

    // public function register()
    // {
    //     return view('auth.sign_up');
    // }

    // public function process_reg(Request $request)
    // {
    //     DB::beginTransaction();
    //     try {
    //         Session::flash('name', $request->name);
    //         Session::flash('username', $request->username);
    //         Session::flash('password', $request->password);
    //         Session::flash('password_confirm', $request->password_confirm);

    //         $request->validate([
    //             'name' => 'required',
    //             'username' => 'required|unique:users',
    //             'password' => 'required|min:6',
    //             'password_confirm' => 'required|same:password',
    //         ], [
    //             'name.required' => 'Name is required',
    //             'username.required' => 'Username is required',
    //             'password.required' => 'Password is required',
    //             'password.min' => 'The minimum password allowed is 6 characters',
    //             'password_confirm.required' => 'Password confirmation is required',
    //             'password_confirm.same' => 'Password confirmation you entered is not the same as the password'
    //         ]);

    //         DB::commit();
    //         Process Register
    //         $dataRegister = [
    //             'username' => $request->input('username'),
    //             'password' => Hash::make($request->input('password')),
    //         ];
    //         $user = User::create($dataRegister);

    //         $dataDetailRegister = [
    //             'user_id' => $user->id,
    //             'name' => $request->input('name'),
    //         ];
    //         UserDetail::create($dataDetailRegister);

    //         DB::table('user_role')->insert([
    //             'user_id' => $user->id,
    //             'role_id' => 4,
    //         ]);

    //         return redirect('sign-in')->with('success', 'Register successfully');
    //     } catch (\Throwable $th) {
    //         throw $th;
    //         DB::rollBack();
    //         $errors = $th->validator->errors()->toArray();
    //         return redirect('sign-up')->withErrors($errors)->withInput();
    //     }
    // }
}
