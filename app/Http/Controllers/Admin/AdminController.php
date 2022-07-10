<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\User;
use App\Models\ClientResources;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    function viewselectdate(){
        return view('admin.selectdate');
    }

    function showcharts(Request $request){
        $fromdate = $request->fromdate;
        $todate = $request->todate;

        //How many Hours each user is working
        $usersworkinghours = DB::table('timesheets')
           ->whereBetween('date', [$fromdate, $todate])
           ->where('is_submitted',1)
           ->get();
        $usersworkinghours = $usersworkinghours->groupBy('user_id');
        $uid = array();
        $userhours = array();
        $flag = 0;
        foreach($usersworkinghours as $uwh){
            $hourssum = 0;
            foreach($uwh as $uc){
                $hourssum = $hourssum + $uc->hours;
                $uid[$flag] = $uc->user_id; //bad code pls rectify
             }
             $userhours[$flag] = $hourssum;
             $flag = $flag + 1;
        }

        //How many objects for each client
        $clientobjects = DB::table('objectsresources')
        ->join('clients', 'objectsresources.client_id', '=', 'clients.id')
        ->join('objects', 'objectsresources.object_id', '=', 'objects.id')
        ->select('objectsresources.client_id AS cid', 'objectsresources.object_id AS oid','clients.name AS cname', 'objects.name AS onames')
        ->get();
        $clientobjects = $clientobjects->groupBy('cid');
        $names = array();
        $ocount = array();
        $flag = 0;
        foreach($clientobjects as $co){
            $names[$flag] = $co[0]->cname; // giving erro if we put cname(Client Name) -> address it
            $ocount[$flag] = count($co->groupBy('oid'));
            $flag = $flag + 1;
            // dd($co[0]->cname);
        }
        // dd($names);
        return view('admin.analysis',['uid'=>$uid,'uhours'=>$userhours,'names'=>$names,'ocount'=>$ocount]);
        //dd($userhours);
    }

}
