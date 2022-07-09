<?php

namespace App\Http\Controllers\Resource;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\User;
use App\Models\ClientObject;
use App\Models\ClientObjectRelations;
use App\Models\Timesheet;
use Illuminate\Support\Facades\DB;


class ResourceController extends Controller
{
    function selectdate(){
        return view('resource.selecttimesheetdate',['dateselected'=>false]);
    }

    function viewtimesheet(Request $request){
        $coloumns = Timesheet::getPossibleStatuses();
        $issubmit = 0;
        $userid = session('user');
        $clientobjects = ClientObjectRelations::where('user_id',$userid)->get();
        $object_client_id = array();
        foreach($clientobjects as $oc){
            array_push($object_client_id,$oc->object_id);
        }
        $object_client_ids = array_values(array_unique($object_client_id));
        $objects = ClientObject::whereIn('id',$object_client_ids)->get();
        //chain in a where cluse to show objects that are in running state
        $selecteddate = $request->date;
        //https://www.etutorialspoint.com/index.php/11-dynamically-add-delete-html-table-rows-using-javascript
        return view('resource.entrytimesheet',['column'=>$coloumns,'issubmit'=>$issubmit,'objects'=>$objects,'dateselected'=>true,'date'=>$selecteddate]);
    }

    function submittimesheet(Request $request){

        $userid = session('user');
        //dd($userid);
        //$inputcount = count($request->oid);
        $this->validate($request,[
            'oid'  => 'required|array',
            'sdlc'  => 'required|array',
            'hours'  => 'required|array',
        ]);
        $oids = $request->oid;
        $sdlcs = $request->sdlc;
        $hourss = $request->hours;
        //dd(Timesheet::getPossibleStatuses());
        for ($x = 0; $x < count($oids); $x++) {
            $tsentry = new Timesheet;
            $tsentry->user_id = $userid;
            $tsentry->object_id = $oids[$x];
            $tsentry->sdlcstep = $sdlcs[$x];
            $tsentry->date = $request->date;
            $tsentry->hours = $hourss[$x];
            $tsentry->is_submitted = 0;
            $tsentry->save();
        }

        return redirect('/resource/timesheetselectdate');

        // dd($request->input());
    }

    function viewtimesheetentry(Request $request){
        if($request->date === null){
            return view('resource.viewtimesheetentry',['nodate'=>true]);
        }
        else{
            $selecteddate = $request->date;
            $userid = session('user');
            $entries = DB::table('timesheets')->where([
                ['user_id', '=', $userid],
                ['date', '=', $selecteddate],
            ])->get();
            $objectids = array();
            foreach($entries as $entry){
                array_push($objectids,$entry->object_id);
            }
            $uniqueobjectids = array_values(array_unique($objectids));
            $objects = ClientObject::whereIn('id',$uniqueobjectids)->get();
            $objectsname = array();
            foreach($objects as $object){
                $objectsname[$object->id] = $object->name;
            }
            return view('resource.viewtimesheetentry',['nodate'=>false,'objects'=>$objectsname,'entries'=>$entries]);
        }
    }

    function submittimesheetentry(Request $request){
        $timesheets = Timesheet::find($request->tsid);
        $datalength = count($timesheets->toArray());
        for($i=0;$i<$datalength;$i++){
            if($timesheets[$i]->is_submitted == 0){
            $timesheets[$i]->hours = $request->hours[$i];
            $timesheets[$i]->is_submitted = 1;
            $timesheets[$i]->save();
            }
        }
        return redirect("/resource/viewtimesheetentry");
    }
}
