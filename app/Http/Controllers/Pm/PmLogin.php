<?php

namespace App\Http\Controllers\Pm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Crypt;
use App\Models\Client;
use App\Models\ClientObject;
use App\Models\ClientObjectRelations;
use App\Models\ClientResources;


class PmLogin extends Controller
{
function index(){
    return view('pm.dashboard');
}

    function login(Request $request){
        $this->validate($request,[
            'email'   => 'required|email',
            'password' => 'required|min:2'
           ]);
           if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            session(['uid' => Auth::id()]);
            return redirect('/pm/dashboard');
        }
        return redirect('/pm');
    }

    function viewclients(){
        $pmid = session('uid');
        $pm_clients = ClientResources::where('user_id',$pmid)->get();
        $pm_client_id = array();
        foreach($pm_clients as $pc){
            array_push($pm_client_id,$pc->client_id);
        }
        $pm_client_ids = array_values(array_unique($pm_client_id));
        $clients = Client::whereIn('id',$pm_client_ids)->get();;
        return view('pm.clients',['clients'=>$clients]);
    }

    function viewclientsdetails($id){
        $clientid = $id;//$request->query('courseid');
        $clientdetails = Client::find($clientid);
        $coloumns = Schema::getColumnListing('clients');
        return view('pm.viewclients',['item'=>$clientdetails,'column'=>$coloumns]);
    }
    function viewclientsobjects($id){
        $objectids = ClientObjectRelations::where('client_id',$id)->get();
        if(count($objectids) == 0){
            return view('pm.objects',['clientcount'=>count($objectids),'clientid'=>$id]);
        }
        else{
            $client_objects_ids = array();
            foreach($objectids as $oid){
                array_push($client_objects_ids,$oid->object_id);
            }
            $client_objects_ids = array_values(array_unique($client_objects_ids));
            $client_objects = ClientObject::whereIn('id',$client_objects_ids)->get();
            //dd($client_objects);
            return view('pm.objects',['clientcount'=>count($objectids),'clientid'=>$id,'clients'=>$client_objects]);
        }
    }
}
