<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\User;
use App\Models\ClientResources;
use Illuminate\Support\Facades\Schema;


class AdminResourceControllerUtil extends Controller
{
    
    public function updateresource(Request $request, $id)
    {
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
