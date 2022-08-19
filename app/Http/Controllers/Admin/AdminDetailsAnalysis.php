<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\User;
use App\Models\ClientResources;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;//Illuminate\Support\Collection
use Illuminate\Support\Collection;


class AdminDetailsAnalysis extends Controller
{
    function viewselectclient(){
        //Please Optimise this shit
        //select clients.name,ntab.oname from (SELECT objectsresources.client_id as client_id, objects.name as oname from objectsresources LEFT JOIN objects on objects.id=objectsresources.object_id) as ntab left JOIN clients on clients.id = ntab.client_id
        $clientsAndTheirObjects = collect(DB::select(DB::raw('select clients.id,clients.name,ntab.oname,ntab.oid from (SELECT objects.id as oid, objectsresources.client_id as client_id, objects.name as oname from objectsresources LEFT JOIN objects on objects.id=objectsresources.object_id) as ntab left JOIN clients on clients.id = ntab.client_id')));
        $groupByClientId = $clientsAndTheirObjects->groupBy('id')->keyBy(function ($item, $key) {
            return ($item[0]->name);
        });
        $test = $groupByClientId->map(function ($data){
           return $data->keyBy(function ($item, $key) {
            return ($item->oname);
        });
        });
        //dd($groupByClientId);
        return view('admin.selectclientforanalysis',['clientandObejcts'=>json_encode($test->toArray())]);
    }

    function analysis(Request $request){
        //when clients are created, make sure that the name of the clients are uniue in nature  
        // try to write a store proceure to calculate the entiner analysis part given the client name and object name
       dd($request->subject);
    }

}
