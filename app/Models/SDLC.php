<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SDLC extends Model
{
    use HasFactory;
    protected $table = 'sdlc';
    protected $fillable = [
        'name',
        'description'
    ];
}
