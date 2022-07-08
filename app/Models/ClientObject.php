<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientObject extends Model
{
    use HasFactory;
    protected $table = 'objects';

    protected $fillable = [
        'name',
        'description',
        'state',
    ];


    public function getstateAttribute($value){
        $states = array("assigned","reverted",'running','complete');
        return $states[$value%4];
    }
}
