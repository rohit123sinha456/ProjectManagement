<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientObjectRelations extends Model
{
    use HasFactory;
    protected $table = 'objectsresources';

    protected $fillable = [
        'user_id',
        'object_id',
        'client_id',
        'is_primary',
    ];

}
