<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Crypt;
use App\Models\Client;
use App\Models\User;
use App\Models\ClientObject;



class AdminLogin extends Controller
{
    function index(){
        $pmid = session('user');
        $name = User::find($pmid);
        $allusers = User::all();
        $clients = Client::all();
        $objects = ClientObject::all();
        return view('admin.dashboard',['name'=>$name->name,'client'=>count($clients),'objects'=>count($objects),'users'=>count($allusers)]);
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
