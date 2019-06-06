<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Admin;

class AdminLoginController extends Controller
{

	public function __construct()
    {
        $this->middleware('guest:admin');
    }

    public function showLoginForm()
    {
    	return view('auth.adminLogin');
    }

    public function login(Request $request)
    {
    	$credentials = $this->validate($request,[
    		'email' => 'required|email',
    		'password' => 'required|min:6'
    	]);

    	if(Auth::guard('admin')->attempt(['email' => $request->email,
    	'password' => $request->password], $request->remember)){
    		return redirect()->intended(route('admin.dashboard'));
    	}

    	return redirect()->back()->withInput($request->only('email', 'remember'));
    }


    // FOR AJAX

    public function search(Request $request)
    {
        $users = Admin::where('email', $request->q)->first();

        if($users != null){
            return 1;
        }else{
            return "Ничего нет иди домой";
        }
        
    }
}
