<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SDLCModel extends Model
{
    use HasFactory;
    protected $table = "sdlcmodel";
    protected $fillable = [
        'name',
        'description'
    ];
    public static function getAllSdlcModels(){
        $sdlcstage = DB::table('sdlcmodel')->select('name','id')->get();
        $values = array();
        foreach($sdlcstage as $value){
            // dd($value->id);
            $values[$value->id] = trim($value->name, "'");
        }
        // dd($values);
        return $values;
    }
}
