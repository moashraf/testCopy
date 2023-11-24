<?php

namespace App\Models\School\Student;

use App\Models\School\Manager;
use App\Models\School\School;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class School_event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'type', //1- from the managemnt, 2- school itself
        'name',
        'event_date',
        'manager_id',
        'school_id',
    ];

    public $timestamps = false;

    public function manager()
    {
        return $this->belongsTo(Manager::class, 'manager_id', 'id');
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }
}
