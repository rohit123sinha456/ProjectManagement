<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Timesheet extends Model
{
    use HasFactory;
    protected $table = 'timesheets';
    protected $fillable = [
        'user_id',
        'object_id',
        'sdlcstep',
        'hours',
        'date',        
        'is_submitted',
    ];
    public static function getPossibleStatuses(){
        $type = DB::select(DB::raw('SHOW COLUMNS FROM timesheets WHERE Field = "sdlcstep"'))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $values = array();
        foreach(explode(',', $matches[1]) as $value){
            $values[] = trim($value, "'");
        }
        return $values;
    }
}
