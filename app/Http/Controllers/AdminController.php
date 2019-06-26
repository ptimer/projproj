<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Admin;
use App\Operator;
use App\User;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $admins = Admin::all();
        $operators = Operator::all();
        $clients = User::all();

        return view('admin.dashboard', [
            'admins' => $admins,
            'operators' => $operators,
            'clients' => $clients
        ]);
    }




    public function NewOperator()
    {
        return view('admin.createOperator');
    }





    public function EditOperator($id)
    {

        $operator = Operator::findOrFail($id);

        return view('admin.editOperator', ['operator' => $operator]);
    }



    protected function destroyOperator(Request $request)
    {
        Operator::findOrFail($request->id)->delete();
        return redirect()->back();
    }




    protected function registerOperator(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:operators'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $operator = new Operator();

        $operator->name = $request->get('name');
        $operator->email = $request->get('email');
        $operator->password = Hash::make($request->get('password'));

        $operator->save();

        if($operator){
           return redirect()->route('admin.dashboard'); 
        }
        return $operator;
    }





    protected function updateOperator(Request $request)
    {
        
        $operator = Operator::findOrFail($request->id);

        if($operator->email == $request->email)
        {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }
        else
        {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:operators'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }
        

        $operator->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if($operator){
           return redirect()->route('admin.dashboard'); 
        }
        return $operator;
    }

}
