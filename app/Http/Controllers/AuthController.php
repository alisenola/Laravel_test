<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\{
    LoginRequest,
    RegisterRequest,
};
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Login view
     *
     * @return Illuminate\Support\Facades\View
     */
    public function viewLogin()
    {
        return view('auth.login');
    }

    /**
     * Login HTTP request
     * @param  LoginRequest	$request
     *
     * @return App\Http\Requests\Auth\Login
     */
    public function postLogin(LoginRequest $request)
    {
        try {
            return $request->login();
        } catch (\Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Register view
     *
     * @return Illuminate\Support\Facades\View
     */
    public function viewRegister(Request $request)
    {
        return view('auth.register');
    }

    /**
     * Register HTTP request
     * @param  RegisterRequest	$request
     *
     * @return App\Http\Requests\Auth\Register
     */
    public function postRegister(RegisterRequest $request)
    {
        try {
            return $request->register();
        } catch (Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Logout HTTP request
     *
     * @return Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        session()->flush();

        return redirect()->route('login');
    }
}