<?php

namespace App\Http\Controllers\Resource;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\User;
use App\Models\Timesheet;

class ResourceLogin extends Controller
{
    function index(){
        $userid = session('user');
        $timehours = Timesheet::where('user_id',$userid)->get();
        $hourstime = 0;
        foreach($timehours as $item){
            $hourstime = $hourstime + $item->hours;
        }
        $username = User::find($userid);
        return view('resource.dashboard',['filledhours'=>$hourstime,'name'=>$username->name]);
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
