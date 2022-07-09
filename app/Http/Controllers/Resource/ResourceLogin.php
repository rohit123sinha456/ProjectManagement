<?php

namespace App\Http\Controllers\Resource;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\User;

class ResourceLogin extends Controller
{
    function index(){
        return view('resource.dashboard');
    }
    function login(Request $request){
        $this->validate($request,[
            'email'   => 'required|email',
            'password' => 'required|min:2'
           ]);
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            session(['user' => Auth::id()]);
            return redirect('/resource/dashboard');
        }
        return redirect('/resource');
    }
}
