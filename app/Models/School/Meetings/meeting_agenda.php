<?php

namespace App\Models\School\Meetings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class meeting_agenda extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'Item',
        'meeting_id',
    ];

    public $timestamps = true;
}
