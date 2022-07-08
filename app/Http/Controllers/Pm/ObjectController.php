<?php

namespace App\Http\Controllers\Pm;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Crypt;
use App\Models\Client;
use App\Models\User;
use App\Models\ClientObject;
use App\Models\ClientObjectRelations;
use Illuminate\Support\Arr;


class ObjectController extends Controller
{
    function view($id){
        $pm = User::all();
        return view('pm.createobject',['pm'=>$pm,'clientid'=>$id]);
        //dd($id);
    }
    function create(Request $request){
        $cobject = new ClientObject;
        $cobject->name = $request->title;
        $cobject->description = $request->content;
        $cobject->state = 0;
        $cobject->save();

        $clientobrel = new ClientObjectRelations;
        $clientobrel->object_id = $cobject->id;
        $clientobrel->client_id = $request->clientid;
        $clientobrel->user_id = $request->prid;
        $clientobrel->is_primary = 1;
        $clientobrel->save();
        foreach($request->srid as $sr){
            $clientobrel = new ClientObjectRelations;
            $clientobrel->object_id = $cobject->id;
            $clientobrel->client_id = $request->clientid;
            $clientobrel->user_id = $sr;
            $clientobrel->is_primary = 0;
            $clientobrel->save();

        }
        return redirect('/pm/clients');
    }

    function updatestatecomplete($id){
        $clientobject = ClientObject::find($id);
        $clientobject->state = 3;
        $clientobject->save();
        //dd($clientobject);
        return redirect('/pm/clients/');
        //dd($id);
    }

    function updatestaterunning($id){
        $clientobject = ClientObject::find($id);
        $clientobject->state = 2;
        $clientobject->save();
        //dd($clientobject);
        return redirect('/pm/clients/');
        //dd($id);
    }

    function updatestaterejected($id){
        $clientobject = ClientObject::find($id);
        $clientobject->state = 0;
        $clientobject->save();
        //dd($clientobject);
        return redirect('/pm/clients/');
        //dd($id);
    }

    function showdetails($id){
        $clientobject = ClientObject::find($id);
        $clientobjectrelation = ClientObjectRelations::where('object_id',$clientobject->id)->get();
        $primary_resource = "";
        $secondary_resource = "";
        foreach($clientobjectrelation as $objectresource){
            if($objectresource->is_primary == 1){
                $primary_resource = User::find($objectresource->user_id);
                $primary_resource = $primary_resource->name;
            }
            else{
                $tmpsr = User::find($objectresource->user_id);
                $secondary_resource = $secondary_resource." , ".$tmpsr->name;
            }
        }
        $coloumns = Schema::getColumnListing('objects');
        $coloumns[count($coloumns)] = "prname";
        $objectdetails = Arr::add($clientobject, 'prname' , $primary_resource);
        $coloumns[count($coloumns)] = "srname";
        $objectdetails = Arr::add($clientobject, 'srname' , $secondary_resource);
        return view('pm.viewobject',['item'=>$objectdetails,'column'=>$coloumns]);
        //dd($secondary_resource);
        
    }
}
