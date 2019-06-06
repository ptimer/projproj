<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Password;
use Auth;
use Illuminate\Http\Request;

class OperatorResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = 'mg/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:operator');
    }

    protected function broker()
    {
        return Password::broker('operators');
    }

    protected function guard()
    {
        return Auth::guard('operator');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.resetOperator')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}
