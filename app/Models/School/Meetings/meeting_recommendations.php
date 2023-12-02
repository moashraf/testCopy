<?php

namespace App\Models\School\Meetings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
