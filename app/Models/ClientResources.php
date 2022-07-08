<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientResources extends Model
{
    use HasFactory;
    protected $table = 'client_resources';

    protected $fillable = [
        'user_id',
        'client_id',
        'is_primary',
    ];
}
