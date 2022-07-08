<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\User;
use App\Models\ClientResources;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Arr;

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
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
