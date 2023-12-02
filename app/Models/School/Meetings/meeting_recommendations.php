<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class meeting_recommendations extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'id',
        'Item',
        'reason',
        'status',
        'meeting_id',
    ];

    public $timestamps = true;
}
