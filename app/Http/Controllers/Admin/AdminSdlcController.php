<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\SDLC;
use App\Models\ClientResources;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class AdminSdlcController extends Controller
{
    public function index(){
        $sdlc = SDLC::all();
        //dd(count($sdlc));
        return view('admin.sdlcform',['sdlc'=>$sdlc]);

    }
    public function create(){
        return view('admin.createsdlcstage');

    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'acrnym'   => 'required|max:8',
            'desc' => 'required',
        ]);
        if ($validator->fails()) {
            return self::index()->withErrors($validator->errors());
        }
        //dd($request->input());

        $acrnym = $request->acrnym;
        $desc = $request->desc;
        $sentry = new SDLC;
        $sentry->name = $acrnym;
        $sentry->description = $desc;
        $sentry->save();
        return redirect('/admin/sdlc');
       
    }
}
