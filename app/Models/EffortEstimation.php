<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EffortEstimation extends Model
{
    use HasFactory;
    protected $table = 'effortestimations';

    protected $fillable = [
        'object_id',
        'A',
        'B',
        'C',
        'D',
        'E',
    ];
}
