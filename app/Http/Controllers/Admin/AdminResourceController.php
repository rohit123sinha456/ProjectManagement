<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\User;
use App\Models\ClientResources;
use Illuminate\Support\Facades\Schema;


class AdminResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = User::all();
        return view('admin.resources',['clients'=>$clients]);
    }

    
    public function create()
    {
        $pm = [['id'=>1,'name'=>"PM"],['id'=>0,'name'=>"Resource"]];
        return view('admin.createresources',['pm'=>$pm]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->title;
        $user->email = $request->content;
        $user->password = bcrypt('123');
        $user->role = $request->pmid;
        $user->save();
        
        return redirect('/admin/resources');
        // dd($request->input());
    }

    
    public function show($id)
    {
        $user = User::find($id);
        $coloumns = Schema::getColumnListing('users');
        return view('admin.viewclients',['item'=>$user,'column'=>$coloumns]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $pm = [['id'=>1,'name'=>"PM",'role'=>'pm'],['id'=>0,'name'=>"Resource",'role'=>'resource']];
        return view('admin.editresource',['userinfo'=>$user,'pm'=>$pm]);
    }
}
