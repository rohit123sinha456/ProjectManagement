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
use App\Models\EffortEstimation;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;



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
        // dd($request->input());
        for($i=0;$i<$datalength;$i++){
            if($timesheets[$i]->is_submitted == 0){
            $timesheets[$i]->hours = $request->hours[$i];
            $timesheets[$i]->is_submitted = 1;
            $timesheets[$i]->save();
            }
        }
        return redirect("/resource/viewtimesheetentry");
    }



    function vieweffortestimation(){
        $userid = session('user');
        $entries = DB::table('objectsresources')->where([
            ['user_id', '=', $userid],
            ['is_primary', '=', 1],
        ])->get();
        $objectids = array();
        foreach($entries as $entry){
                array_push($objectids,$entry->object_id);
        }
        $uniqueobjectids = array_values(array_unique($objectids));
        $objects = ClientObject::whereIn('id',$uniqueobjectids)->whereIn('state',[0])->get();
        // dd($objects);
        return view('resource.probjects',['entries'=>$objects]);

    }

    function filleffortestimation($id){
        $estimate = EffortEstimation::where("object_id",$id)->first();
        $coloumns = Schema::getColumnListing('effortestimations');
        $not_fillable_coloumn = array('id','object_id','created_at','updated_at');
        foreach($not_fillable_coloumn as $nfc){
            if (($key = array_search($nfc, $coloumns)) !== false) {
                unset($coloumns[$key]);
            }
        }
        //dd($estimate);
        if($estimate != null){
        return view('resource.entereffortestimate',['item'=>$estimate,'column'=>$coloumns,'nodata'=>false,'oid'=>$id]);
        }
        else{
        return view('resource.entereffortestimate',['item'=>$estimate,'column'=>$coloumns,'nodata'=>true,'oid'=>$id]);
        }
        dd($estimate);
    }

    function submiteffortestimate(Request $request){
        $estimate = EffortEstimation::where('object_id',$request->oid)->first();
        if($estimate == null){
            $newestimate = new EffortEstimation;
            $newestimate->A = $request->A;
            $newestimate->B = $request->B;
            $newestimate->C = $request->C;
            $newestimate->D = $request->D;
            $newestimate->E = $request->E;
            $newestimate->object_id = $request->oid;
            $newestimate->save();
            $object = ClientObject::find($newestimate->object_id);
            $object->state = 1;
            $object->save();
        }
        else{
            $newestimate = EffortEstimation::where('object_id',$request->oid)->first();
            $newestimate->A = $request->A;
            $newestimate->B = $request->B;
            $newestimate->C = $request->C;
            $newestimate->D = $request->D;
            $newestimate->E = $request->E;
            $newestimate->object_id = $request->oid;
            $newestimate->save();
            $object = ClientObject::find($newestimate->object_id);
            $object->state = 1;
            $object->save();

        }
        return redirect('/resource/vieweffortestimation');
    }

    function showresourceSettings(Request $request){
        $studentid = $request->session()->get('user');//Crypt::decryptString($request->session()->get('user'));
        $studentdetails = User::find($studentid);
        $coloumns = Schema::getColumnListing('users');
        $not_fillable_coloumn = array('email_verified_at','password','remember_token','created_at','updated_at');
        foreach($not_fillable_coloumn as $nfc){
            if (($key = array_search($nfc, $coloumns)) !== false) {
                unset($coloumns[$key]);
            }
        }
        return view('resource.settings',['item'=>$studentdetails,'column'=>$coloumns]);
    }

    function showresourcePasswordReset(){
        return view('resource.passwordreset');
    }

    function resourcePasswordReset(Request $request){
        $this->validate($request, [
            'password' => 'confirmed|min:6'
        ]);
        $studentid = session('user');//Crypt::decryptString($request->session()->get('student'));
        $studentdetails = User::find($studentid);
        $studentdetails->password = bcrypt($request->password);
        $studentdetails->save();
        return redirect('/resource/settings');
    }
}
