<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\User;
use App\Models\ClientResources;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;


class AdminClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return view('admin.clients',['clients'=>$clients]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pm = User::all();
        return view('admin.createclients',['pm'=>$pm]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'   => 'required',
            'content' => 'required',
            'pmid' => 'required',
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->errors());
        }

        $client = new Client;
        $clientresource = new ClientResources;
        try{
        $client->name = $request->title;
        $client->description = $request->content;
        $client->save();
        $clientresource->client_id = $client->id;
        $clientresource->user_id = $request->pmid;
        $clientresource->is_primary = TRUE;
        $clientresource->save();
        }
        catch(Exception $e){
            return redirect('/admin/clients');
        }
        return redirect('/admin/clients');
    }

 
    public function show($id)
    {
        $clientid = $id;//$request->query('courseid');
        $clientdetails = Client::find($clientid);
        $coloumns = Schema::getColumnListing('clients');
        $coloumns[count($coloumns)] = "pmname";
        $cr = ClientResources::where("client_id",$clientid)->where('is_primary',1)->first();
        $pmdetails = User::find($cr->user_id);
        $clientdetails = Arr::add($clientdetails, 'pmname' , $pmdetails->name);
        return view('admin.viewclients',['item'=>$clientdetails,'column'=>$coloumns]);
    }

 
    public function edit($id)
    {
        $clientid = $id;//$request->query('courseid');
        $clientdetails = Client::find($clientid);
        // $coloumns = Schema::getColumnListing('clients');
        // $coloumns[count($coloumns)] = "pmname";
        $cr = ClientResources::where("client_id",$clientid)->where('is_primary',1)->first();
        $pmdetails = User::find($cr->user_id);
        $clientdetails = Arr::add($clientdetails, 'pmname' , $pmdetails->name);
        $allusers = User::all();
        //dd($clientdetails);
        return view('admin.editclient',['clientinfo'=>$clientdetails,'pminfo'=>$pmdetails,'allusers'=>$allusers]);
    }

   
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'   => 'required',
            'description' => 'required',
            'pmid' => 'required',
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->errors());
        }

        try{
        $client = Client::find($id);
        // dd($request->all());
        $client->name = $request->title;
        $client->description = $request->description;
        $client->save();
        $clientresource = ClientResources::where("client_id",$id)->first();
        $clientresource->client_id = $id;
        $clientresource->user_id = $request->pmid;
        $clientresource->is_primary = TRUE;
        $clientresource->save();
        return redirect('/admin/clients/'.$id);
        }
        catch(Exception $e){
            return redirect('/admin/clients');
        }
        return redirect('/admin/clients');
    }

   
    public function destroy($id)
    {
        //
    }
}
