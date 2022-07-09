<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Crypt;
use App\Models\Client;



class AdminLogin extends Controller
{
    function index(){
        $clients = Client::all();
        return view('admin.clients',['clients'=>$clients]);
    }
   
    function login(Request $request){
       $this->validate($request,[
        'email'   => 'required|email',
        'password' => 'required|min:2'
       ]);
       if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        session(['user' => Auth::id()]);
        return redirect('/admin/dashboard');
    }
    return redirect('/admin');

    }
}
