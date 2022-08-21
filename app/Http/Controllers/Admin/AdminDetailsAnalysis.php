<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ClientObject;
use App\Models\User;
use App\Models\EffortEstimation;
use App\Models\Timesheet;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;//Illuminate\Support\Collection
use Illuminate\Support\Collection;


class AdminDetailsAnalysis extends Controller
{
    function viewselectclient(){
        // Please Optimise this shit
        // Select clients.name,ntab.oname from (SELECT objectsresources.client_id as client_id, objects.name as oname from objectsresources LEFT JOIN objects on objects.id=objectsresources.object_id) as ntab left JOIN clients on clients.id = ntab.client_id
        
        $clientsAndTheirObjects = collect(DB::select(DB::raw('select clients.id,clients.name,ntab.oname,ntab.oid from (SELECT objects.id as oid, objectsresources.client_id as client_id, objects.name as oname from objectsresources LEFT JOIN objects on objects.id=objectsresources.object_id) as ntab left JOIN clients on clients.id = ntab.client_id')));
        $groupByClientId = $clientsAndTheirObjects->groupBy('id')->keyBy(function ($item, $key) {
            return ($item[0]->name);
        });

        $test = $groupByClientId->map(function ($data){
           return $data->keyBy(function ($item, $key) {
            return ($item->oname);
            });
        });

        //dd($test);
        //fucking rectify this shit
        return view('admin.selectclientforanalysis',['clientandObejcts'=>json_encode($test->toArray())]);
    }

    function analysis(Request $request){
        //when clients are created, make sure that the name of the clients are uniue in nature  
        // try to write a store proceure to calculate the entiner analysis part given the client name and object name
        $cname = $request->subject;
        $oid = $request->topic;
        //dd($request->all());
        $object_name = ClientObject::find($oid);
        // dd($object_name->name);

        $estimatehours = DB::table('effortestimations')
        ->select(DB::raw('sdlcstep,hours'))
        ->where('object_id','=',$oid)
        ->get()
        ->keyBy('sdlcstep');
        
        //dd($estimatehours);
        
        //EffortEstimation::where('object_id',$oid)->get(['sdlcstep','hours'])->keyBy('sdlcstep');
        $estoname = array();
        $esthours = array();
        $flag = 0;
        foreach($estimatehours as $co){
            $estoname[$flag] = $co->sdlcstep; // giving erro if we put cname(Client Name) -> address it
            $esthours[$flag] =$co->hours;
            $flag = $flag + 1;
            // dd($co[0]->cname);
        }

        //SELECT sdlcstep,SUM(hours) FROM timesheets WHERE object_id=1 GROUP BY sdlcstep;
        $efforthour = DB::table('timesheets')
        ->select(DB::raw('sdlcstep,SUM(hours) as hours'))
        ->where('object_id','=',$oid)
        ->where('is_submitted','=',1)
        ->groupBy('sdlcstep')
        ->get()
        ->keyBy('sdlcstep');


        $effortoname = array();
        $efforthours = array();
        $flag = 0;
        foreach($efforthour as $co){
            $effortoname[$flag] = $co->sdlcstep; // giving erro if we put cname(Client Name) -> address it
            $efforthours[$flag] = $co->hours;
            $flag = $flag + 1;
            // dd($co[0]->cname);
        }


        //dd($efforthour->keys()->toArray());
        $allstates = Timesheet::getPossibleStatuses();
        $allstateindexed = array();
        foreach($allstates as $key => $item){
            $temp = array();
            $temp['Client'] = $cname;
            $temp['Object'] = $object_name->name;
            $temp['SDLC'] = $item;
            if(in_array($item,$efforthour->keys()->toArray())){
                
                $temp['Effort'] = $efforthour[$item]->hours;
            }
            else{
                $temp['Effort'] = "-";
            }

            if(in_array($item,$estimatehours->keys()->toArray())){
                $temp['Estimate'] = $estimatehours[$item]->hours;
            }
            else{
                $temp['Estimate'] = "-";
            }

            
            array_push( $allstateindexed,$temp);
        }
        //dd($allstateindexed);

        //SELECT user_id,SUM(hours) from timesheets where object_id=1 and sdlcstep="DEF" GROUP BY user_id -> user hours
        $efforthourbyusers = Timesheet::where('object_id',$oid)->where('is_submitted','=',1)->get()->groupBy('sdlcstep');
        $efforthoursbyusergroupsdlc = $efforthourbyusers->map(function ($item){
            $itemsdlcgroupunkeyed = $item->groupBy('user_id');
            $itemsdlcgroup = $itemsdlcgroupunkeyed->keyBy(function ($item){
                $uname = User::find($item[0]->user_id);
                return $uname->name;
            });
            $sdlcgroup = $itemsdlcgroup->map(function ($value){
                return [
                    'value'=>$value->sum('hours')];
            });
           return $sdlcgroup;
        });

        //dd(json_encode($efforthoursbyusergroupsdlc));

        return view('admin.detailedanalysis',[
            "table_columns"=>json_encode($allstateindexed),
            "table_data"=>json_encode($allstateindexed),
            "sdlc_user_hours"=>json_encode($efforthoursbyusergroupsdlc),
            "effortname"=>$effortoname, "efforthours"=>$efforthours,
            "estimatename"=>$estoname, "estimatehours"=>$esthours

    ]);


        // dd($esthours);
    }

}
