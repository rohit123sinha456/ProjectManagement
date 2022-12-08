<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\SDLC;
use App\Models\SDLCModel;
use App\Models\ClientResources;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class AdminSdlcController extends Controller
{
    public function index(){
        $sdlc = SDLC::all();
        $sdlcinfo = DB::table('sdlc')
                    ->join('sdlcmodel','sdlc.sdlc_model_name', '=', 'sdlcmodel.id')
                    ->select('sdlc.name','sdlc.description','sdlcmodel.name as sdlcmodelname')
                    ->orderBy('sdlcmodelname')
                    ->get();
        
        // dd($sdlcinfo);
        return view('admin.sdlcform',['sdlc'=>$sdlcinfo,'iscreatesdlcmodel'=>false]);

    }
    public function create(){
        $allsdlcmodels = SDLCModel::getAllSdlcModels();
        // dd($allsdlcmodels);
        return view('admin.createsdlcstage',['isSdlcModelCreateForm'=>false,'sdlcmodels'=>$allsdlcmodels]);
        
    }
    
    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'acrnym'   => 'required|alpha_dash|max:8',
            'desc' => 'required',
            'sdlcmodel.*' => 'required'
            ]);
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator->errors());
            }
            // dd($request->input());
            
            $acrnym = $request->acrnym;
            $desc = $request->desc;
            $sdlcmodelindex = $request->sdlcmodel[0];
            $sentry = new SDLC;
            $sentry->name = $acrnym;
            $sentry->description = $desc;
            $sentry->sdlc_model_name = $sdlcmodelindex;
            $sentry->save();
            return redirect('/admin/sdlc');
            
        }


//SDLC Model Controller Code
        public function sdlcmodelindex(){
            $sdlcmodels = SDLCModel::all();
            return view('admin.sdlcform',['sdlc'=>$sdlcmodels,'iscreatesdlcmodel'=>true]);
    
        }

        public function sdlcmodelcreate(){
            return view('admin.createsdlcstage',['isSdlcModelCreateForm'=>true]);
            
        }
        public function sdlcmodelupdate(Request $request){
            $validator = Validator::make($request->all(), [
                'acrnym'   => 'required|alpha_dash',
                'desc' => 'required',
                ]);
                if ($validator->fails()) {
                    return Redirect::back()->withErrors($validator->errors());
                }
                //dd($request->input());
                
                $acrnym = $request->acrnym;
                $desc = $request->desc;
                $sentry = new SDLCModel;
                $sentry->name = $acrnym;
                $sentry->description = $desc;
                $sentry->save();
                return redirect('/admin/sdlcmodels');
                
            }
    }
    