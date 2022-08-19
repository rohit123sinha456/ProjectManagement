<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\User;
use App\Models\ClientResources;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;


class AdminResourceControllerUtil extends Controller
{
    
    public function updateresource(Request $request, $id)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'title'   => 'required',
            'content' => 'required',
            'pmid' => 'required',
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->errors());
        }
        $user = User::find($id);
        $user->name = $request->title;
        $user->email = $request->content;
        $user->role = $request->pmid;
        $user->save();
        return redirect('/admin/resources/'.$id);
        // dd($request->input());
    }

    public function destroy($id)
    {
        //
    }
}
