<?php

namespace App\Models\School\Meetings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class meeting_agenda extends Model
{
    protected $table = 'meeting_agenda';
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'Item',
        'meeting_id',
    ];

    public $timestamps = true;
}
